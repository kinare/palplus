<?php

namespace App\Http\Resources;

use App\Currency;
use App\Members;
use App\User;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionResource extends JsonResource
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
		return [
			"id" => $this->id,
			"group_id" => $this->group_id,
			"member_id" => $this->member_id,
			"amount" => $this->amount,
			"created_by" => $this->created_by,
			"modified_by" => $this->modified_by,
			"created_at" => $this->created_at->format('Y-m-d'),
			"updated_at" => $this->updated_at->format('Y-m-d'),
			"contribution_type" => $this->type()->first()->name ?: null,
			"group" => $this->group()->first()->name ?: null,
			"currency" => Wallet::group($this->group_id)->walletCurrency(),
			"name" => User::find(Members::member($data['group_id'])->user_id)->name,
		];
        // $data = parent::toArray($request);
        // $data['contribution_type'] = $this->type()->first()->name ?: null;
        // $data['group'] = $this->group()->first()->name ?: null;
        // $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        // $data['name'] = User::find(Members::member($data['group_id'])->user_id)->name;
        // return $data;
    }
}
