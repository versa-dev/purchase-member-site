<?php

namespace app\controllers;

use app\components\MtypeControl;
use app\models\Country;
use app\models\FamilyProtectionMember;
use app\models\PayCode;
use app\models\UpdateInfo;
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
use app\models\UserSnapshot;
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

          //added by GP
          //check U Members
         $query = User::find()->where(['username' => Yii::$app->request->post()['LoginForm']['username']])->one();
         $userProfile = UserProfile::find()->where(['user_id' => $query->id])->one();
         if ($userProfile ->mtype === 'U' && $query->username !== 'admin')
         {
             Yii::$app->getSession()->setFlash('warning', 'You can\'t log on...');
             return $this->redirect(Yii::$app->request->referrer);
         }
         if($query['status'] =='0'){
            Yii::$app->getSession()->setFlash('error', 'Your account is an inactive, please contact to the administrator.');
          return $this->goBack('site');
          }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend/user/index']);
            }
            else{
                $query = UserProfile::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
                if(isset($query['pass_change']) && $query['pass_change']=='1'){
                     return $this->redirect(['/site/change-password']);
                }else{
                    //added by GP
                    //if U member, block

                    // check user_profile, family_protect_member table
                    $updateInfo= UpdateInfo::find()->where(['id'=>1])->one();
                    $update_date = $updateInfo->update_date;
                    $today = date("Y-m-d");

                    if($today !== $update_date) //if not checked
                    {
                        //check userprofile
                        $userProfileAll = UserProfile::find()->all();

                        foreach ($userProfileAll as $each)
                        {
                            $birthDay = $each->date_of_birth;
                            $diff = date_diff(date_create($birthDay), date_create($today));
                            $age = $diff->format('%y');

                            if($age !== $each->age)
                            {
                                $each->age = $age;
                                $oldMtype = $each->mtype;

                                if($oldMtype === 'U')
                                {
                                    $each->mtype = MtypeControl::getMtype($age);

                                    if ($each->mtype === 'A')
                                    {
                                        $pay_code = new PayCode();
                                        $pay_code->pay_code = '1';
                                        $pay_code->save();

                                        $realPayCode = MtypeControl::getPayCode($pay_code->id);
                                        $pay_code->pay_code = $realPayCode;
                                        $each->date_of_family_protection_service = $today;
                                        $pay_code->save();

                                        $each->pay_code = $realPayCode;
                                    }
                                }
                                else if ($oldMtype === 'D' || $oldMtype === 'G')
                                {
                                    $each->mtype = MtypeControl::getMemberMtype($age);

                                    if($oldMtype === 'D' && $each->mtype === 'G')
                                    {
                                        $pay_code = new PayCode();
                                        $pay_code->pay_code = '1';
                                        $pay_code->save();

                                        $realPayCode = MtypeControl::getPayCode($pay_code->id);
                                        $pay_code->pay_code = $realPayCode;
                                        $each->date_of_family_protection_service = $today;
                                        $pay_code->save();

                                        $each->pay_code = $realPayCode;
                                    }
                                }

                                $each->save();
                            }
                        }

                        //check family_protection_member
                        $familyMemberAll = FamilyProtectionMember::find()->all();

                        foreach ($familyMemberAll as $each)
                        {
                            $birthDay = $each->date_of_birth;
                            $diff = date_diff(date_create($birthDay), date_create($today));
                            $age = $diff->format('%y');

                            if($age !== $each->age)
                            {
                                $oldMtype = $each->mtype;
                                $each->age = $age;
                                $each->mtype = MtypeControl::getMemberMtype($age);

//                                if($oldMtype === 'D' && $each->mtype === 'G')
//                                {
//                                    //added by GP
//                                    $pay_code = new PayCode();
//                                    $pay_code->pay_code = '1';
//                                    $pay_code->save();
//
//                                    $realPayCode = MtypeControl::getPayCode($pay_code->id);
//                                    $pay_code->pay_code = $realPayCode;
//                                    $each->date_of_family_protection_service = $today;
//                                    $pay_code->save();
//
//                                    $each->pay_code = $realPayCode;
//
//                                    $each->save();
//                                }
                            }
                        }

                        $updateInfo->update_date = $today;
                        $updateInfo->save();
                    }

//                    if U members, block


                    return $this->redirect(['/dashboard/welcome']);
                }
            }
        }else{ //echo "Welcome! work in progress"; die;
            if(isset(Yii::$app->user->identity->id)){
               return $this->redirect(['/dashboard/welcome']);

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
              return $this->redirect(['/backend/user/index']);
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
        $countries_list=['226'=>'United States','38'=>'Canada','13'=>'Australia','21'=>'Belgium','58'=>'Denmark','80'=>'Germany'
        ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
        ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];
        if ($model->load(Yii::$app->request->post())) {
            $session = Yii::$app->session;
            $session->set('username', $_POST['SignupForm']['username']);
            $session->set('password_hash', $_POST['SignupForm']['password']);
            $password =  $_POST['SignupForm']['password'];
            if(!empty($_POST['SignupForm']['state'])){
                $model->state=$_POST['SignupForm']['state'];
            }
            if(!empty($_POST['SignupForm']['states'])){
                $model->states=$_POST['SignupForm']['states'];
            }
            if ($user = $model->signup()) {

                Yii::$app->getSession()->setFlash('success', 'Congratulation! You are successfully registerd and now take a picture or move to next step');
                return $this->redirect(['site/snapshot','id'=>$user->id,'token'=>$user->auth_key]);
                    //$this->signupWithActivation($model, $user,$password);
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
    public function actionActivateAccount1($token ,$key)
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
            if($key=='1'){
                $user = User::find()->where(['account_activation_token' => $token])->one();
                return $this->redirect(['site/snapshot','id'=>$user->id,'token'=>$user->auth_key]);

            }
        return $this->redirect('login');
    }
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
                 $query = UserProfile::find()->where(['user_id' => $user['id']])->one();
                if(isset($query['pass_change']) && $query['pass_change']=='1'){
                     Yii::$app->db->createCommand()
                     ->update('user_profile', ['pass_change' => '0'], ['user_id' => $user['id']])
                     ->execute();

                    Yii::$app->session->setFlash('success', 'Your Password has been changed successfully');
                    return $this->redirect(['site/snapshot','id'=>$user->id,'token'=>$user->auth_key]);
                    return $this->refresh();
                }
                Yii::$app->session->setFlash('success', 'Your Password has been changed successfully');
            }
        }

        return $this->render('change-password', [
                    'model' => $model,

        ]);

 }

public function actionProfile() {

    $user=User::findById(Yii::$app->user->id);
    $user_roles=$user->getUserRoles();

    $country = new Country();
    //$countries_list=$country->getAllCountries();
    $countries_list=['13'=>'Australia','21'=>'Belgium','38'=>'Canada','58'=>'Denmark','80'=>'Germany'
        ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
        ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];

    $model = UserProfile::findProfileByUserId(Yii::$app->user->id);
    if (empty($model)) {
        $model = new UserProfile();
        $model->user_id =Yii::$app->user->id;

    }
    $data=Yii::$app->request->post();



      if ($model->load(Yii::$app->request->post()) && $model->save() && $user->save()) {
            $sql="update  auth_assignment set item_name = 'register' WHERE user_id='".$user->id."'";
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
     public function actionTermsCondition(){
     return $this->render('terms-condition');
     }

    public function actionSnapshot($id='',$token='') {
        $row=\app\models\User::find()->Where(['id'=>$id,'auth_key'=>$token])->one();
        if (empty($row)) {
            Yii::$app->getSession()->setFlash('danger', 'Your problem in resigtration process please do not disturb url, Now you can registration agin or contact to administrator.');
                return $this->redirect(['site/register']);
        }


        $model = new UserSnapshot();

        if ($model->load(Yii::$app->request->post())) {
            foreach ($_POST['UserSnapshot']['photo'] as $key => $img) {

                $folderPath = "../cameras/";
                $folderPath1 = "../web/images/profile/";
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                $time1 = trim(str_replace('(India Standard Time)','',$_POST['UserSnapshot']['time'][$key]));
                date_default_timezone_set('UTC');
                $time = strtotime($time1);

                $fileName = $id.'_'.$time . '.jpg';
                $file = $folderPath . $fileName;
                $file1=$folderPath1.$fileName;
                file_put_contents($file, $image_base64);
                file_put_contents($file1, $image_base64);

                if($img==$_POST['UserSnapshot']['image']){
                    $status1 = '1';
                }else{
                    $status1 = '0';
                }

                $model = new \app\models\UserSnapshot();
                $model->user_id=$id;
                $model->image=$fileName;
                $model->status=$status1;
                $model->created=date('Y-m-d H:i:s',$time);
                $model->save();


                if($status1=='1'){
                     Yii::$app->db->createCommand()
                     ->update('user_profile', ['image' => $fileName], ['user_id' => $id])
                     ->execute();
                }

            }

            return $this->redirect(['agent-identification/create','id'=>$id,'token'=>$token]);
            return $this->refresh();
        }

        //return $this->redirect(['agent-identification/create','id'=>$id,'token'=>$token]);
        return $this->render('snapshot',['id'=>$id,'token'=>$token]);
    }

    public function actionSnapshot1($id='',$token=''){

        $model = new UserSnapshot();

        if ($model->load(Yii::$app->request->post())) {
            foreach ($_POST['UserSnapshot']['photo'] as $key => $img) {

                $folderPath = "../cameras/";
                $image_parts = explode(";base64,", $img);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);

                $time1 = trim(str_replace('(India Standard Time)','',$_POST['UserSnapshot']['time'][$key]));
                date_default_timezone_set('UTC');
                $time = strtotime($time1);

                $fileName = $id.'_'.$time . '.jpg';
                $file = $folderPath . $fileName;
                file_put_contents($file, $image_base64);
                $status1 = '2';
                $model = new \app\models\UserSnapshot();
                $model->user_id=$id;
                $model->image=$fileName;
                $model->status=$status1;
                $model->created=date('Y-m-d H:i:s',$time);
                $model->save();
            }

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
            return $this->redirect(['dashboard/welcome', 'id' => $model_agent->id]);
        }

        //return $this->redirect(['agent-identification/create','id'=>$id,'token'=>$token]);
         return $this->render('snapshot1',['id'=>$id,'token'=>$token]);
    }


    public function actionRecord(){
       $time=time();
        $filename = $time.'.jpg';
        $result = file_put_contents( 'cameras/'.$filename, file_get_contents('php://input') );
        if (!$result) {
            print "ERROR: Failed to write data to $filename, check permissions\n";
            exit();
        }

        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/cameras/' . $filename;
        print "$url\n";

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
    public function actionAjaxCommissionss($country_id=''){
        $model = \app\models\State::find()->where(['country_id'=>$country_id])->orderBy(['name' => SORT_ASC])->all();   // modified by JIN MINGHE 20191129 add order by function
        $option= "<option>Select State</option>";
        foreach ($model as $key => $value) {
            $option .= "<option value=".$value['name'].">".$value['name']."</option>";
        }
        echo  $option; die;
    }

}
