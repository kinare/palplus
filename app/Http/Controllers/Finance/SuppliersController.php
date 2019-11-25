<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SupplierResource;
use App\Suppliers;

class SuppliersController extends BaseController
{
   public function __construct($model = Suppliers::class, $resource = SupplierResource::class)
   {
       parent::__construct($model, $resource);
   }

    /**
     * @SWG\Get(
     *   path="/supplier",
     *   tags={"Supplier"},
     *   summary="Retrieve Supplier",
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
     *   path="/supplier",
     *   tags={"Supplier"},
     *   summary="Create Supplier",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=false,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=false,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="amount_paid",in="query",description="amount_paid",required=true,type="number"),
     *   @SWG\Parameter(name="amount_pending",in="query",description="amount_pending",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Patch(
     *   path="/supplier/{id}",
     *   tags={"Supplier"},
     *   summary="Update Supplier",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="supplier id",required=true,type="string"),
     *   @SWG\Parameter(name="name",in="query",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="location",in="query",description="location",required=false,type="string"),
     *   @SWG\Parameter(name="description",in="query",description="description",required=false,type="string"),
     *   @SWG\Parameter(name="phone",in="query",description="phone",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="query",description="email",required=false,type="string"),
     *   @SWG\Parameter(name="currency",in="query",description="currency",required=true,type="string"),
     *   @SWG\Parameter(name="amount_paid",in="query",description="amount_paid",required=true,type="number"),
     *   @SWG\Parameter(name="amount_pending",in="query",description="amount_pending",required=true,type="number"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Get(
     *   path="/supplier/{id}",
     *   tags={"Supplier"},
     *   summary="Retrieve a Supplier",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="supplier id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/supplier/{id}",
     *   tags={"Supplier"},
     *   summary="Delete Supplier",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="supplier id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/supplier/{id}/force",
     *   tags={"Supplier"},
     *   summary="Force delete Supplier",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="supplier id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */






}
