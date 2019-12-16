<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Integration\Paypal\ExpressCheckoutController;
use Illuminate\Http\Request;

class TestIntegration extends Controller
{
    private $gateway;

    public function  __construct()
    {
        $this->gateway = new ExpressCheckoutController();
    }

    /**
     * @SWG\Get(
     *   path="/gateway/test",
     *   tags={"Gateway"},
     *   summary="Test Integration",
     *  security={
     *     {"bearer": {}},
     *   },
     *   @SWG\Response(response=200, description="Success"),
     *   @SWG\Response(response=400, description="Not found"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function test(Request $request){
        $items = [
            [
                'name'  => 'Product 1',
                'price' => 9.99,
                'qty'   => 1,
            ],
            [
                'name'  => 'Product 2',
                'price' => 4.99,
                'qty'   => 2,
            ],
        ];

        $invoice = [
            'invoice_id' => 1,
            'invoice_description' => "testing invoice"
            ];

        $this->gateway->setItems($items);
        $this->gateway->setInvoice($invoice);

        try{
            return $this->gateway->checkout();
        }catch (\Exception $e){
            return $e;
        }
    }
}
