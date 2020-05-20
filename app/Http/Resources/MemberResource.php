<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
			"group_id"=>$this->group_id,
			"is_admin"=>$this->is_admin,
			"loan_approver"=>$this->loan_approver,
			"withdrawal_approver"=>$this->withdrawal_approver,
			"active"=>$this->active,
			"status"=>$this->status,
			"reasons"=>$this->reasons,
			"leave_group_fee_paid"=>$this->leave_group_fee_paid,
			"created_by"=>$this->created_by,
			"modified_by"=>$this->modified_by,
			"created_at"=>$this->created_at->format('Y-m-d'),
			"updated_at"=>$this->updated_at->format('Y-m-d')
		];
		
        $data['name'] = $this->user()->first()->name;
        $data['email'] = $this->user()->first()->email;
        $data['phone'] = $this->user()->first()->phone;
        return $data;
    }
}
