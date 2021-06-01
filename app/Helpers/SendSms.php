<?php
/**
 * Created by PhpStorm.
 * User: Adil Mughal
 * Date: 12/24/2019
 * Time: 6:34 PM
 */

namespace App\Helpers;

use SoapClient;

Abstract Class SendSms
{
    public function sendSMS($phone_no, $text)
    {
        try {


            $username = '03011166963';
            $pass = 'Jazz@123';
            $mask = 'QALBISH';
            $to = $phone_no;
            $message = $text;

            $url = "https://connect.jazzcmt.com/sendsms_url.html?Username=" . $username . "&Password=" . $pass . "&From=" . urlencode($mask) . "&To=" . urlencode($to) . "&Message=" . urlencode($message);

            //setting the curl parameters.
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);


            $data = curl_exec($ch);

            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


            if (!curl_errno($ch)) {
                $info = curl_getinfo($ch);

            }

            curl_close($ch);


//            print_r('<pre>');
//            print_r($data);
//            print_r('</pre>');
            return true;
        } catch (\Exception $e) {
//            dd($e);
            return $e->getMessage();
        }
    }
}
