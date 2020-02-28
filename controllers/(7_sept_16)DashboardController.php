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

use yii\web\UploadedFile;







class DashboardController extends Controller {

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



    public function actionIndex() { //echo "hello"; die;

        $this->layout='inner';

        $total=Product::find()->where(['user_id'=>Yii::$app->user->id])->all();

        $pending=Product::find()->where(['published'=>0,'user_id'=>Yii::$app->user->id])->all();

        $unpending=Product::find()->where(['published'=>1,'user_id'=>Yii::$app->user->id])->all();

        if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){

              return $this->redirect(['/backend']);

            }

            else{

                return $this->render('index',[

                'total'=>$total,

                'pending'=>$pending,

                'unpending'=>$unpending,

                    ]);

            }

        

      

        

    }



 public function actionProfile(){ 

 	exit('here');
    $this->layout='inner';

    $id=Yii::$app->user->id;

    $user=User::findById($id);

    $user_roles=$user->getUserRoles();

    $country = new Country();

    $countries_list=$country->getAllCountries();

    $model = UserProfile::findProfileByUserId($id);

    $profile_image=$model->image;

   if(empty($model)){

     $model = new UserProfile();

     $model->user_id =Yii::$app->user->id;   

    }

   $data=Yii::$app->request->post();

   if(isset($data['User']['usertype'])){

     $user->usertype=$data['User']['usertype'];

    }

        

        if ($model->load(Yii::$app->request->post())) {

            $model->image = \yii\web\UploadedFile::getInstance($model, 'image');

                if ($model->image) {

                    $name = uniqid() . '.' . $model->image->extension;

                    $model->image->saveAs(Yii::$app->basePath . '/web/images/profile/' . $name);

                    $model->image = $name;

                } else {

                    $model->image = $profile_image;

                }

            if($user->save()){

                $model->save();

                Yii::$app->session->setFlash('success', 'User profile has been updated successfully.');

                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('dashboard/profile'));

            }

            

           

        } 

            return $this->render('profile', [

                    'model' => $model,

                    'user'=>$user,

                    'user_roles'=>$user_roles,

                    'countries_list' => $countries_list

            ]);

 }

  public function actionChangePassword(){

     $this->layout='inner';

    $model = new ChangePassword(['scenario' => 'changepassword']);



        if ($model->load(Yii::$app->request->post())) {

          // print_r(Yii::$app->request->post()); die;

            if ($user = $model->changepassword()) {



                Yii::$app->session->setFlash('success', 'Your Password has been changed successfully');

                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('dashboard/change-password'));

            }

        }



        return $this->render('change-password', [

                    'model' => $model,



        ]);



 }



}

