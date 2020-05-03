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
		// return parent::toArray($request);
		return  [
			"id" => $this->id,
			"name" => $this->name,
			"email" => $this->email,
			"phone" => $this->phone,
			"currency_id" => $this->currency_id,
			"phone_verified" => $this->phone_verified,
			"is_admin" => $this->is_admin,
			"reasons" => $this->reasons,
			"status" => $this->status,
			"active" => $this->active,
			"location" => $this->location,
			"country_code" => $this->country_code,
			"created_at" => $this->created_at,
			"deleted_at" => $this->deleted_at,
			"updated_at" => $this->updated_at,
			// related fields
		];
    }
}
