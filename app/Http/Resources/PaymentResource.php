<?php

namespace App\Http\Resources;

use App\User;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        $data['name'] = User::find($data['user_id'])->name;
        return $data;
    }
}
