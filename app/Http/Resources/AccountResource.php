<?php

namespace App\Http\Resources;

use App\AccountType;
use Illuminate\Http\Resources\Json\JsonResource;


class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent=>:toArray($request);

        return [
            "id"=>$this->id,
            "user_id"=> $this->user_id,
            "account_type_id"=> $this->account_type_id,
            "account_type" => AccountType::find($this->account_type_id),
            "number"=> $this->number,
            "firstname"=> $this->firstname,
            "lastname"=> $this->lastname,
            "beneficiary"=> $this->beneficiary,
            "address"=> $this->address,
            "email"=> $this->email,
            "phonenumber"=> $this->phonenumber,
            "currency"=> $this->currency,
            "country"=> $this->country,
            "cvv"=> $this->cvv,
            "payment_type"=> this->payment_type,
            "accountbank"=> $this->accountbank,
            "passcode"=> $this->passcode,
            "bvn"=> $this->bvn,
            "expirymonth"=> $this->expirymonth,
            "expiryyear"=> $this->expiryyear,
            "billingzip"=> $this->billingzip,
            "billingcity"=> $this->billingcity,
            "billingaddress"=> $this->billingaddress,
            "billingstate"=> $this->billingstate,
            "billingcountry"=> $this->billingcountry,
            "created_by"=> $this->created_by,
            "modified_by"=> $this->modified_by,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
            "deleted_at"=> $this->deleted_at
        ];
    }
}
