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
use app\models\GridService;
use yii\data\ActiveDataProvider;




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
      
        return $this->render('index');
       //  return $this->redirect('site/login');
    }

    public function actionLogin() {
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
            if(key_exists("Admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend']);  
            }
            if(key_exists("Subadmin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend']);  
            }
            if(key_exists("Client", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/dashboard']);  
            }
            if(key_exists("Supplier", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/site']);  
            }
            return $this->goBack(Yii::$app->request->referrer);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
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
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

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
 public function actionSetduedate() {
     $date=date('Y-m-d');
     
      $getannual=GridService::find()->where(['frequency'=>'Annual','duedate'=>$date])->all();
      $getsemi_annual=GridService::find()->where(['frequency'=>'Semi-annual','duedate'=>$date])->all();
      $getquarterly=GridService::find()->where(['frequency'=>'Quarterly','duedate'=>$date])->all();
      $getmonthly=GridService::find()->where(['frequency'=>'Monthly','duedate'=>$date])->all();
      if(!empty($getannual)){
          $this->annual($getannual,$date);
      }
       if(!empty($getsemi_annual)){
        $this->semi_annual($getsemi_annual,$date);
      }
      if(!empty($getquarterly)){
        $this->quarterly($getquarterly,$date);
      }
      if(!empty($getmonthly)){
        $this->monthly($getmonthly,$date);
      }

      /*$sql="update  auth_assignment set item_name = '".$user->usertype ."' WHERE user_id='".$user->id."'";
            Yii::$app->db->createCommand($sql)->execute();*/
    }
     protected function annual($getannual='',$date) {
        $day=date('Y-m-d', strtotime("365 days"));
       foreach ($getannual as $key => $value) {
            if($value['duedate']==$date && $value['supplier_final_doc']=='1'){
                $sql="update  grid_service set duedate = '".$day."', status = 'inprogress' ,supplier_final_doc=0 WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
                 }
            else{
                $sql="update  grid_service set status = 'overdue' WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
            }
        }
       
     }
     protected function semi_annual($getannual='',$date) {
        $day=date('Y-m-d', strtotime("180 days"));
       foreach ($getannual as $key => $value) {
            if($value['duedate']==$date && $value['supplier_final_doc']=='1'){
                $sql="update  grid_service set duedate = '".$day."', status = 'inprogress',supplier_final_doc=0 WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
                 }
            else{
                $sql="update  grid_service set status = 'overdue' WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
            }
        }
       
     }
     protected function quarterly($getannual='',$date) {
        $day=date('Y-m-d', strtotime("90 days"));
       foreach ($getannual as $key => $value) {
            if($value['duedate']==$date && $value['supplier_final_doc']=='1'){
                $sql="update  grid_service set duedate = '".$day."', status = 'inprogress',supplier_final_doc=0 WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
                 }
            else{
                $sql="update  grid_service set status = 'overdue' WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
            }
        }
       
     }
     protected function monthly($getannual='',$date) {
        $day=date('Y-m-d', strtotime("30 days"));
       foreach ($getannual as $key => $value) {
            if($value['duedate']==$date && $value['supplier_final_doc']=='1'){
                $sql="update  grid_service set duedate = '".$day."', status = 'inprogress',supplier_final_doc=0 WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
                 }
            else{
                $sql="update  grid_service set status = 'overdue' WHERE id='".$value['id']."'";
                Yii::$app->db->createCommand($sql)->execute();
            }
        }
       
     }


}
