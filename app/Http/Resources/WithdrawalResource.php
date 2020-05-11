<?php

namespace App\Http\Resources;

use App\Members;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
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
			"id" => $this->id,
			"code" => $this->code,
			"group_id" => $this->group_id,
			"member_id" => $this->member_id,
			"approvers" => $this->approvers,
			"amount" => $this->amount,
			"status" => $this->status,
			"created_by" => $this->created_by,
			"modified_by" => $this->modified_by,
			"created_at" => $this->created_at->format('Y-m-d'),
			"updated_at" => $this->updated_at->format('Y-m-d'),
		];
        $data['member'] = Members::find($data['member_id'])->user()->first()->name;
        $data['currency'] = Wallet::currency();
        return $data;
    }
}
