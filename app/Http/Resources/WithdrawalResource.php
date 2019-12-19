<?php

namespace App\Http\Resources;

use App\Members;
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
        $data = parent::toArray($request);
        $data['member'] = Members::find($data['member_id'])->user()->first()->name;
        return $data;
    }
}
