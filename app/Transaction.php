<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends BaseModel
{
    protected $fillable = [
        'wallet_id',
        'type',
        'transaction_code',
        'account_no',
        'amount',
        'entry',
        'transaction_from',
        'transaction_to',
        'description',
        'from_currency',
        'to_currency',
        'conversion_rate',
        'conversion_time',
	];
	
	/**
	 * deposit
	 *
	 * Depositing cash to account
	 **/
	public function deposit($account_id, $wallet_id, $amount, $type, $description){
		$this->wallet_id = $wallet_id;
		$this->account_no = $account_id;
		$this->amount = $amount;
		$this->type = $type;
		$this->description = $description;
		$this->save();
		return $this;
	}

	public function setTransactionCodeAttribute(){
		//get last record
		$record = $this::latest()->first();
		$expNum = explode('-', $record->transaction_code);

		//check first day in a year
		if ( date('l',strtotime(date('Y-01-01'))) ){
			$nextInvoiceNumber =  date('Y').'-00001';
		} else {
			//increase 1 with last invoice number
			$nextInvoiceNumber = $expNum[0].'-'. $expNum[1]+1;
		}
		dd($nextInvoiceNumber);
		$this->attributes['transaction_code'] = $nextInvoiceNumber;
	}
}
