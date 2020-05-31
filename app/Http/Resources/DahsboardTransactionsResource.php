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
        $data['group'] = $wallet->group_id ;
        $data['user_name'] = User::find($this->created_by)? User::find($this->created_by)->name : '';
        $data['user'] =  $wallet->user_id;
        return $data;
    }
}
