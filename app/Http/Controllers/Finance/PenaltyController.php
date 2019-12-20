<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PenaltyResource;
use App\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends BaseController
{
    public function __construct($model = Penalty::class, $resource = PenaltyResource::class)
    {
        parent::__construct($model, $resource);
    }


}
