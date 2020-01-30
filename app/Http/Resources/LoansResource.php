<?php

namespace App\Http\Resources;

use App\Loan;
use App\Members;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LoansResource extends JsonResource
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
        $data['start_date_readable'] = Carbon::parse($data['start_date'])->toFormattedDateString();
        $data['end_date_readable'] = Carbon::parse($data['end_date'])->toFormattedDateString();
        $data['name'] = User::find(Members::find($data['member_id'])->user_id)->name;
        return $data;
    }
}
