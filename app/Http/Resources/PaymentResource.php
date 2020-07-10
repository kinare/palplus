<?php

namespace App\Http\Resources;

use App\User;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
			"id"=>$this->id,
			"user_id"=>$this->user_id,
			"description"=>$this->description,
			"model"=>$this->model,
			"model_id"=>$this->model_id,
			"transaction_code"=>$this->transaction_code,
			"status"=>$this->status,
			"amount"=>$this->amount,
			"created_by"=>$this->created_by,
			"modified_by"=>$this->modified_by,
			"created_at"=>$this->created_at->format('Y-m-d'),
			"updated_at"=>$this->updated_at->format('Y-m-d'),
		];
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        $data['name'] = User::find($data['user_id'])->name;
        $data['group'] = \App\Group::find($this->group_id);
        return $data;
    }
}
