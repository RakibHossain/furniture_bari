<?php 

function sendSMS($to, $message)
{
    $token = "d0c3bc00da6f70fe39c9016eeaaca362";
    $url   = "http://sms.greenweb.com.bd/api.php";

    $data = [

        'to'      => $to,
        'message' => $message,
        'token'   => $token

    ]; // Add parameters in key value

    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    curl_close($ch);
    
    if(!$smsresult)
    {
        return false;
    }
    else
    {
        return true;
    }

}
