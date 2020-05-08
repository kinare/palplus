<?php

namespace App\Http\Controllers\Group;

use App\GroupType;
use App\Http\Controllers\BaseController;
use App\Http\Resources\GroupTypeResource;

class GroupTypeController extends BaseController
{
    public function __construct($model = GroupType::class, $resource = GroupTypeResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/group-type",
     *   tags={"Group Type"},
     *   summary="Retrieve Group Types",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

	 public function index(){
		try{
            return $this->response($this->model->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
		}

    /**
     * @SWG\Post(
     *   path="/group-type",
     *   tags={"Group Type"},
     *   summary="Create Group Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="type",in="query",description="type",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Patch(
     *   path="/group-type/{id}",
     *   tags={"Group Type"},
     *   summary="Update Group Type",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="group id",required=true,type="string"),
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
     *   path="/group-type/{id}",
     *   tags={"Group Type"},
     *   summary="Retrieve Group Type",
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
     *   path="/group-type/{id}",
     *   tags={"Group Type"},
     *   summary="Delete Group Type",
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
     *   path="/group-type/{id}/force",
     *   tags={"Group Type"},
     *   summary="Force delete Group Type",
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


}
