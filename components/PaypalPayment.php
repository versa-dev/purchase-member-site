<?php

namespace app\components;

use yii;


/**
 * Processs payment Via PAYPAL API
 */
class PaypalPayment
{
    private $paymentMethod = 'DoDirectPayment';
    private $paymentType = 'Sale';
    private $currencyCode = 'USD';// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

    public function paypalHttpPost($paymentInfo)
    {
        ini_set('memory_limit', '-1');
        $API_Endpoint =  "https://api-3t.sandbox.paypal.com/nvp";//Yii::$app->params['paypal_configuration']['API_ENDPOINT'];
        $API_UserName =  'babula_1358330732_biz_api1.gmail.com';//urlencode(Yii::$app->params['paypal_configuration']['API_USERNAME']);
        $API_Password ='1358330782';//urlencode(Yii::$app->params['paypal_configuration']['API_PASSWORD']);
        $API_Signature = 'AFcWxV21C7fd0v3bYYYRCpSSRl31ATNzMWf8oMERGIMeyVq3RlA3KPyw';//urlencode(Yii::$app->params['paypal_configuration']['API_SIGNATURE']);
        $API_VERSION = 60.0;//urlencode(Yii::$app->params['paypal_configuration']['API_VERSION']);

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_SSLVERSION , 6);
        
        $paymentParameters = array(
            'METHOD' => urlencode($this->paymentMethod),
            'VERSION' => $API_VERSION,
            'PWD' => $API_Password,
            'USER' => $API_UserName,
            'SIGNATURE' => $API_Signature,
            'PAYMENTACTION' => urlencode($this->paymentType),
            'CURRENCYCODE' => urlencode($this->currencyCode),
            'IPADDRESS' => $_SERVER['REMOTE_ADDR']
        );
        $paymentParameters = array_merge($paymentParameters, $paymentInfo);

        // Set the API operation, version, and API signature in the request.
        $nvpreq = $this->build_http_query($paymentParameters);
       // echo  $nvpreq;die;
        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

        // Get response from the server.
        $httpResponse = curl_exec($ch);
        if( $httpResponse === null || $httpResponse == FALSE || $httpResponse == '' ){
            return false;
        }

        // Extract the response details.
        $httpResponseAr = explode("&", $httpResponse);
        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }

        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            Yii::$app->getSession()->setFlash('error', 'Invalid HTTP Response for Payment Process due to server internal error !!');
        }

        return $httpParsedResponseAr;
    }

    function build_http_query( $query ){
        $query_array = array();

        foreach( $query as $key => $key_value ){
            $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
        }

        return implode( '&', $query_array );
    }
}

