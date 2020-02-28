<?php

namespace app\components;

use yii;

class GeneralHelper {

    public static function getCountryName($country_id='') { 
      $country_names=\app\models\Country::find()->Where(['id'=>$country_id])->one();
      if($country_names){
        return $country_names['nicename'];
      }
      else{
          return '---';
      }  
          
      }
    public static function getClientName($agent_id='') { 
      $agent_id=\app\models\User::find()->Where(['id'=>$agent_id])->one();
        if($agent_id){
          return $agent_id['name'];
        }
        else{
            return '---';
        }           
    }
    public static function inserDateformate($date='') { 
     return date('Y-m-d',strtotime($date));
   }
}
