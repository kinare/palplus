<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CurrencyResource as Currency;

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
			"currency" => new Currency($this->currency),
			"status" => $this->status,
			"active" => $this->active,
			"location" => $this->location,
			"country_code" => $this->country_code,
			"created_at" => $this->created_at ? $this->created_at->format('Y-m-d'): '',
			"deleted_at" => $this->deleted_at ? $this->deleted_at->format('Y-m-d'): '',
			"updated_at" => $this->updated_at ? $this->updated_at->format('Y-m-d'): ''
		];
    }
}
