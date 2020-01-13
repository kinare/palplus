<?php

namespace App\Http\Resources;

use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class DahsboardTransactionsResource extends JsonResource
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
        $wallet = Wallet::find($data['wallet_id']);
        $data['owner'] = $wallet->type;
        $data['group'] = $wallet->group_id ;
        $data['user'] =  $wallet->user_id;
        return $data;
    }
}
