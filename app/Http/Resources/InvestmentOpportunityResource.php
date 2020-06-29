<?php

namespace App\Http\Resources;

use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentOpportunityResource extends JsonResource
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
			'id'=>$this->id,
			'title'=>$this->title,
			'description'=>$this->description,
			'image'=>$this->image,
			'featured'=>$this->featured,
			'amount'=>$this->amount,
			'created_by'=>$this->created_by,
			'modified_by'=>$this->modified_by,
			'created_at'=>$this->created_at->format('Y-m-d'),
			'updated_at'=>$this->updated_at->format('Y-m-d'),
		];
        $data['currency'] = Wallet::group($this->group_id)->walletCurrency();
        $data["image"] => $this->getAvatarUrlAttribute();
        return $data;
    }
}
