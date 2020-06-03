<?php


namespace App\Lib\Rave;


use App\Lib\Http\HttpClient;

class Rave
{
    public function execute($data, String $url){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 200);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);

        $headers = array('Content-Type: application/json');

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $request = curl_exec($ch);

        if ($request){
            return json_decode($request, true);
        }elseif (curl_error($ch)){
            return curl_error($ch);
        }

        curl_close($ch);
    }

    public function encrypt($data){
        return Encrypt::encrypt3Des(json_encode($data));
    }

    public function initiate($data, $url){

        $data = Encrypt::encrypt3Des(json_encode($data));

        /* prepare postdata */
        $postdata = [
            'PBFPubKey' => Config::getConfig('RAVE_PUBLIC_KEY'),
            'client' => $data,
            'alg' => '3DES-24'
        ];

        /* Execute request */
        return $this->execute($postdata, $url);
    }

    public function validate($data, $url){
         $details = [
            'PBFPubKey' => Config::getConfig('RAVE_PUBLIC_KEY'),
            'transaction_reference' => $data['flwRef'],
            'otp' => $data['otp']
		];
		
		$response = $this->execute($details, $url);
		$res;
		if($response['status'] === 'successful'){
			$res = ['message' => 'Successfully processed your transaction'];
		}else {
			$res = ['message' => 'An error occurred during processing your transaction. Contact card owner'];
		}
        return $res;
    }

    public function verify($data, $url){
        $details = [
            'txref' => $data['txref'],
            'SECKEY' => Config::getConfig('RAVE_SECRET_KEY'),
		];
		
		$response = $this->execute($details, $url);
		$res;
		if($response['status'] === 'successful'){
			$res = ['message' => 'Successfully processed your transaction'];
		}else {
			$res = ['message' => 'An error occurred during processing your transaction. Contact card owner'];
		}
        return $res;
    }

}
