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
        $data['cut_off_date_readable'] = Carbon\Carbon::createFromFormat('Y-m-d', $data['cut_off_date']);
        $data['start_date_readable'] = Carbon\Carbon::createFromFormat('Y-m-d', $data['start_date']);
        $data['end_date_readable'] = Carbon\Carbon::createFromFormat('Y-m-d', $data['end_date']);
        return $data;
    }
}
