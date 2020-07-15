<?php

namespace App\Http\Resources;

use App\ContributionPeriod;
use App\ContributionType;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupProjectResource extends JsonResource
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
        $data['frequency'] = $data['contribution_frequency'];
        $data['hasContributions'] = ContributionType::whereProjectId($this->id)->first() ? true : false;
        $data['start_date_readable'] = Carbon::parse($data['start_date'])->toFormattedDateString();
        $data['end_date_readable'] = Carbon::parse($data['end_date'])->toFormattedDateString();
        return $data;
    }
}
