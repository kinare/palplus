<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends BaseController
{

    public function __construct()
    {
        parent::__construct(Admin::class, AdminResource::class);
    }

    /**
     * @SWG\Get(
     *   path="/admin",
     *   tags={"Admins"},
     *   summary="",
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
     * @SWG\Get(
     *   path="/admin/{id}",
     *   tags={"Admins"},
     *   summary="Retrieve an Admin",
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
     * @SWG\Patch(
     *   path="/admin/{id}",
     *   tags={"Admins"},
     *   summary="Update an Admin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="name",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="phone",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="email",in="path",description="name",required=true,type="string"),
     *   @SWG\Parameter(name="super_admin",in="path",description="name",required=false,type="integer"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */


    /**
     * @SWG\Get(
     *   path="/admin/toggle-status/{id}",
     *   tags={"Admins"},
     *   summary="admin status change",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function toggleStatus($id)
    {
        $admin = Admin::find($id);
        $admin->active = !$admin->active;
        $admin->save();
        return new AdminResource($admin);
    }

    /**
     * @SWG\Get(
     *   path="/admin/deactivate/{id}",
     *   tags={"Admins"},
     *   summary="deactivate an admin",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function deactivate($id)
    {
        $admin = Admin::find($id);
        $admin->active = false;
        $admin->save();
        return new AdminResource($admin);
    }

    /**
     * @SWG\Delete(
     *   path="/admin/{id}",
     *   tags={"Admins"},
     *   summary="Soft delete an Admin",
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
     * @SWG\Delete(
     *   path="/admin/{id}/force",
     *   tags={"Admins"},
     *   summary="Force delete an Admin",
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
