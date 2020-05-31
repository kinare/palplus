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



	public function user(){
        return $this->belongsTo(\App\User::class, 'created_by');
	}
	/**
	 * deposit
	 *
	 * Depositing cash to account
	 **/

	// public function setTransactionCodeAttribute(){
	// 	//get last record

	// 	$record = Transaction::latest()->first();
	// 	$expNum = explode('-', $record->transaction_code);

	// 	//check first day in a year
	// 	if ( date('l',strtotime(date('Y-01-01'))) ){
	// 		$nextInvoiceNumber =  date('Y').'-00001';
	// 	} else {
	// 		//increase 1 with last invoice number
	// 		$nextInvoiceNumber = $expNum[0].'-'. $expNum[1]+1;
	// 	}
	// 	dd($nextInvoiceNumber);
	// 	$this->attributes['transaction_code'] = $nextInvoiceNumber;
	// }
}
