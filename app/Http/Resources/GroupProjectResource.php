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
        $data['frequency'] = ContributionPeriod::find($data['contribution_frequency'])->name ?: null;
        $data['hasContributions'] = ContributionType::whereProjectId($this->id)->first() ? true : false;
        $data['start_date'] = Carbon::parse($data['start_date'])->toFormattedDateString();
        $data['end_date'] = Carbon::parse($data['end_date'])->toFormattedDateString();
        return $data;
    }
}
