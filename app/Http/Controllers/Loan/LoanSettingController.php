<?php

namespace App\Http\Controllers\Loan;

use App\GroupSetting;
use App\Http\Controllers\BaseController;
use App\Http\Resources\LoanSettingResource;
use App\LoanSetting;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\settle;

class LoanSettingController extends BaseController
{
    public function __construct($model = LoanSetting::class, $resource = LoanSettingResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/loan/settings",
     *   tags={"Loan Settings"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   summary="Retrieve Loan Settings",
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Post(
     *   path="/loan/settings",
     *   tags={"Loan Settings"},
     *   summary="Create Loan Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group id",required=true,type="integer"),
     *   @SWG\Parameter(name="qualification_period",in="query",description="qualification period",required=true,type="integer"),
     *   @SWG\Parameter(name="repayment_period",in="query",description="repayment period",required=true,type="integer"),
     *   @SWG\Parameter(name="fixed_amount",in="query",description="fixed amount",required=true,type="integer"),
     *   @SWG\Parameter(name="limit_rate",in="query",description="limit rate",required=false,type="number"),
     *   @SWG\Parameter(name="limit_amount",in="query",description="limit amount",required=false,type="number"),
     *   @SWG\Parameter(name="fixed_interest_amount",in="query",description="fixed_interest_amount",required=true,type="integer"),
     *   @SWG\Parameter(name="interest_amount",in="query",description="interest_amount",required=false,type="number"),
     *   @SWG\Parameter(name="interest_rate",in="query",description="interest_rate",required=false,type="number"),
     *   @SWG\Parameter(name="fixed_late_payment",in="query",description="fixed_late_payment (true/false)",required=false,type="integer"),
     *   @SWG\Parameter(name="late_payment_rate",in="query",description="late_payment_rate",required=false,type="number"),
     *   @SWG\Parameter(name="late_payment_amount",in="query",description="late_payment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="show_loans",in="query",description="show_loans",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function store(Request $request)
    {
        try{
            $setting = LoanSetting::where('group_id', $request->group_id)->first();
            $model = $setting ? $setting : new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            $model->save();
            return $this->response($model);
        }catch (\Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Patch(
     *   path="/loan/settings/{id}",
     *   tags={"Loan Settings"},
     *   summary="Update Loan Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Setting id",required=true,type="string"),
     *   @SWG\Parameter(name="qualification_period",in="query",description="qualification period",required=true,type="integer"),
     *   @SWG\Parameter(name="repayment_period",in="query",description="repayment period",required=true,type="integer"),
     *   @SWG\Parameter(name="fixed_amount",in="query",description="fixed amount",required=true,type="integer"),
     *   @SWG\Parameter(name="limit_rate",in="query",description="limit rate",required=false,type="number"),
     *   @SWG\Parameter(name="limit_amount",in="query",description="limit amount",required=false,type="number"),
     *   @SWG\Parameter(name="fixed_interest_amount",in="query",description="fixed_interest_amount",required=true,type="integer"),
     *   @SWG\Parameter(name="interest_amount",in="query",description="interest_amount",required=false,type="number"),
     *   @SWG\Parameter(name="interest_rate",in="query",description="interest_rate",required=false,type="number"),
     *   @SWG\Parameter(name="fixed_late_payment",in="query",description="fixed_late_payment (true/false)",required=false,type="integer"),
     *   @SWG\Parameter(name="late_payment_rate",in="query",description="late_payment_rate",required=false,type="number"),
     *   @SWG\Parameter(name="late_payment_amount",in="query",description="late_payment_amount",required=false,type="number"),
     *   @SWG\Parameter(name="show_loans",in="query",description="show_loans",required=true,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Get(
     *   path="/loan/settings/{id}",
     *   tags={"Loan Settings"},
     *   summary="Retrieve Loan Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Setting id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/loan/settings/{id}",
     *   tags={"Loan Settings"},
     *   summary="Delete Loan Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Setting id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/loan/settings/{id}/force",
     *   tags={"Loan Settings"},
     *   summary="Force delete Loan Settings",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Loan Setting id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
}
