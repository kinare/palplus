<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupExpenses extends BaseModel
{
    protected $fillable = [
        'group_id', 'activity_id', 'supplier_id', 'date', 'description', 'location', 'amount', 'document_no', 'total', 'photo'
    ];
}
