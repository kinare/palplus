<?php

namespace App\Http\Resources;

use App\ContributionPeriod;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupSettingResource extends JsonResource
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
        $data['access_level'] = $this->group()->first()->access_level;
        $data['period'] = ContributionPeriod::find($data['contribution_periods_id']) ? ContributionPeriod::find($data['contribution_periods_id'])->name : 'undefined';
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        return $data;
    }
}
