<?php

namespace app\controllers;

use app\models\Country;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use Yii;
use app\models\ChangePassword;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\AccountActivation;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserProfile;
use app\models\User;
use app\models\GeneralSetting;
use app\models\Product;
use app\models\HomeSlider;
use app\models\ProductCategory;
use yii\data\ActiveDataProvider;
use app\components\PaypalPayment;



class SiteController extends Controller {
   public $enableCsrfValidation = false;
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['Profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
                    'auth' => [
              'class' => 'yii\authclient\AuthAction',
              'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    public function actionIndex() {
      if($_POST){
         $query = User::find()->where(['username' => Yii::$app->request->post()['LoginForm']['username']])->one();
        if($query['status'] =='0'){
            Yii::$app->getSession()->setFlash('error', 'Your account is an inactive, please contact to the administrator.');
          return $this->redirect('site');
          }
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend']);
            }
            else{
                return $this->redirect(['/dashboard']);
            }

        }else{ 
            if(isset(Yii::$app->user->identity->id)){
               return $this->redirect(['/dashboard']);
            }
            else{
          return $this->render('index', [
                        'model' => $model,
            ]);
           }
        }
    }

    public function actionLogin() {
        return $this->redirect(['/site']);
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if($_POST){
         $query = User::find()->where(['username' => Yii::$app->request->post()['LoginForm']['username']])->one();
        if($query['status'] =='0'){
            Yii::$app->getSession()->setFlash('error', 'Your account is an inactive, please contact to the administrator.');
          return $this->redirect('login');
          }
        }


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend/user']);
            }
            else{
                return $this->redirect(['/site']);
            }

        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/site']);
       // return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->getSession()->setFlash('success', 'Thank you for contacting us!');
            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionRegister() {

        $model = new SignupForm();
        //$countries_list  = ArrayHelper::map(Country::find()->all(), 'id', 'nicename');
        $countries_list=['13'=>'Australia','21'=>'Belgium','38'=>'Canada','58'=>'Denmark','80'=>'Germany'
        ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
        ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];
        if ($model->load(Yii::$app->request->post())) {
         $password =  $_POST['SignupForm']['password'];
            if ($user = $model->signup()) {

                    $this->signupWithActivation($model, $user,$password);
                    return $this->refresh();
            }
        }

        return $this->render('register', [
                    'model' => $model,
                    'countries_list' => $countries_list
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'A link to reset your password has been sent to your email id.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password has has sucessfully saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }
 private function signupWithActivation($model, $user,$password)
    {
        // try to send account activation email
        if ($model->sendAccountActivationEmail($user,$password))
        {

            Yii::$app->session->setFlash('success',
               // Yii::t('app', 'Hello').' '.Html::encode($user->username). '. ' .
                Yii::t('app', 'Thank you for register with us! Login details with an activation link has been sent to your mail id to activate your account.'));
        }
        // email could not be sent
        else
        {
            // display error message to user
            Yii::$app->session->setFlash('error',
                Yii::t('app', 'We couldn\'t send you account activation email, please contact us.'));

            // log this error, so we can debug possible problem easier.
            Yii::error('Signup failed!
                User '.Html::encode($user->username).' could not sign up.
                Possible causes: verification email could not be sent.');
        }
    }

/*--------------------*
 * ACCOUNT ACTIVATION *
 *--------------------*/

    /**
     * Activates the user account so he can log in into system.
     *
     * @param  string $token
     * @return \yii\web\Response
     *
     * @throws BadRequestHttpException
     */
    public function actionActivateAccount($token)
    {
        try
        {
           $user = new AccountActivation($token);
        }
        catch (InvalidParamException $e)
        { 
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user->activateAccount())
        {
            Yii::$app->getSession()->setFlash('success',
                Yii::t('app', 'Success! You can now log in.').' '.
                Yii::t('app', 'Thank you').' '.Html::encode($user->username).' '.
                Yii::t('app', 'for joining us!'));
        }
        else
        {
            Yii::$app->getSession()->setFlash('error',
                Html::encode($user->username).
                Yii::t('app', 'your account could not be activated, please contact us!'));
        }

        return $this->redirect('login');
    }
 public function actionChangePassword(){
    $model = new ChangePassword(['scenario' => 'changepassword']);

        if ($model->load(Yii::$app->request->post())) {
          // print_r(Yii::$app->request->post()); die;
            if ($user = $model->changepassword()) {

                Yii::$app->session->setFlash('success', 'Your Password has been changed successfully');
            }
        }

        return $this->render('change-password', [
                    'model' => $model,

        ]);

 }

public function actionProfile(){


    $user=User::findById(Yii::$app->user->id);
    $user_roles=$user->getUserRoles();

    $country = new Country();
    //$countries_list=$country->getAllCountries();
    $countries_list=['13'=>'Australia','21'=>'Belgium','38'=>'Canada','58'=>'Denmark','80'=>'Germany'
        ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
        ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];

    $model = UserProfile::findProfileByUserId(Yii::$app->user->id);
   if(empty($model)){
     $model = new UserProfile();
     $model->user_id =Yii::$app->user->id;

   }
   $data=Yii::$app->request->post();

   if(isset($data['User']['usertype'])){
    $user->usertype=$data['User']['usertype'];
   }

      if ($model->load(Yii::$app->request->post()) && $model->save() && $user->save()) {
            $sql="update  auth_assignment set item_name = '".$user->usertype ."' WHERE user_id='".$user->id."'";
            Yii::$app->db->createCommand($sql)->execute();
            Yii::$app->session->setFlash('success', 'Your profile has been updated successfully.');
            return $this->redirect(['site/']);
      }

            return $this->render('profile', [
                    'model' => $model,
                    'user'=>$user,
                    'user_roles'=>$user_roles,
                    'countries_list' => $countries_list
            ]);
 }
 public function actionTest1(){
   $setting = new  GeneralSetting();
    $setting->getRate();
    $setting->getUserAmount(Yii::$app->user->id); die;
   // echo $url = 'http://'.$_SERVER['HTTP_HOST'];
    //echo "<pre>"; print_r($_POST); die;

 // $user= User::findById(Yii::$app->user->id);

   //echo "<pre>";print_r($customers); die;
 }
 public function actionPage($id){
   $setting = new  Pages();
    $model=Pages::findOne($id);
    print_r($model);
    die;
   // echo $url = 'http://'.$_SERVER['HTTP_HOST'];
    //echo "<pre>"; print_r($_POST); die;

 // $user= User::findById(Yii::$app->user->id);

   //echo "<pre>";print_r($customers); die;
 }
 public function oAuthSuccess($client) {
  // get user data from client
  $userAttributes = $client->getUserAttributes();

  // do some thing with user data. for example with $userAttributes['email']
}
 public function actionTest() {
    $array=[ 'Belgium', 'Denmark', 'Germany', 'Italy', 'Netherlands', 'United Kingdom'];
    //$array=[ 'Alabama', 'Arizona', 'California', 'Colorado', 'Connecticut', 'Florida','Georgia','Illinois','indiana','Kentucky','Louisiana','Maryland','Massachusetts','michigan','minnesota','Missouri','New Jersey','New York','North Carolina','Ohio','Pennsylvania','South Carolina','Tennessee','Texas','Virginia','Washington','Wisconsin','Other'];
    $model = new ProductCategory();
    foreach($array as $value){
      $model = new ProductCategory();
      $model->parent_id=809;
      $model->cat_name=$value;
      $model->alias=strtolower($value);
      if ($model->save()) {
        echo 1;
              }
    }

  //print_r($array);
   // echo "sas";
     die;
/*$model= new HomeSlider();
if($model->load(Yii::$app->request->post())){
            $model->created_date  = date('Y-m-d');
              if ($model->save()) {
              }
            }
   return $this->render('test', [
                    'model' => $model,

        ]);*/
}

 public function actionRtest() {
    if(Yii::$app->request->post()){
        $artist_id=$_POST['artist_id'];
       Yii::$app->db->createCommand()
    ->insert('follow', [
            'airtest_id' => $artist_id,
            'user_id' => Yii::$app->user->id])
    ->execute();
    $command = Yii::$app->db->createCommand("SELECT COUNT('user_id') FROM follow where airtest_id = $artist_id");
    $sum = $command->queryScalar();
    $jsonArray = array('flag' => 'true','message'=>'sucessfully','sum'=>$sum);
     echo json_encode($jsonArray);
     exit;
    }
    return $this->render('rtest', [
                    'model' => Yii::$app->user->id,
                   ]);

 }
  public function actionProcesspayment()
    {
        $payment = new \app\models\Payment();

        if ($payment->load(Yii::$app->request->post())) {
            $amount=100;
            $expDateMonth = urlencode(trim($_POST['Payment']['month']));
            $padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
            $expDateYear = urlencode(trim($_POST['Payment']['year']));

            $paymentInfo = array(
                'AMT' => $amount,
                'ACCT' => urlencode(trim($_POST['Payment']['card_no'])),
                'CREDITCARDTYPE' => urlencode(trim($_POST['Payment']['card_type'])),
                'EXPDATE' => $padDateMonth . '' . $expDateYear,
                'CVV2' => urlencode(trim($_POST['Payment']['cvc'])),
                'FIRSTNAME' => urlencode(trim($_POST['Payment']['first_name'])),
                'LASTNAME' => urlencode(trim($_POST['Payment']['last_name'])),
                'STREET' => urlencode($_POST['Payment']['address_1']),
                'STREET2' => urlencode($_POST['Payment']['address_2']),
                'CITY' => urlencode($_POST['Payment']['city']),
                'STATE' => urlencode($_POST['Payment']['state']),
                'ZIP' => urlencode($_POST['Payment']['zip_code']),
                'COUNTRYCODE' => urlencode($_POST['Payment']['country_code']),

            );
          // echo "<pre>"; print_r(echo "<pre>";)
            $paypalPayment = new PaypalPayment();
            $httpParsedResponseAr = $paypalPayment->paypalHttpPost($paymentInfo);
             echo "<pre>"; print_r($httpParsedResponseAr); die;

            if ($httpParsedResponseAr === false || empty($httpParsedResponseAr)) {
                Yii::$app->getSession()->setFlash('error', 'Error excuting paypal API');
                return $this->redirect(['site/processpayment']);
            }

            if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) ||
                "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])  ) {

               echo $httpParsedResponseAr["TRANSACTIONID"];
                //$plansinfo = \app\models\Plan::findOne($subscriptionHistory->plan_id);

            } else {
                Yii::$app->getSession()->setFlash('error', 'Payment Failed ! Please provide valid credit card information.');
                return $this->redirect(['site/processpayment']);
            }
        }
         return $this->render('processpayment', [
                    'payment' => $payment,
                   ]);
    }
     public function actionPayment(){
        echo "hello"; die;
     }
     /*public function actionLogins() {
        $model = new LoginForm();
        $data=array();
        if ($model->load(Yii::$app->request->post())) {
             $model->login();
             if(!empty($model->getErrors())){ 
              $error=$model->getErrors();
              $data['flag']=false;
              $data['msg']=$error['password'][0];
            }
             else{
                if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
                    $data[]=['flag'=>'true','msg'=>'thanks'];
                }
            }
            return json_encode($data);


        }
    }*/

}
