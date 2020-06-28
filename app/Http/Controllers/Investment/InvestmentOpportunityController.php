<?php

namespace App\Http\Controllers\Investment;

use App\AdvertSetup;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Currency\Converter;
use App\Http\Controllers\Finance\Transaction;
use App\Http\Resources\InvestmentOpportunityResource;
use App\InvestmentOpportunity;
use App\Wallet;
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
    public function index()
    {
        try{
            return $this->response($this->model::orderBy('id', 'DESC')->get());
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

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
     *   @SWG\Parameter(name="featured",in="formData",description="featured",required=false,type="integer"),
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
                $model->image =  'investment.png';
            }
			$wallet = Wallet::mine();
			$adSetup = AdvertSetup::whereType('INVESTMENT')->first();
			
			
			$adRate = Converter::convert($adSetup->currency, $wallet->currencyShortDesc(), (float)$adSetup->rate)['amount'];
			if ($request->featured){
                if (!$wallet->canWithdraw($adRate)){
                    $model->featured = 0;
                    $model->save();
                    return response()->json([
                        'message' => 'Your event would not be featured due to insufficient funds'
                    ]);
				}
				


                $transaction = new Transaction();
                $transaction->transact(
                    $wallet,
                    Wallet::app(),
                    $adRate,
                    'Ad Payment',
                    'Investment opportunity add payment'
                );
			}

			//Create an investment opportunity deduct the min_amount
			$wallet->total_balance =(float) $wallet->total_balance - (float)$adRate;
			$wallet->total_balance =(float) $wallet->total_withdrawals + (float)$adRate;
			$wallet->save();
			
			//save the investment
			$model->save();
			
			
			if(!((float)$wallet->total_balance > (float)$adRate)){
				return response()->json([
					'message' => "Your investment was not created. You have insufficient funds"
				]);
			}


            
			
			
            return $this->response($model);
        }catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }

    /**
     * @SWG\Get(
     *   path="/investment-opportunity/featured-rate",
     *   tags={"Investment Opportunity"},
     *   summary="Get featured rate",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function featuredRate(){
        $adSetup = AdvertSetup::whereType('INVESTMENT')->first();
        $adRate = Converter::Convert($adSetup->currency, Wallet::mine()->walletCurrency(), $adSetup->rate)['amount'];
        return response()->json([
            'message' => 'A fee of '.Wallet::mine()->walletCurrency().' '.$adRate.' applies for this featured investment opportunity.'
        ], 200);
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



	public function convertAmount ($from, $currency, $amount){
        $amount = Converter::Convert($from , $currency, $amount);
        return [
            'data' => [
                'amount' => $amount['amount'],
                'type' => "Convert amount"
            ]
        ];
	}
}
