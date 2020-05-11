<?php

namespace App\Http\Resources;

use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PaypalWithdrawalRequestsResource extends JsonResource
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
			'id'=>$this->id,
			'user_id'=>$this->user_id,
			'url'=>$this->url,
			'amount'=>$this->amount,
			'created_at'=>$this->created_at->format('Y-m-d'),
			'updated_at'=>$this->updated_at->format('Y-m-d')
		];
        $data['user'] = User::find($data['user_id']);
        return $data;

    }
}
