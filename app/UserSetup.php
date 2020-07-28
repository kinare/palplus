<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetup extends Model
{
    protected $fillable  = [
		'total_withdrawal',
		'user_id',
		'balance_to_withdrawal',
		'maximum_withdrawal_amount'
	];

	public static function allowWithdraw($user_id, $amount_to_withdraw) {
		$amount = (float)$amount_to_withdraw;
		$setup  = UserSetup::whereDate('created_at', '=', date('Y-m-d'))->where('user_id', $user_id)->first();
		if(!$setup){
			return true;
		}

		$balance_after_withdrawal =(float)$setup->maximum_withdrawal_amount - ((float)$setup->total_withdrawal + $amount);
		if((int)$balance_after_withdrawal <= 0){
			return false;
		}


		
		// then calculate the amount
		if((float)$setup->balance_to_withdrawal >= (float)$setup->maximum_withdrawal_amount){
			return false;
		}
		
		if(((float)$balance_after_withdrawal < (float)$setup->maximum_withdrawal_amount)){
			return true;
		}
		return false;
	}

	// Create setup or add to setup
	public static function setup($user_id, $amount, $limit_per_day){
		$setup  = UserSetup::whereDate('created_at', '=', date('Y-m-d'))->where('user_id', $user_id)->first();
		if($setup){
			$balance_after_withdrawal =(float)$setup->maximum_withdrawal_amount - ((float)$setup->total_withdrawal + $amount);
			// dd($balance_after_withdrawal);
			
			if((int)$balance_after_withdrawal < 0){
				return false;
			}
			if((float)$setup->balance_to_withdrawal >= (float)$setup->maximum_withdrawal_amount){
				return false;
			}
			
			if(!((float)$balance_after_withdrawal < (float)$setup->maximum_withdrawal_amount)){
				return false;
			}
			$setup->total_withdrawal =  (float)$setup->total_withdrawal + $amount;
			$setup->balance_to_withdrawal = (float)$setup->balance_to_withdrawal +  $amount;
			$setup->save();
			return true;
		}else if(!$setup){
			$new_setup = new UserSetup();
			$new_setup->user_id = $user_id;
			$new_setup->total_withdrawal =  (float)$new_setup->total_withdrawal + $amount;
			$new_setup->balance_to_withdrawal = ((float)$new_setup->maximum_withdrawal_amount -  (float)$new_setup->total_withdrawal + $amount);
			$new_setup->maximum_withdrawal_amount = $limit_per_day;
			$new_setup->save();
			return true;
		}
		return false;
	}
}
