<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApproverResourcce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $member = $this->members()->first();
        $user = $member->user()->first();
        $member->is_approver = true;
        $member->name  = $user->name;
        $member->email = $user->email;
        $member->phone = $user->phone;
        return $member;
    }
}
