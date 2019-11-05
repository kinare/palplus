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
}
