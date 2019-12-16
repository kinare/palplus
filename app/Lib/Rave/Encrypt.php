<?php


namespace App\Lib\Rave;

class Encrypt
{
    public static function getKey(){
        $seckey = Config::getConfig('RAVE_SECRET_KEY');
        $hashedkey = md5($seckey);
        $hashedkeylast12 = substr($hashedkey, -12);

        $seckeyadjusted = str_replace("FLWSECK-", "", $seckey);
        $seckeyadjustedfirst12 = substr($seckeyadjusted, 0, 12);

        $encryptionkey = $seckeyadjustedfirst12.$hashedkeylast12;
        return $encryptionkey;
    }

    public static function encrypt3Des($data){
        $encData = openssl_encrypt($data, 'DES-EDE3', self::getKey(), OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }
}
