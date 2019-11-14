<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use App\Wallet;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    public function __construct($model = Transaction::class, $resource = TransactionResource::class)
    {
        parent::__construct($model, $resource);
    }


}
