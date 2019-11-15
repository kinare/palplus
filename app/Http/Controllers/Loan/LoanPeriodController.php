<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\BaseController;
use App\Http\Resources\LoanPeriodResource;
use App\LoanPeriod;
use Illuminate\Http\Request;

class LoanPeriodController extends BaseController
{
   public function __construct($model = LoanPeriod::class, $resource = LoanPeriodResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/loan/periods",
     *   tags={"Loan Periods"},
     *   summary="Retrieve Loan Periods",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/loan/periods",
     *   tags={"Loan Periods"},
     *   summary="Create Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="period",in="query",description="period",required=true,type="string"),
     *   @SWG\Parameter(name="days",in="query",description="days",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/loan/periods/{id}",
     *   tags={"Loan Periods"},
     *   summary="Update Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Period id",required=true,type="string"),
     *   @SWG\Parameter(name="period",in="query",description="period",required=true,type="string"),
     *   @SWG\Parameter(name="days",in="query",description="days",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/loan/periods/{id}",
     *   tags={"Loan Periods"},
     *   summary="Retrieve Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Period id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/loan/periods/{id}",
     *   tags={"Loan Periods"},
     *   summary="Delete Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Period id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/loan/periods/{id}/force",
     *   tags={"Loan Periods"},
     *   summary="Force delete Loan Periods",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Period id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
