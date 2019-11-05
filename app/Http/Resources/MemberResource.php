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
        $data = parent::toArray($request);
        $data['name'] = $this->user()->first()->name;
        $data['email'] = $this->user()->first()->email;
        $data['phone'] = $this->user()->first()->phone;
        return $data;
    }
}
