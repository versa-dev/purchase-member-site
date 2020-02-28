<?php

/**
 * Description of CategoryTree
 * This widget draw cateory tree drop down list
 * Required params: parent_id (int, default 0), name (string), id (string), excludelist(array, default empty)
 * @author Deepak Singh Kushwah
 */

namespace app\components;

use yii;
use app\models\User;

class EmailCenter {

    /**
     * 
     * @param int $parent_id
     * @param string $name
     * @param string $id
     * @param array $exclude
     * @return string
     */
    //public $data;
    public function sendNewProductMail() {
    $senduser = User::find()->where(['id' => Yii::$app->user->id])->one();
    $admin = User::find()->where(['usertype' => 'admin'])->one();
     return Yii::$app->mailer->compose('newItem-html', ['admin_usernamer' =>$admin['username'],'senduser_usernamer'=>$senduser])
            ->setFrom($senduser['email'])
            ->setTo($admin['email'])
            ->setSubject('One new product in uploaded by ' . $senduser['username'])
            ->send();
        
    }

    

   
}
