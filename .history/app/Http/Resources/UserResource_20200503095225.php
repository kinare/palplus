<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		return parent::toArray($request);
		return  [
			"id" => $request->id,
			"name" => $request->name,
			"email" => $request->email,
			"phone" => $request->phone,
			"phone_verified" => $request->phone_verified,
			"is_admin" => $request->is_admin,
			"id" => $request->id
		];
    }
}
