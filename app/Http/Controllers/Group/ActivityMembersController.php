<?php

namespace App\Http\Controllers\Group;

use App\ActivityMembers;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ActivityMembersController extends BaseController
{
   public function __construct($model = null, $resource = null)
   {
       parent::__construct($model, $resource);
   }
}
