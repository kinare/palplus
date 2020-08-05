<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends BaseModel
{
    protected $fillable = [
        'user_id',
        'account_type_id',
        'number',
        'email',
        'phonenumber',
        'firstname',
        'lastname',
        'expirymonth',
        'expiryyear',
        'address',
        'country',
		'cvv',
		'cardno',
        'currency',
        'billingzip',
        'billingcity',
        'billingaddress',
        'billingstate',
        'billingcountry',
        'accountbank',
        'beneficiary'
    ];

    public function name(){
        return $this->firstname.' '.$this->lastname;
	}

	// public  function setNumberAttribute(){
	// 	$nextNumber = "";
	// 	$record = $this::latest()->first();
	// 	$expNum = explode('-', $record->number);

	// 	//check first day in a year
	// 	if (!$record){
	// 		$nextNumber = 'YU-00001';
	// 	} else {
	// 		//increase 1 with last invoice number
	// 		$nextNumber =  $expNum[0].'-'. $expNum[1]+1;
	// 	}

	// 	$attributes['number'] = $nextNumber;
	// }
}
