<?php

namespace App\Http\Resources;

use App\Wallet;
use App\Http\Resources\GroupTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
			'id' => $this->id,
			'code' => $this->code,
			'name' => $this->name,
			'description' => $this->description,
			'avatar' => $this->avatar,
			'access_level' => $this->access_level,
			'country' => $this->country,
			'target_amount' => $this->target_amount,
			'currency_id' => $this->currency_id,
			'type_id' => $this->type_id,
			'type' => new GroupTypeResource($this->type),
			'setting_id' => $this->setting_id,
			'loan_setting_id' => $this->loan_setting_id,
			'withdrawal_setting_id' => $this->withdrawal_setting_id,
			'wallet_id' => $this->wallet_id,
			'active' => $this->active,
			'reasons' => $this->reasons,
			'status' => $this->status,
			'created_at' => $this->created_at->format('Y-m-d'),
			'updated_at' => $this->updated_at->format('Y-m-d'),
			'avatar_url' => $this->avatar_url
		];
		$data['currency'] = Wallet::group($this->id)->walletCurrency();
		$data['created_by'] = User::find($this->created_by) ? User::find($this->created_by) : '' ;

        return $data;
    }
}
