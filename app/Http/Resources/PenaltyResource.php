<?php

namespace App\Http\Resources;

use App\Members;
use App\Penalty;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class PenaltyResource extends JsonResource
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
        $data['currency'] = Wallet::group(Members::find($this->member_id)->group_id)->walletCurrency();
        return $data;
    }
}
