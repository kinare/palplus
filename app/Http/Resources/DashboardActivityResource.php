<?php

namespace App\Http\Resources;

use App\ActivityType;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardActivityResource extends JsonResource
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
        $data['currency'] = Wallet::group($data['group_id'])->walletCurrency();
        $data['type'] = ActivityType::find($data['activity_type_id'])->activity;
        return $data;
    }
}
