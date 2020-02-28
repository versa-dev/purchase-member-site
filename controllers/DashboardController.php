<?php

namespace app\controllers;

use app\components\MtypeControl;
use app\models\Country;
use app\models\PayCode;
use app\models\VerifyCaller;
use Aws\Common\Enum\Time;
use dmstr\widgets\Alert;
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
use app\models\MemberService;
use app\models\MemberServiceSearch;
use app\models\UploadInvoice;
use app\models\User;
use app\models\GeneralSetting;
use app\models\Product;
use app\models\HomeSlider;
use app\models\ProductCategory;
use app\models\SafePurchase;
use app\models\SafePurchaseSearch;
use app\models\ReportDepositCanada;
use app\models\ReportDepositUsa;
use app\models\ReportDepositEmt;
use app\models\ProfileQuestion;
use app\models\ProfileQuestionAnswer;
use app\models\ProfileQuestionAnswerCustom;
use app\models\ReferMerchant;
use app\models\ReportPayment;
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

    public function actionIndex() {
        $this->layout='inner';
        $this->layout='inner';

          //  echo "<pre>"; print_r($month);
           //die;
        if(key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))){
              return $this->redirect(['/backend']);
            }
            else{
                return $this->render('index',[]);
            }
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
         $attt = Product::find()->select('*')->where("MONTH(created_date) = $value")->andWhere("YEAR(created_date) = $yourYear")->andWhere(['user_id'=>Yii::$app->user->id])->all();
         $count=count($attt);
         $month[]=["y"=>$count,"label"=>$values_month];
        }
        return $month;
    }
public function actionEdit(){
    $this->layout='inner';
    $id=Yii::$app->user->id;
    $user=User::findById($id);
    $user_roles=$user->getUserRoles();
    $country = new Country();
    $countries_list=$country->getAllCountries();
    $model = UserProfile::findProfileByUserId($id);
    $profile_image=$model->image;
    $question_ans = new ProfileQuestionAnswer;

    //$question_ans = ProfileQuestionAnswer::find()->where(['user_id'=>Yii::$app->user->id])->all();
   
   if(empty($model)){
     $model = new UserProfile();
     $model->user_id =Yii::$app->user->id;
    }
   $data=Yii::$app->request->post();


        if ($model->load(Yii::$app->request->post())) {
         
            $model->city=$_POST['UserProfile']['city'];
            $model->phone_no=$_POST['UserProfile']['phone_no'];
            $model->company_name=$_POST['UserProfile']['company_name'];
            $model->alternate_email=$_POST['UserProfile']['alternate_email'];
            $model->notificatoins_phone_no=$_POST['UserProfile']['notificatoins_phone_no'];
            
            $model->twitter_account=$_POST['UserProfile']['twitter_account'];
            $model->instagram_account=$_POST['UserProfile']['instagram_account'];
            $model->snap_chat_account=$_POST['UserProfile']['snap_chat_account'];

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
             //   echo "<pre>"; print_r($_POST['ProfileQuestionAnswer']['answer']); die;
             ProfileQuestionAnswerCustom::deleteAll('user_id = :user_id', [':user_id' => Yii::$app->user->id]);
                foreach($_POST['answers'] as $key=>$value){
              
                    $question_custom = new ProfileQuestionAnswerCustom;
                    if(!empty($_POST['answers'][$key])){

                        $question_custom->answer=$value['a'];
                        $question_custom->question=$value['q'];
                        $question_custom->user_id=Yii::$app->user->id;
                        $question_custom->save();
                    }
                }
                Yii::$app->session->setFlash('success', 'User profile has been updated successfully.');
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('dashboard/edit'));
            }


        }
        $question= ProfileQuestion::find()->all();
       // print_r($question[0]['question']); die;
            return $this->render('edit-profile', [
                    'model' => $model,
                    'user'=>$user,
                    'user_roles'=>$user_roles,
                    'countries_list' => $countries_list,
                    'question'=>$question,
                    'question_ans'=>$question_ans
            ]);
}
 public function actionProfile(){

    $this->layout='inner';
    $id=Yii::$app->user->id;
    $user=User::findById($id);
    $user_roles=$user->getUserRoles();
    $country = new Country();
    $countries_list=$country->getAllCountries();
    $model = UserProfile::findProfileByUserId($id);
    $profile_image=$model->image;
    $question_ans = new ProfileQuestionAnswer;
    $question_custom = new ProfileQuestionAnswerCustom;

    $question_ans = ProfileQuestionAnswer::find()->where(['user_id'=>Yii::$app->user->id])->all();

    $user_detail = User::find()->joinWith(['profile','agentIdentification'])->Where(['user.id'=>$id])->one();

    $question_ans_all = ProfileQuestionAnswer::find()->where(['user_id'=>Yii::$app->user->id])->all();
    $question_ans_custom = ProfileQuestionAnswerCustom::find()->where(['user_id'=>Yii::$app->user->id])->all();
   
   if(empty($model)){
     $model = new UserProfile();
     $model->user_id =Yii::$app->user->id;
    }
   $data=Yii::$app->request->post();


        if ($model->load(Yii::$app->request->post())) {
        
            $model->city=$_POST['UserProfile']['city'];
            $model->phone_no=$_POST['UserProfile']['phone_no'];
            $model->company_name=$_POST['UserProfile']['company_name'];
            $model->alternate_email=$_POST['UserProfile']['alternate_email'];
            $model->notificatoins_phone_no=$_POST['UserProfile']['notificatoins_phone_no'];
            
            $model->twitter_account=$_POST['UserProfile']['twitter_account'];
            $model->instagram_account=$_POST['UserProfile']['instagram_account'];
            $model->snap_chat_account=$_POST['UserProfile']['snap_chat_account'];

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
             //   echo "<pre>"; print_r($_POST['ProfileQuestionAnswer']['answer']); die;
             ProfileQuestionAnswer::deleteAll('user_id = :user_id', [':user_id' => Yii::$app->user->id]);
                foreach($_POST['ProfileQuestionAnswer']['answer'] as $key=>$value){
              
                    $question_ans= new ProfileQuestionAnswer;
                    if(!empty($_POST['ProfileQuestionAnswer']['answer'][$key])){
                        $question_ans->answer=$value;
                        $question_ans->question_id=$key;
                        $question_ans->user_id=Yii::$app->user->id;
                        $question_ans->save();
                    }
                }
                Yii::$app->session->setFlash('success', 'User profile has been updated successfully.');
                return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('dashboard/profile'));
            }


        }
       

        $question= ProfileQuestion::find()->all();
       // print_r($question[0]['question']); die;
            return $this->render('profile', [
                    'model' => $model,
                    'user_detail'=>$user_detail,
                    'user'=>$user,
                    'user_roles'=>$user_roles,
                    'countries_list' => $countries_list,
                    'question'=>$question,
                    'que_ans'=>$question_ans_all,
                    'que_ans_custom'=>$question_ans_custom,
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
public function actionMembership(){
  $this->layout='inner';
     return $this->render('membership', []);
}
public function actionMembershipPreview(){
     $this->layout='inner';
     $family_protection=0;
     $safe_purchase=0;
     if(!empty($_POST)){
      $member_service=25;
      $tax=1.25;
      $bank=1;
      $tracking_amount=0.01;
      if(!empty($_POST['act_as_an_agent'])){
        $family_protection=25;
      }

      if(!empty($_POST['payment_option'])){
         $safe_purchase=25;
      }
      $total_amount=$member_service + $tax + $bank + $tracking_amount + $family_protection + $safe_purchase;
      $session = Yii::$app->session;
      Yii::$app->session->set('member_service',$member_service);
      Yii::$app->session->set('family_protection',$family_protection);
      Yii::$app->session->set('safe_purchase',$safe_purchase);
      Yii::$app->session->set('tax',$tax);
      Yii::$app->session->set('bank',$bank);
      Yii::$app->session->set('tracking_amount',$tracking_amount);
      Yii::$app->session->set('total_amount',$total_amount);
     }
    return $this->render('membership-preview', ['member_service'=>$member_service,'family_protection'=>$family_protection,'safe_purchase'=>$safe_purchase,'tax'=>$tax,'bank'=>$bank,'tracking_amount'=>$tracking_amount,'total_amount'=>$total_amount]);
}
public function actionAcceptPlan(){
    $session = Yii::$app->session;
    $model= new MemberService();
    $model->user_id= Yii::$app->user->id;
    $model->member_service= Yii::$app->session->get('member_service');
    $model->tax= Yii::$app->session->get('tax');
    $model->bank= Yii::$app->session->get('bank');
    $model->tracking_amount= Yii::$app->session->get('tracking_amount');
    $model->family_protection= Yii::$app->session->get('family_protection');
    $model->safe_purchase= Yii::$app->session->get('safe_purchase');
    $model->total_amount= Yii::$app->session->get('total_amount');
    if( $model->save()){
     Yii::$app->getSession()->setFlash('success', 'Cogragutaion! you got successfully purchased plan.Now go the bank and pay shortely');
     return $this->redirect(['/dashboard']);
    }
}
public function actionUploadReceipt($id=''){
   $this->layout='inner';
      $resut= UploadInvoice::find()->where(['member_service_id'=>$id])->one();
      if(!empty($resut)){
         $model = UploadInvoice::find()->where(['id'=>$resut['id']])->one();
      }else{
         $model = new UploadInvoice();
      }
      $model->member_service_id=$id;
       if (Yii::$app->request->isPost) {
            $model->invoice_receipt = UploadedFile::getInstance($model, 'invoice_receipt');
             $name = uniqid() . '.' . $model->invoice_receipt->extension;
             $model->invoice_receipt->saveAs('images/invoice/' . $name);
             $model->invoice_receipt=$name;
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Cogragutaion! you got successfully Uploaded receipt admin will shortly confirm it.');
                return $this->redirect(['/dashboard']);
            }
        }

      return $this->render('upload-receipt', ['model' => $model]);
}
  public function actionMyPlan(){
  $this->layout='inner';
  $searchModel = new MemberServiceSearch();
  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
  $dataProvider->query->where(['user_id'=>Yii::$app->user->id]);
  $model=$dataProvider->getModels();
  //echo "<pre>"; print_r($model); die;
          return $this->render('my-plan', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
              'model'=>$model
          ]);
  }
public function actionWelcome(){
  $this->layout='inner';

  //echo "<pre>"; print_r($model); die;
          return $this->render('welcome');
  }
  public function actionConfirm(){
  $this->layout='inner';

  //echo "<pre>"; print_r($model); die;
          return $this->render('confirm');
  }
  public function actionAccountStatement(){
  $this->layout='inner';
 $model= \app\models\AccountStatement::find()->where(['user_id'=>Yii::$app->user->id])->all();
  //echo "<pre>"; print_r($model); die;
          return $this->render('account-statement',['model'=>$model]);
  }
  public function actionCreateSafePurchase()
    {    $this->layout='inner';
        $model = new SafePurchase();
         $model->user_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
			$model->save();

            Yii::$app->session->setFlash('success', 'Successfully Added');
            return $this->redirect(['safe-purchase']);
        } else {
            return $this->render('create-safe-purchase', [
                'model' => $model,
            ]);
        }
    }
    public function actionSafePurchase($id='')
    {   $this->layout='inner';
        return $this->render('safe-purchase', [
            'model' => SafePurchase::find()->where(['user_id'=>Yii::$app->user->id])->all(),
        ]);
    }

   public function actionReportDepositBankUsa()
    {
        //added by Gp
        //check country state
        $userProfile = UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $countryInfo = Country::find()->where(['id' => $userProfile->country_id])->one();

        if($countryInfo->iso !== 'US')  //if not usa person
        {
            Yii::$app->getSession()->setFlash('warning', 'Resricted to non USA Members.');
            return $this->goBack(Yii::$app->request->referrer);
        }

        $this->layout='inner';
        $model = new ReportDepositUsa();
         $model->user_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
			   Yii::$app->session->setFlash('success', 'Successfully Added');
			    return $this->redirect(['payment-option']);
			}
        } else {
            return $this->render('report-deposit-bank-usa', [
                'model' => $model,
            ]);
        }
    }

    public function actionReportDepositBankCanada()
    {
        //added by Gp
        //check country state
        $userProfile = UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $countryInfo = Country::find()->where(['id' => $userProfile->country_id])->one();

        if($countryInfo->iso !== 'CA')  //if not usa person
        {
            Yii::$app->getSession()->setFlash('warning', 'Resricted to non CANADA Members.');
            return $this->goBack(Yii::$app->request->referrer);
        }

        $this->layout='inner';

        $model = new ReportDepositCanada();
         $model->user_id=Yii::$app->user->id;
        //$model->payment_date_time = \app\components\GeneralHelper::inserDateformate($_POST['ReportDepositCanada']['payment_date_time']);
        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){

			   Yii::$app->session->setFlash('success', 'Successfully Added');
			    return $this->redirect(['payment-option']);
			}

        } else {
            return $this->render('report-deposit-bank-canada', [
                'model' => $model,
            ]);
        }
    }
    public function actionReportDepositEmt()
    {

        //added by Gp
        //check country state
        $userProfile = UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $countryInfo = Country::find()->where(['id' => $userProfile->country_id])->one();

        if($countryInfo->iso !== 'CA')  //if not usa person
        {
            Yii::$app->getSession()->setFlash('warning', 'Resricted to non CANADA Members.');
            return $this->goBack(Yii::$app->request->referrer);

        }

        $this->layout='inner';
        $model = new ReportDepositEmt();
         $model->user_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $row=\app\models\ReportDepositEmt::find()->Where(['question_answer'=>$_POST['ReportDepositEmt']['question_answer']])->one();
            if(!$row){
    			if($model->save()){
    			   Yii::$app->session->setFlash('success', 'Successfully Added');
    			    return $this->redirect(['payment-option']);
    			}
            }else{
                $model->addError('question_answer', 'This answer of question has already been given. ');
                return $this->render('report-deposit-emt', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('report-deposit-emt', [
                'model' => $model,
            ]);
        }
    }

    //added by GP
    public function actionVerifyCaller(){
        $model = new VerifyCaller();
        //$countries_list  = ArrayHelper::map(Country::find()->all(), 'id', 'nicename');
        $countries_list=['226'=>'United States','38'=>'Canada','13'=>'Australia','21'=>'Belgium','58'=>'Denmark','80'=>'Germany'
            ,'96'=>'Hong Kong','99'=>'India ','105'=>'Italy','107'=>'Japan','150'=>'Netherlands','153'=>'New Zealand'
            ,'192'=>'Singapore','226'=>'United States','153'=>'New Zealand','225'=>'United Kingdom'];
        if ($model->load(Yii::$app->request->post())) {

            $sender = User::find()->where(['email' => $model->s_email])->one();

            if(!empty($sender))
            {
                $model->s_user_id = $sender->id;
            }

            //organization

            $today = date('Y-m-d');
            $currentTime = date('H:i:s');

            $ddd = $model->challese_word;
            $model->date = $today;
            $model->time = $currentTime;


            //receiver
            $receiver = User::find()->where(['email' => $model->r_email_address])->one();

            if(!empty($receiver))
            {
                $model->r_user_id = $receiver->id;
            }

            if($model->save())
            {
                Yii::$app->getSession()->setFlash('success', 'Saving Successful!');
                return $this->goHome();
            }
            else{
                Yii::$app->getSession()->setFlash('error', 'Saving Error');
            }
        }

        return $this->render('verify-caller', [
            'model' => $model,
            'countries_list' => $countries_list
        ]);
    }
    public function actionReferMerchant()
    {    $this->layout='inner';
        $model = new ReferMerchant();
         $model->user_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
			if($model->save()){
			   Yii::$app->session->setFlash('success', 'Successfully Added');
			    return $this->redirect(['refer-merchant']);
			}

        } else {
            return $this->render('refer-merchant', [
                'model' => $model,
            ]);
        }
    }
     public function actionReportPayment(){
        $this->layout='inner';
        
        $model = new ReportPayment();
        
        
        if ($model->load(Yii::$app->request->post())) {
            
            $data = Yii::$app->request->post();
         
            $model->user_id = Yii::$app->user->id;
            $model->bank = $data['ReportPayment']['bank'];
            $model->amount = $data['ReportPayment']['amount'];
            $model->date = $data['ReportPayment']['date'];
            $model->time = $data['ReportPayment']['time'];
            
			$model->save();

            Yii::$app->session->setFlash('success', 'Successfully Added');
            return $this->redirect(['dashboard/report-payment']);
        } else {
            return $this->render('report-payment', [
                'model' => $model,
            ]);
        }
        
     }
     
    public function actionFamilyProtectionAdd(){
         $this->layout='inner';

        $model = new \app\models\FamilyProtectionMember();
        $info =  \app\models\FamilyProtection::find()->where(['user_id' => Yii::$app->user->id,'mail'=>1])->one();
        if(!empty($info)){
          $family= $info;
        }else{
          $family= new \app\models\FamilyProtection();
        }
        $row=\app\models\User::find()->Where(['id'=>Yii::$app->user->id])->one();
        $customers = \app\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one();

        //added by GP
        //check A, P state
        $userMtype = $customers->mtype;
        if ($row->username !== 'admin' && ($userMtype !== 'A' && $userMtype !== 'P'))
        {
            Yii::$app->getSession()->setFlash('warning','Family Protectin is restricted to non Family Members and adults.');
            return $this->goBack(Yii::$app->request->referrer);
//            return $this->render('welcome', ['warning' => 'Family Protectin is restricted to non Family Members and adults.']);
        }
        /////////////////

        if ($model->load(Yii::$app->request->post())) {
            if($user = $model->signup()){

                $family->user_id=Yii::$app->user->id;
                $family->mail='1';
               if($family->save()){

                  $dateOfBirth = \app\components\GeneralHelper::inserDateformate($_POST['FamilyProtectionMember']['date_of_birth']);
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $age = $diff->format('%y');

                  $model = new \app\models\FamilyProtectionMember();
                  $model->family_protection_id=$family->id;
                  $model->first_name=$_POST['FamilyProtectionMember']['first_name'];
                  $model->middle_name=$_POST['FamilyProtectionMember']['middle_name'];
                  $model->last_name=$_POST['FamilyProtectionMember']['last_name'];
                  $model->relation=$_POST['FamilyProtectionMember']['relation'];
                  $model->email=$_POST['FamilyProtectionMember']['email'];
                  $model->age=$age;
                  $model->cell_phone=$_POST['FamilyProtectionMember']['cell_phone'];

                  //added by GP
//                    $model->mtype = MtypeControl::getMemberMtype($age); //insert mtype (G, D)
//                    if ($model->mtype === 'D')
//                    {
//                        $model->pay_code = $customers->pay_code;
//                    }
//                    else{
//                        $pay_code = new PayCode();
//                        $pay_code->pay_code = '1';
//                        $pay_code->save();
//
//                        $realPayCode = MtypeControl::getPayCode($pay_code->id);
//                        $pay_code->pay_code = $realPayCode;
//                        $pay_code->save();
//
//                        $model->pay_code = $realPayCode;
//                    }
                    $model->date_of_family_protection_service = $today;
                    $model->group_id = $customers->user_id;
                    $model->date_of_birth = $dateOfBirth;
                    ///////////////////////
                    $model->parent_user_id = Yii::$app->user->id;
                    $model->family_member_user_id = $user->id;
                   $model->save(false);

                  if(empty($info)){
                      if($userMtype === 'A' && $row->username !== 'admin')
                      {
                          Yii::$app->db->createCommand()->insert('message',
                              [    'from_user' => Yii::$app->user->id,
                                  'to_user' => Yii::$app->user->id,
                                  'first_name' => $model->first_name,
                                  'last_name' => $model->last_name,
                                  'send_date'=>date('Y-m-d H:i:s'),
                                  'subject'=> 'Invoice for Family Protection Number '.Yii::$app->user->id,
                                  'message'=>'<table>
                      <tr><td colspan="2"><p>Web Picture Identification Inc o/a WebPicID<br>9 Highvale Cres Sherwood Park,<br> Alberta T8A 5J7 Canada</p></td></tr>
                      <tr><td colspan="2"><p>'.$customers->first_name.'<br>
                      '.$customers->address.'<br>
                      '.$customers->city. ', '.$customers->state.', '.$customers->post_code.'</p></td></tr>
                      <tr><th colspan="2"><p>Invoice<br>'.date('F d Y').'</p></th> </tr>
                      <tr><th colspan="2">Family Protection'.$row['id'].'</th> </tr>
                      <tr> <th>Family Protection </th><td>$20.00</td></tr>
                      <tr><th>GST</th><td>$1.00 (5%)</td></tr>
                      <tr> <th>Total</th><td>$21.00</td></tr>
                      </table>',
                      ])->execute();

                      //added by GP
                      $customers->mtype = 'P';
                      $customers->save();
                      }
                      /*Yii::$app->db->createCommand()->insert('message',
                           [    'from_user' => Yii::$app->user->id,
                                'to_user' => Yii::$app->user->id,
                               'first_name' => $model->first_name,
                               'last_name' => $model->last_name,
                               'send_date'=>date('Y-m-d H:i:s'),
                                'subject'=> 'Invoice for Family Protection Number '.Yii::$app->user->id,
                                'message'=>'<b>Invoice for Membership Number</b>'.Yii::$app->user->id.'<br>Family Protection               $20.00
                                                     GST                                   $  1.00    5%
                                                      Total                                  $21.00',
                           ])->execute();    */
                      Yii::$app->session->setFlash('success', 'Successfully Added');

                      //////////////
                      }

                    return $this->redirect(['family-protection-add']);

                }else{
                     return $this->render('family-protection-add', [
                        'model' => $model,
                    ]);
                }

            }else{
                 return $this->render('family-protection-add', [
                    'model' => $model,
                ]);
            }
        }
        else {
            return $this->render('family-protection-add', [
                'model' => $model,
            ]);
        }
    }

    public function usernamedb($name1, $name2, $i){
        $uname = $name1.$i.$name2;
        $row = \app\models\User::find()->Where(['username'=>$uname])->one();
        if(isset($row['username']) && !empty($row['username'])){
            $i = $i + 1;
            return $result = $this->usernamedb($name1, $name2, $i);
        }else{
           return $uname;
        }
    }

    public function actionCheckUsername(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $fname = $data['fname'];
            $lname = $data['lname'];

             $fname1 = substr($fname, 0, 2);
             $lname1 = substr($lname, 0, 2);

            $result = $this->usernamedb($fname1, $lname1, 1);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'search' => $result,
                'code' => 100,
            ];
         }
    }

  public function actionFamilyProtection(){
     $this->layout='inner';
   $model =  \app\models\FamilyProtectionMember::find()->joinWith('familyProtection')->where(['user_id'=>Yii::$app->user->id])->all();
   //echo "<pre>";print_r($model); die;

         return $this->render('family-protection-member', [
                'model' => $model,
            ]);
    }
    public function actionFamilyProtectionService(){
         $this->layout='inner';
        return $this->render('family-protection-service');

    }
    public function actionPaymentOptionUsa(){
         $this->layout='inner';
        return $this->render('payment-option-usa');

    }
    public function actionPaymentOptionCanada(){
         $this->layout='inner';
        return $this->render('payment-option-canada');

    }
    public function actionNotification(){
         $this->layout='inner';
        return $this->render('notification');

    }
    public function actionShareAnOrganization(){
         $this->layout='inner';
        return $this->render('share-an-organization');

    }
    public function actionReferAnOrganization(){
         $this->layout='inner';
        return $this->render('refer-an-organization');

    }
    public function actionIdentityTheftLossReduction(){
         $this->layout='inner';
        return $this->render('identity-theft-loss-reduction');

    }
    public function actionActOfAgency(){
         $this->layout='inner';
        return $this->render('act-of-agency');

    }
    public function actionPreRegistration(){
        $this->layout='inner';
        return $this->render('pre-registration');

    }
    public function actionMerchantSignup(){
      $this->layout='inner';
   $model = new \app\models\MerchantSignup();
        if ($model->load(Yii::$app->request->post())) {
        $model->user_id=Yii::$app->user->id;
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Successfully Added');
              return $this->redirect(['index']);
            }
        } else {
            return $this->render('merchant-signup', [
                'model' => $model,
            ]);
        }
   //echo "<pre>";print_r($model); die;


    }
    public function actionPaymentOption(){
         $this->layout='inner';

         //added by GP
        //check mytpe state
        $row=\app\models\User::find()->Where(['id'=>Yii::$app->user->id])->one();
        $customers = \app\models\UserProfile::find()->where(['user_id' => Yii::$app->user->id])->one();
        if($customers->mtype === 'D')
        {
            Yii::$app->getSession()->setFlash('warning', 'Resricted to Adult Members');
            return $this->goBack(Yii::$app->request->referrer);
        }
        else{
            return $this->render('payment-option');
        }
    }
     public function actionTermsCondition(){
      $this->layout='inner';
        return $this->render('terms-condition');

    }
     public function actionPrivacyPolicy(){
      $this->layout='inner';
        return $this->render('privacy-policy');

    }
    public function actionFaq(){
      $this->layout='inner';
        return $this->render('faq');

    }
    public function actionActOfAgent(){
      $this->layout='inner';
        return $this->render('act-of-agent');

    }
    public function actionAboutUs(){ //echo "hello"; die;
      $this->layout='inner';
        return $this->render('about-us');

    }
    public function actionHowItWorks(){
      $this->layout='inner';
        return $this->render('how-it-works');

    }
    public function actionMemberService(){
      $this->layout='inner';
        return $this->render('member-service');

    }
    public function actionMerchantService(){
      $this->layout='inner';
        return $this->render('merchant-service');

    }

    public function actionAjaxCommissionss($country_id=''){
        $model = \app\models\State::find()->where(['country_id'=>$country_id])->orderBy(['name' => SORT_ASC])->all();   // modified by JIN MINGHE 20191129 add order by function
        $option= "<option>Select State</option>";
        foreach ($model as $key => $value) {
            $option .= "<option value=".$value['name'].">".$value['name']."</option>";
        }
        echo  $option; die;
    }

}
