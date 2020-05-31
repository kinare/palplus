<?php

namespace App\Http\Resources;

use App\Account;
use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

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
        $data = [
			"id" => $this->id,
			"transaction_code" => $this->transaction_code,
			"wallet_id" => $this->wallet_id,
			"entry" => $this->entry,
			"transaction_from" => $this->transaction_from,
			"transaction_to" => $this->transaction_to,
			"transaction_type" => $this->transaction_type,
			"account_no" => $this->account_no,
			"type" => $this->type,
			"description" => $this->description,
			"model" => $this->model,
			"model_id" => $this->model_id,
			"amount" => $this->amount,
			"from_currency" => $this->from_currency,
			"to_currency" => $this->to_currency,
			"conversion_rate" => $this->conversion_rate,
			"conversion_time" => $this->conversion_time,
			"created_by" => new UserResource($this->created_by),
			"modified_by" => $this->modified_by,
			"created_at" => $this->created_at->format('Y-m-d'),
			"updated_at" => $this->updated_at->format('Y-m-d'),
		];
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
