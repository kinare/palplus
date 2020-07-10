<?php

namespace App\Http\Resources;

use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
        $data['currency'] = $this->walletCurrency();
        $data['user'] = $this->user_id > 0 ? \App\User::find($this->user_id) : 0;
        return  $data;
    }
}
