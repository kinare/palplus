<?php

namespace App\Http\Controllers\Contributions;

use App\ContributionPeriod;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ContributionPeriodResource;
use Illuminate\Http\Request;

class ContributionPeriodController extends BaseController
{
    public function __construct($model = ContributionPeriod::class, $resource = ContributionPeriodResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/contribution/periods",
     *   tags={"Contributions"},
     *   summary="Retrieve Contribution Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
}
