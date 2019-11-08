<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestmentOpportunity extends BaseModel
{
    protected $fillable = [
      'title',
      'description',
      'image',
      'featured',
      'amount',
    ];

    protected $appends = ['avatar_url'];

    public function getAvatarUrlAttribute()
    {
        return url('/') .'/investments/investments/'.$this->created_by.'/'.$this->image;
    }
}
