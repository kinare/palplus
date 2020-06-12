<?php

namespace App\Http\Controllers\Finance;

use App\User;
use App\Group;
use App\Wallet;
use App\Members;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Currency\Converter;


class MoneyTransfer extends Controller
{
    /**
	 * Contribute to group admins 
	 * group_id, 
	 * amount 
	 * ->  will be able to get the group and the update the amount contributed to it 
	 * Contibution 
	 * notification to admins
	 * then message that successfully done 
	 */

	 public function contribute_group_admin(Request $request){
			$request->validate([
				'group_id' => 'required|integer',
				'amount' => 'required',
			]);

			$logged_in_user = $request->user();
			$user_wallet = Wallet::mine();
			$amount = (float)$request->amount;
			$user_wallet_total_balance = (float)$user_wallet->total_balance;
			if(!($user_wallet_total_balance > $amount)){
				return response()->json([
					"message" => "You have insufficient balance to contribute  ".$user_wallet->currencyShortDesc() .' '. $amount
				]);
			}

			// Get group using group ID
			$group  = Group::find($request->group_id);
			if(!$group){
				return response()->json([
					"message" => "This group does not exists. Please check again and retry"	
				]);
			}
			$group_members  = Members::where('group_id', $group->id)-get();

			$group_admin = null;
			foreach ($group_members as $member) {
				if($member->is_admin){
					$group_admin = $member;
				}
			}
			/** Ensure that there admin */
			if($group_admin !== null){
				$admin_wallet = Wallet::find($group_admin->user_id);
				$admin_amount  = Converter::Convert(
					$user_wallet->currencyShortDesc(), 
					$admin_wallet->currencyShortDesc(),
					$amount)['amount'];
				
				// Sende Wallet
				$user_wallet->total_balance = ((float)$user_wallet->total_balance - $amount);
				$user_wallet->total_withdrawals = ((float)$user_wallet->total_withdrawals + $amount);
				$user_wallet->save();
				
				$admin_wallet->total_balance = ((float)$admin_wallet->total_balance + $admin_amount);
				$admin_wallet->total_deposits = ((float)$admin_wallet->total_deposits + $admin_amount);
				$admin_wallet->save();
				
				return response()->json([
					"message"=> "Successfully contributed to ". $group->name .'admin.'
				]);	
			}
			return response()->json([
				"message"=> $group->name  ." has no admin"
			]);

	 }

	 /**
	  * Get current user,
	  *params: {
		* amount: to send 
		* receiver -> of the amount
		* currency conversion 
	  *}
	  */

	  public function send_money_another_app_user(Request $request){
		$request->validate([
			'phone' => 'required', 
			'amount' => 'required', 
		]);
		
		$user  = $request->user();
		$user_wallet = Wallet::mine();
		$amount  = (float)$request->amount;
		$user_wallet_total_balance = (float)$user_wallet->total_balance;
		// Check if wallet amount is greater than the amount to be send 
		if(!($user_wallet_total_balance > $amount)){
			return response()->json([
				"message" => "You have insufficient balance to send ".$user_wallet->currencyShortDesc() .' '. $amount
			]);
		}

		// send the cash to receiver user
		$receiver_user = User::where('phone', $request->phone)->first();
		if(!$receiver_user){
			return response()->json([
				"message" => "This user does not exists. Please check again and retry"	
			]);
		}

		//If user exists then 
		// Convert the amount the reciever wallet currency 
		$receiver_user_wallet = Wallet::find($receiver_user->id);
		$receiver_user_amount  = Converter::Convert(
			$user_wallet->currencyShortDesc(), 
			$receiver_user_wallet->currencyShortDesc(),
			$amount)['amount'];

		// Update Both user/Sender and Receiver Wallet
		// User Wallet 
		$user_wallet->total_balance = ((float)$user_wallet->total_balance - $amount);
		$user_wallet->total_withdrawals = ((float)$user_wallet->total_withdrawals + $amount);
		$user_wallet->save();


		$receiver_user_wallet->total_balance = ((float)$receiver_user_wallet->total_balance + $receiver_user_amount);
		$receiver_user_wallet->total_deposits = ((float)$receiver_user_wallet->total_deposits + $receiver_user_amount);
		$receiver_user_wallet->save();

		return response()->json([
			"message" => "Successfully sent, ".$user_wallet->currencyShortDesc() .' '. $amount . 'to '. $receiver_user->name
		]);
	  }

	
}	
