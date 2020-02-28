<?php

namespace app\controllers;

use Yii;
use app\models\AgentIdentification;
use app\models\AgentIdentificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgentIdentificationController implements the CRUD actions for AgentIdentification model.
 */
class AgentIdentificationController extends Controller
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
        $searchModel = new AgentIdentificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AgentIdentification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AgentIdentification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = '', $token = '')
    {

        $row = \app\models\User::find()->Where(['id' => $id, 'auth_key' => $token])->one();
        if (empty($row)) {
            Yii::$app->getSession()->setFlash('danger', 'Your problem in resigtration process please do not disturb url, Now you can registration agin or contact to administrator.');
            return $this->redirect(['site/register']);
        }

        $agent = \app\models\AgentIdentification::find()->Where(['user_id' => $id])->one();
        if (!empty($agent)) {
            $model_login = new \app\models\LoginForm();
            $session = Yii::$app->session;
            $session->get('wallet_amount');
            $model_login->username = $session->get('username');
            $model_login->password = $session->get('password_hash');
            /*$aaa['LoginForm']=['username'=>$model->username,'password'=>$model->password];*/
            $model_login->login();
            //Yii::$app->getSession()->setFlash('success', 'Congratulation.You have sucessfully completed the registration process,Please check your mail box and verify the email');
            // die;
            $model_agent=\app\models\AgentIdentification::find()->Where(['user_id'=>$id])->one();
            return $this->redirect(['dashboard/confirm', 'id' => $model_agent->id]);
//            Yii::$app->getSession()->setFlash('danger', 'Your already registered , contact to administrator.');
//            return $this->redirect(['site/register']);
        }
        $model = new AgentIdentification();
        $model->user_id = $id;

        $countries_list=['226'=>'United States','38'=>'Canada','13'=>'Australia','21'=>'Belgium','58'=>'Denmark','80'=>'Germany'
            ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
            ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];

        if ($model->load(Yii::$app->request->post())) {
            $model->primary_date_issued = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['primary_date_issued']);
            $model->primary_date_expiry = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['primary_date_expiry']);
            $model->secondary_date_issued = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['secondary_date_issued']);
            $model->secondary_date_expiry = date('Y-m-d');
            if (isset($_POST['AgentIdentification']['secondary_date_expiry']))
                $model->secondary_date_expiry = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['secondary_date_expiry']);
            $model->date_issued = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['date_issued']);
            /*$model->mother_date_of_birth=\app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['mother_date_of_birth']);
            $model->father_date_of_birth=\app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['father_date_of_birth']);*/
            $model->address_date_issued = \app\components\GeneralHelper::inserDateformate($_POST['AgentIdentification']['address_date_issued']);
            $model->type = 'Birth Certificate';
            if (isset($_POST['AgentIdentification']['type']) && $_POST['AgentIdentification']['type'] != "")
                $model->type = $_POST['AgentIdentification']['type'];

            if ($model->save()) {
                $customers = \app\models\UserProfile::find()->where(['user_id' => $id])->one();
                Yii::$app->db->createCommand()->insert('message',
                    ['from_user' => $row['id'],
                        'to_user' => $row['id'],
                        'first_name' => $customers->first_name,
                        'last_name' => $customers->last_name,
                        'send_date' => date('Y-m-d H:i:s'),
                        'subject' => 'Invoice for Membership Number ' . $row['id'],
                        'message' => '<table>'
                                .'<tr><td colspan="2"><p>Web Picture Identification Inc o/a WebPicID<br>9 Highvale Cres Sherwood Park,<br> Alberta T8A 5J7 Canada</p></td></tr>'
                                .'<tr><td colspan="2"><p>' . $customers->first_name . '<br>'
                                . $customers->address . '<br>'
                                . $customers->city . ', ' . $customers->state . ', ' . $customers->post_code . '</p></td></tr>'
                                .'<tr><th colspan="2"><p>Invoice<br>' . date('F d Y') . '</p></th> </tr>'
                                .'<tr><th colspan="2">Invoice for Membership Number' . $row['id'] . '</th> </tr>'
                                .'<tr> <th>Membership</th><td>$25.00</td></tr>'
                                .'<tr><th>GST</th><td>$1.25 (5%)</td></tr>'
                                .'<tr> <th>Total</th><td>$26.25</td></tr>'
                                .'</table>',
                    ])->execute();

                $detail_link = \app\models\AccountStatement::find()->select(['detail_link' => '( MAX(`detail_link`)+ 1) '])->one()->detail_link;
                Yii::$app->db->createCommand()->insert('account_statement',
                    ['user_id' => $row['id'],
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s'),
                        'detail_link' => $detail_link,
                        'balance_forward' => '0',
                        'credit' => '0',
                        'debit' => '0',
                        'description' => 'Opening balance',
                        'current_balance' => '0',
                    ])->execute();
                $detail_link = \app\models\AccountStatement::find()->select(['detail_link' => '( MAX(`detail_link`)+ 1) '])->one()->detail_link;
                Yii::$app->db->createCommand()->insert('account_statement',
                    ['user_id' => $row['id'],
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s'),
                        'detail_link' => $detail_link,
                        'balance_forward' => '0',
                        'credit' => '0',
                        'debit' => '26.25',
                        'description' => 'Membership Invoice',
                        'current_balance' => '-26.25',
                    ])->execute();


                /* Yii::$app->db->createCommand()->insert('message',
                         [    'from_user' => $row['id'],
                              'to_user' => $row['id'],
                             'first_name' => $customers->first_name,
                             'last_name' => $customers->last_name,
                             'send_date'=>date('Y-m-d H:i:s'),
                              'subject'=> 'Invoice for Family Protection Number '.$row['id'],
                              'message'=>'<b>Invoice for Membership Number</b>'.$row['id'].'<br>Family Protection               $20.00
                                                   GST                                   $  1.00    5%
                                                    Total                                  $21.00',
                         ])->execute();*/
                $email_agent = $_POST['AgentIdentification']['email_agent'];
                $admin_email = Yii::$app->params['adminEmail'];
                $mail = Yii::$app->mailer->compose(['html' => 'accountActivationToken'], ['username' => $row['username'], 'name' => $customers->first_name,'account_activation_token' => $row['account_activation_token']]);
                $sub = Yii::$app->name . ' user registration and email verification';
                $mail->setFrom('idtflrdemo@webpicid.com');
                //Yii::$app->params['adminEmail']
                $mail->setTo($email_agent);
                $mail->setSubject($sub);
                $data = $mail->send();
                if($data) return $this->redirect(['site/snapshot1','id'=>$id,'token'=>$row['account_activation_token']]);
                //return $this->refresh();
//                $model_login = new \app\models\LoginForm();
//                $session = Yii::$app->session;
//                $session->get('wallet_amount');
//                $model_login->username = $session->get('username');
//                $model_login->password = $session->get('password_hash');
//                /*$aaa['LoginForm']=['username'=>$model->username,'password'=>$model->password];*/
//                $model_login->login();
//                //Yii::$app->getSession()->setFlash('success', 'Congratulation.You have sucessfully completed the registration process,Please check your mail box and verify the email');
//                // die;
//
//                return $this->redirect(['dashboard/confirm', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'id' => $id, 'token' => $token,
            'countries_list' => $countries_list
        ]);

    }

    /**
     * Updates an existing AgentIdentification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AgentIdentification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AgentIdentification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AgentIdentification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AgentIdentification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
