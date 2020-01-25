<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\BaseController;
use App\Lib\Rave\Transfer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RaveController extends BaseController
{
    /**
     * @SWG\Get(
     *   path="/gateway/rave/transfer-countries",
     *   tags={"Gateway"},
     *   summary="Get Transfere Countries",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function getRaveTransferCountries(){
        return Transfer::transferCountries();
    }

    /**
     * @SWG\Get(
     *   path="/gateway/rave/transfer-banks/{countryCode}",
     *   tags={"Gateway"},
     *   summary="Get Transfere Countries",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Parameter(name="countryCode",in="path",description="Country Code",required=true,type="string"),
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     *
     * )
     */
    public function getBanksForTransfer($countryCode){
        return Transfer::getBanksForTransfer($countryCode);
    }
}
