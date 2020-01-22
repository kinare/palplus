<?php

namespace App\Http\Resources;

use App\Group;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportingResource extends JsonResource
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
        $data['user'] = User::find($data['user_id'])->name;
        $data['group'] = Group::find($data['group_id'])->name;
        return $data;
    }
}
