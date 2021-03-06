<?php

namespace App\Http\Resources;

use App\Members;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  parent::toArray($request);
        $data['approvers'] = count(Members::approvers($data['group_id']));

        return $data;
    }
}
