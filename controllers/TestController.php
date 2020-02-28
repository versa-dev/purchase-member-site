<?php

namespace app\controllers;

use Dropbox\Exception;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgentIdentificationController implements the CRUD actions for AgentIdentification model.
 */
class TestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AgentIdentification models.
     * @return mixed
     */
    public function actionIndex()
    {
        echo 'index'; exit;
    }


    public function actionAaa()
    {
        try{
            $mail = Yii::$app->mailer->compose(
                ['html' => 'accountActivationToken'],
                ['username' => 'username',
                    'name' => 'first_name',
                    'account_activation_token' =>'account_activation_token'
                ]);
            $sub = Yii::$app->name . ' user registration and email verification';
            $mail->setFrom('idtflrdemo@webpicid.com');
            $mail->setTo('testone12@yandex.com');
            $mail->setSubject($sub);
            echo $mail->send();
            exit;
        } catch (Exception $e) {
            var_dump($e);
        }

    }

}
