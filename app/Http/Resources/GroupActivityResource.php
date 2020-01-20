<?php

namespace App\Http\Resources;

use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupActivityResource extends JsonResource
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
        $data['is_member'] = $this->hasJoined($this->group_id) ? true : false;
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        return $data;
    }
}
