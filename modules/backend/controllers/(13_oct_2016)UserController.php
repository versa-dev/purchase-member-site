<?php

namespace app\modules\backend\controllers;

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
use app\models\UserSearch;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                /*'actions' => [
                    'delete' => ['post'],
                ],*/
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
          if($model->usertype=='Client'){
          return $this->redirect(['clientupdate', 'id' => $id]);
        }
        if($model->usertype=='Supplier'){
          return $this->redirect(['supplierupdate', 'id' => $id]);
        }
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user'));
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /* for user registration--------------------------*/
    public function actionRegister() {

        $model = new SignupForm();
        $countries_list  = ArrayHelper::map(Country::find()->all(), 'id', 'nicename');
       if ($model->load(Yii::$app->request->post())) {
         $password =  $_POST['SignupForm']['password'];
         $model->first_name =  $_POST['SignupForm']['first_name'];
         $model->last_name =  $_POST['SignupForm']['first_name']; 
            if ($user = $model->signup()) {

                    $this->signupWithActivation($model, $user,$password);
                     return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user'));
            }
        }

        return $this->render('register', [
                    'model' => $model,
                    'countries_list' => $countries_list
        ]);
    }
    
        public function actionClientupdate($id) {

       $model = new SignupForm(['scenario' => 'client']);
    //print_r(Yii::$app->request->post()); die;
        $countries_list  = ArrayHelper::map(Country::find()->all(), 'id', 'nicename');
        $model = $this->findModel($id);
        if($model->parent_id !=NULL){
          $model->client_type='Child'; 
         }
         else{
          $model->client_type='Child'; 
         }
         /*$country = new Country();
         $countries_list=$country->getAllCountries();*/
        $profile = UserProfile::findProfileByUserId($id);
         $model->name=$profile->name;
         $model->country_id=$profile->country_id;
        
         if($model->parent_id !=NULL){
            $model->client_type='Child';
         }
         else{
             $model->client_type='Parent'; 
         }
        $model->service_type = explode(',', $model->service_type);
        $supplier_list  = ArrayHelper::map(User::find() ->where(['usertype'=>'Supplier'])->all(), 'id', 'username');
        $client_list  = ArrayHelper::map(User::find() ->where(['usertype'=>'Client','parent_id'=>NULL])->all(), 'id', 'username');
        if ($model->load(Yii::$app->request->post())) {
         $model->username=$_POST['User']['username']; 
         
         $model->supplier_id=$_POST['User']['supplier_id'];
         $model->service_type=implode(",", $_POST['User']['service_type']);
         $model->client_type=$_POST['User']['client_type'];
         if($_POST['User']['client_type']='Child'){
          $model->parent_id=$_POST['User']['parent_id']; 
         }
         else{
          $model->parent_id=0;  
         }
         $profile->name=$_POST['User']['name'];
         $profile->country_id=$_POST['User']['country_id'];
           
          if ($model->save()) {

              if($profile->save()){
                 return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user'));
               }
            }
        }

        return $this->render('clientupdate', [
                    'model' => $model,
                    'countries_list' => $countries_list,
                    'supplier_list'=>$supplier_list,
                    'client_list'=>$client_list
        ]);
    }

   

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

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
        if ($model->sendAccountEmail($user,$password)) 
        {
            
            Yii::$app->session->setFlash('success', 
               // Yii::t('app', 'Hello').' '.Html::encode($user->username). '. ' .    
                Yii::t('app', 'User added successfully'));
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

public function actionProfile($id){

   
    $user=User::findById($id);
    $user_roles=$user->getUserRoles();

    $country = new Country();
    $countries_list=$country->getAllCountries();
    
    $model = UserProfile::findProfileByUserId($id);
   if(empty($model)){
     $model = new UserProfile();
     $model->user_id =Yii::$app->user->id;   

   }
   $data=Yii::$app->request->post();

    if(isset($data['User']['usertype'])){
     $user->usertype=$data['User']['usertype'];
    }

        if ($model->load(Yii::$app->request->post()) && $model->save() && $user->save()) {
            /*$sql="update  auth_assignment set item_name = '".$user->usertype ."' WHERE user_id='".$user->id."'";
            Yii::$app->db->createCommand($sql)->execute();*/
            Yii::$app->session->setFlash('success', 'User profile has been updated successfully.');
            //return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user/profile?id='.$id));
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user'));
        } 

            return $this->render('profile', [
                    'model' => $model,
                    'user'=>$user,
                    'user_roles'=>$user_roles,
                    'countries_list' => $countries_list
            ]);
 }
  public function actionBlockUser($id){

        $user = User::findOne($id);
       
        if(empty($user)){
            Yii::$app->getSession()->setFlash('danger', 'No such user exists!');
            return $this->redirect('user');
        }
        if(empty($user->status)){
            $user->status = 10;
        }else{
           echo  $user->status = 0;
        }
        if($user->save()){ 
            $message  = "$user->username account has been sucessfully ".(($user->status==0)?'blocked':'unblocked');
            Yii::$app->getSession()->setFlash('success',$message);
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('backend/user'));
        }
    }
}
