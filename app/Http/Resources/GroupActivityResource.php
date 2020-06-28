<?php

namespace App\Http\Resources;

use App\Wallet;
use Carbon\Carbon;
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
        $data['cut_off_date_readable'] = Carbon::parse($data['cut_off_date'])->toFormattedDateString();
        $data['start_date_readable'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date_readable'] = Carbon::parse($data['end_date'])->toFormattedDateString();
        return $data;
    }
}
