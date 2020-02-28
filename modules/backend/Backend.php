<?php

namespace app\modules\backend;
use yii;
use yii\web\Response;
class Backend extends \yii\base\Module {

    public $controllerNamespace = 'app\modules\backend\controllers';

    public function init() {
        parent::init();
        Yii::$app->view->theme->pathMap = ['@app/views' => '@themes/admin/views'];
       /* if(!key_exists('Admin', Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))){ 
            return Yii::$app->getResponse()->redirect(['site/index']);

        }*/
      
         

        // custom initialization code goes here
    }

}
