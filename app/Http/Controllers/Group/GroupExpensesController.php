<?php

namespace App\Http\Controllers;

use App\GroupExpenses;
use App\Http\Resources\GroupExpensesResource;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class GroupExpensesController extends BaseController
{
    public function __construct($model = GroupExpenses::class, $resource = GroupExpensesResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/expense",
     *   tags={"Expenses"},
     *   summary="Retrieve Expenses",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Post(
     *   path="/expense",
     *   tags={"Expenses"},
     *   summary="Create expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity_id",required=true,type="string"),
     *   @SWG\Parameter(name="supplier_id",in="query",description="supplier_id",required=false,type="string"),
     *   @SWG\Parameter(name="date",in="query",description="date",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="string"),
     *   @SWG\Parameter(name="document_no",in="query",description="document_no",required=true,type="string"),
     *   @SWG\Parameter(name="total",in="query",description="total",required=true,type="string"),
     *   @SWG\Parameter(name="photo",in="query",description="photo",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/expense/{id}",
     *   tags={"Expenses"},
     *   summary="Update expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Parameter(name="group_id",in="query",description="group_id",required=true,type="string"),
     *   @SWG\Parameter(name="activity_id",in="query",description="activity_id",required=true,type="string"),
     *   @SWG\Parameter(name="supplier_id",in="query",description="supplier_id",required=false,type="string"),
     *   @SWG\Parameter(name="date",in="query",description="date",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=true,type="string"),
     *   @SWG\Parameter(name="amount",in="query",description="amount",required=true,type="string"),
     *   @SWG\Parameter(name="document_no",in="query",description="document_no",required=true,type="string"),
     *   @SWG\Parameter(name="total",in="query",description="total",required=true,type="string"),
     *   @SWG\Parameter(name="photo",in="query",description="photo",required=false,type="string"),
     *   @SWG\Parameter(name="type",in="query",description="type",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="group Description",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/expense/{id}",
     *   tags={"Expenses"},
     *   summary="Retrieve expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/expense/{id}",
     *   tags={"Expenses"},
     *   summary="Delete expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/expense/{id}/force",
     *   tags={"Expenses"},
     *   summary="Force delete expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/expense/group/{group_id}/",
     *   tags={"Expenses"},
     *   summary="Force delete expense",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="group_id",in="path",description="group id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param $group_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byGroup($group_id)
    {
        try{
            return GroupExpensesResource::collection(GroupExpenses::where('group_id', $group_id )->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    /**
     * @SWG\Get(
     *   path="/expense/activity/{activity_id}/",
     *   tags={"Expenses"},
     *   summary="Group Expenses",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="activity_id",in="path",description="activity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function byActivity($activity_id)
    {
        try{
            return GroupExpensesResource::collection(GroupExpenses::where('activity_id', $activity_id )->get());
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
