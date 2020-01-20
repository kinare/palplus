<?php

namespace App\Http\Resources;

use App\Currency;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionResource extends JsonResource
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
        $data['contribution_type'] = $this->type()->first()->name ?: null;
        $data['group'] = $this->group()->first()->name ?: null;
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        return $data;
    }
}
