<?php

namespace App\Http\Controllers\Investment;

use App\Http\Controllers\BaseController;
use App\Http\Resources\InvestmentOpportunityResource;
use App\InvestmentOpportunity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class InvestmentOpportunityController extends BaseController
{
    public function __construct($model = InvestmentOpportunity::class, $resource = InvestmentOpportunityResource::class)
    {
        parent::__construct($model, $resource);
    }

    /**
     * @SWG\Get(
     *   path="/investment-opportunity",
     *   tags={"Investment Opportunity"},
     *   summary="Retrieve Investment Opportunity",
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
     *   path="/investment-opportunity",
     *   tags={"Investment Opportunity"},
     *   summary="Create Investment Opportunity",
     *  produces={"application/json"},
     *  consumes={"multipart/form-data"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="title",in="formData",description="title",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="image",in="formData",description="image",required=false,type="file"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="string"),
     *   @SWG\Parameter(name="amount",in="formData",description="amount",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */

    public function store(Request $request)
    {
        try{
            $model = new $this->model();
            $data = $request->all();
            $model->fill($data);
            $model->created_by = $request->user()->id;
            if ($request->hasFile('image')){
                $attachment = [];
                $attachment['file'] = $request->file('image');
                $attachment['filename'] = $request->file('image')->getClientOriginalName();

                if (Storage::disk('investments')->exists("investments/" . $request->user()->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('investments')->put("investments/".$request->user()->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->image = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->title)->getImageObject()->encode('png');
                Storage::disk('investments')->put("investments/".$request->user()->id.'/investment.png', (string) $avatar);
                $model->avatar =  'investment.png';
            }

            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }


    /**
     * @SWG\Patch(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Update Investment Opportunity",
     *  produces={"application/json"},
     *  consumes={"multipart/form-data"},
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Parameter(name="title",in="formData",description="title",required=true,type="string"),
     *   @SWG\Parameter(name="description",in="formData",description="description",required=true,type="string"),
     *   @SWG\Parameter(name="image",in="formData",description="image",required=false,type="file"),
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="string"),
     *   @SWG\Parameter(name="amount",in="formData",description="amount",required=false,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    public function update(Request $request, $id)
    {
        try{
            $request->all();
            $model = $this->model::find($id);
            $model->fill($request->all());
            $model->modified_by = $request->user()->id;

            if ($request->hasFile('image')){
                $request->file('image');
                $attachment = [];
                $attachment['file'] = $request->file('image');
                $attachment['filename'] = $request->file('image')->getClientOriginalName();

                if (Storage::disk('investments')->exists("investments/" . $request->user()->id . '/' . $attachment['filename']))
                    $attachment['filename'] = uniqid().'.'.$attachment['file']->getClientOriginalExtension();

                Storage::disk('investments')->put("investments/".$request->user()->id.'/'.$attachment['filename'], file_get_contents($attachment['file']));
                $model->image = $attachment['filename'];
            }else{
                $avatar = Avatar::create($model->title)->getImageObject()->encode('png');
                Storage::disk('investments')->put("investments/".$request->user()->id.'/investment.png', (string) $avatar);
                $model->image =  'investment.png';
            }
            $model->save();
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Retrieve Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/investment-opportunity/{id}",
     *   tags={"Investment Opportunity"},
     *   summary="Delete Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */

    /**
     * @SWG\Delete(
     *   path="/investment-opportunity/{id}/force",
     *   tags={"Investment Opportunity"},
     *   summary="Force delete Investment Opportunity",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="id",in="path",description="Investment opportunity id",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */




}
