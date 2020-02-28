<?php

namespace app\modules\backend\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\User;

class DefaultController extends Controller
{
    public function actionIndex()
    {  
      
        $total=[];//Product::find()->where(['user_id'=>Yii::$app->user->id])->all();
        $pending=[];//Product::find()->where(['published'=>0,'user_id'=>Yii::$app->user->id])->orderBy('id DESC')->all();
        $unpending=[];//Product::find()->where(['published'=>1,'user_id'=>Yii::$app->user->id])->all();
        
        $month=$this->getMonth();   
          //  echo "<pre>"; print_r($month);
           //die;
        
           
                return $this->render('index',[
                'total'=>$total,
                'pending'=>$pending,
                'unpending'=>$unpending,
                'month'=>$month,
                    ]);
            
    }
    public function getMonth(){
       $yourYear = date('Y');
        $yourMonth=[1,2,3,4,5,6,7,8,9,10,11,12];
        $month=array();
        foreach ($yourMonth as $key => $value) { 
          if($value==1){
            $values_month='jan';  
          }
          elseif($value==2){ 
            $values_month='Feb';  
          }
          elseif($value==3){
            $values_month='March';  
          }
          elseif($value==4){
            $values_month='April';  
          }
          elseif($value==5){
            $values_month='May';  
          }
          elseif($value==6){
            $values_month='Jun';  
          }
          elseif($value==7){
            $values_month='Jul';  
          }
          elseif($value==8){
            $values_month='Aug';  
          }
          elseif($value==9){
            $values_month='Sep';  
          }
          elseif($value==10){
            $values_month='Oct';  
          }
          elseif($value==11){
            $values_month='Nov';  
          }
          else{
            $values_month='Dec';
          }  
         $attt = \app\models\AgentIdentification::find()->select('*')->where("MONTH(created) = $value")->andWhere("YEAR(created) = $yourYear")->all();
         $count=count($attt);
         $month[]=["y"=>$count,"label"=>$values_month];
        }
        return $month; 
    }
}
