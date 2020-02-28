<?php

/**
 * @author Deepak Singh Kushwah
 */
namespace app\components;

use yii;
class IpLocation{

    public function getLocation($ip) {
        $url = 'http://ip-api.com/php/'.$ip;
        $result = $this->curl($url);
        $data = unserialize($result);
        return $data;
    }

    public function curl($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        //curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_FORBID_REUSE, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        $result = curl_exec($ch);
        if (!($res = curl_exec($ch))) {
            echo "Got " . curl_error($ch) . " when processing IPN data";
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        return $result;
    }
    public function get_public_ip_address()
            {
             // TODO: Add a fallback to http://httpbin.org/ip
             // TODO: Add a fallback to http://169.254.169.254/latest/meta-data/public-ipv4
            
             $url="simplesniff.com/ip";
            
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
             $data = curl_exec($ch);
             curl_close($ch);
            
             return $data;
            }
    public function get_user_ip_address($force_string=NULL)
        {
         $ip_addresses = array();
         $ip_elements = array(
          'HTTP_X_FORWARDED_FOR', 'HTTP_FORWARDED_FOR',
          'HTTP_X_FORWARDED', 'HTTP_FORWARDED',
          'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_CLUSTER_CLIENT_IP',
          'HTTP_X_CLIENT_IP', 'HTTP_CLIENT_IP',
          'REMOTE_ADDR'
         );
        
         foreach ( $ip_elements as $element ) {
          if(isset($_SERVER[$element])) {
           if ( !is_string($_SERVER[$element]) ) {
            // Log the value somehow, to improve the script!
            continue;
           }
        
           $address_list = explode(',', $_SERVER[$element]);
           $address_list = array_map('trim', $address_list);
        
           // Not using array_merge in order to preserve order
           foreach ( $address_list as $x ) {
            $ip_addresses[] = $x;
           }
          }
         }
        
         if ( count($ip_addresses)==0 ) {
          return FALSE;
        
         } elseif ( $force_string===TRUE || ( $force_string===NULL && count($ip_addresses)==1 ) ) {
          return $ip_addresses[0];
        
         } else {
          return $ip_addresses;
         }
        }
   public function geoCheckIP($ip)
 
    {
         
        //check, if the provided ip is valid
         
        if(!filter_var($ip, FILTER_VALIDATE_IP))
         
        {
         
            throw new InvalidArgumentException("IP is not valid");
         
        }
         
        //contact ip-server
         
        $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
         
        if (empty($response))
         
        {
         
            throw new InvalidArgumentException("Error contacting Geo-IP-Server");
         
        }
         
        //Array containing all regex-patterns necessary to extract ip-geoinfo from page
         
        $patterns=array();
         
        $patterns["domain"] = '#Domain: (.*?)&nbsp;#i';
         
        $patterns["country"] = '#Country: (.*?)&nbsp;#i';
         
        $patterns["state"] = '#State/Region: (.*?)<br#i';
         
        $patterns["town"] = '#City: (.*?)<br#i';
         
        //Array where results will be stored
         
        $ipInfo=array();
         
        
         
        //check response from ipserver for above patterns
         
        foreach ($patterns as $key => $pattern)
         
        {
         
        //store the result in array
         
            $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
         
        }
        /*I've included the substr function for Country to exclude the abbreviation (UK, US, etc..)
        To use the country abbreviation, simply modify the substr statement to:
        substr($ipInfo["country"], 0, 3)
        */
        $data = array();
        #$ipdata = $ipInfo["town"]. ", ".$ipInfo["state"].", ".substr($ipInfo["country"], 4);
        if(!empty($ipInfo)){
            $data['visitor_ip']   = $ip;
            $data['visitor_city'] = $ipInfo["town"];
            $data['visitor_state'] = $ipInfo["state"];
            $data['visitor_country'] =  substr($ipInfo["country"], 4);
            if(isset($ipInfo["country"])){
                $code = explode('-',$ipInfo["country"]);
                if(isset($code[0])){
                    $data['visitor_country_code'] = trim(str_replace(' ','',$code[0]));
                }
            }
        }
        return $data;
         
     }

}
