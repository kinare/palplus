<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try{
            return AdminResource::collection(Admin::paginate(15));
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }


    /**
     * @SWG\Get(
     *   path="/admin",
     *   tags={"Admin Auth"},
     *   summary="Current Admin",
     *  security={
     *     {"passport": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     * @param $id
     * @return AdminResource|JsonResponse
     */
    public function show($id)
    {
        return new AdminResource( Admin::find($id));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->fill($request->all());
        $admin->save();
        return new AdminResource($admin);
    }

    public function activate($id)
    {
        $admin = Admin::find($id);
        $admin->active = true;
        $admin->save();
        return new AdminResource($admin);
    }

    public function deactivate($id)
    {
        $admin = Admin::find($id);
        $admin->active = false;
        $admin->save();
        return new AdminResource($admin);
    }

    public function delete($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }

    public function forceDelete($id)
    {
        $admin = Admin::find($id);
        $admin->forceDelete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 200);
    }
}
