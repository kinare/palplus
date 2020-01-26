<?php

namespace App\Http\Resources;

use App\Account;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
        $data['currency'] = Wallet::find($data['wallet_id'])->walletCurrency();
//        $data['from'] = $this->getUser($data);
//        $data['to'] = $this->getUser($data, 'to');
        return $data;
    }

    public function getUser($transaction, $type = 'from'){
        if ($transaction['transaction_type'] === 'internal'){
            return $type === 'from'
                ? Wallet::find($transaction['transaction_from'])->user()->name
                : Wallet::find($transaction['transaction_to'])->user()->name;
        }

        if ($transaction['transaction_type'] === 'external'){
            if ($transaction['entry'] === 'credit'){
                return $type === 'from'
                    ? Account::find($transaction['transaction_from'])->name()
                    : Wallet::find($transaction['transaction_to'])->user()->name;
            }else{
                return $type === 'from'
                    ? Wallet::find($transaction['transaction_from'])->user()->name
                    : Account::find($transaction['transaction_to'])->name();
            }
        }
    }
}
