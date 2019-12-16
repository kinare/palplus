<?php
namespace App\Http\Controllers\Integration\Rave;
use App\Http\Controllers\Controller;
use App\Lib\Flutterwave\Transfer as RaveTransfer;
use Illuminate\Http\Request;

class Transfer extends Controller
{
    public static function singleTransfer()
    {
        $array = array(
            'account_bank' => 'ACCESS BANK NIGERIA',
            'account_number' => '0690000044',
            'amount' => 5000,
            'seckey' => 'FLWSECK_TEST-b0f3aaf9b37c9cfb02f73e03c6d5b2de-X',
            'narration' => 'Goods delivery services',
            'currency' => "NGN",
            'reference' => "rave-".time()
        );

        $single = new RaveTransfer();
        $result = $single->singleTransfer($array);
        $trx = json_decode($result, true);
        return $trx;
    }
}
