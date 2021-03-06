<?php

namespace App\Http\Resources;

use App\Wallet;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DahsboardTransactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

		$data = parent::toArray($request);
        $wallet = Wallet::find($data['wallet_id']);
        $data['owner'] = $wallet->type;
        $data['status'] = $this->status;
        $data['group'] = $wallet->group_id ;
        $data['account_no'] = $this->account_no ? $this->account_no : 'User Wallet'  ;
        $data['user_name'] = User::find($this->created_by)? User::find($this->created_by)->name : User::find($wallet->user_id)->name;
        $data['user'] =  $wallet->user_id;
        return $data;
    }
}
