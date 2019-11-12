<?php

namespace App;

class ContributionType extends BaseModel
{
    protected $fillable = [
      'group_id',
      'contribution_periods_id',
      'contribution_categories_id',
      'activity_id',
      'name',
      'description',
      'amount',
      'target_amount',
      'balance',
    ];
}
