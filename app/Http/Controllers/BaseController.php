<?php

namespace App\Http\Controllers;

use App\Chat;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

abstract class BaseController extends Controller
{

    protected $model;
    protected $resource;

    public function __construct($model, $resource = null)
    {
        $this->model = $model;
        $this->resource = $resource;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Collection|Model[]|AnonymousResourceCollection
     */
    public function index()
    {
        try{
            return $this->response($this->model::all());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Collection|Model|AnonymousResourceCollection|Response
     */
    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $model->fill($request->all());
            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Collection|Model|AnonymousResourceCollection|Response
     */
    public function show($id)
    {
        try{
            return $this->response( $this->model::find($id));
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        try{
            $model = $this->model::find($id);
            $model->fill($request->all());
            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $model = $this->model::find($id);
            $model->delete();

            return response()->json([
                'message' => $this->model.' deleted'
            ], 200);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function forceDestroy($id)
    {
        try{
            $model = $this->model::find($id);
            $model->forceDelete();

            return response()->json([
                'message' => $this->model.' deleted'
            ], 200);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $result
     * @return Collection|Model|AnonymousResourceCollection
     */
    public function response($result)
    {
        if ($result instanceof Model){
            return $this->resource ? new $this->resource($result) : $result;
        }

        if ($result instanceof Collection){
            return $this->resource ? $this->resource::collection($result) : $result;
        }

    }
}
