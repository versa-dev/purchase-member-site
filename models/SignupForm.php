<?php
namespace app\models;

use app\components\MtypeControl;
use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $captcha;
    public $country_id;
    public $first_name;
    public $last_name;
    public $company_name;
    public $verifyPassword;
    //public $usertype;
    public $phone_no;
    public $state;
    public $states;
    public $city;
    public $address;
    public $account_activation_token;
    public $from_date;
    public $parent_id;
    public $aggrement;
    public $ageLimit;
    public $post_code;
    public $date_of_birth;

    /*
     * For Buyer/Seller type registration
     * */


    /*
     * For Appraiser type registration
     * */




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name','last_name','aggrement','date_of_birth','post_code','city'],'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 5, 'max' => 15],
          //  ['phone_no', 'unique', 'targetClass' => '\app\models\UserProfile', 'message' => 'This phone no has already been taken.'],

            /*['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email has already been taken.'],
            ['email', 'string', 'min' => 1, 'max' => 45],*/

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

            ['aggrement', 'required','requiredValue' => 1, 'message' => 'click accept terms and conditions'],
           /* ['ageLimit', 'required','requiredValue' => 1, 'message' => 'Please confirm your age should be more than 18 years'],*/


            /* // deleted by JIN MINGHE 20191129
            ['phone_no', 'filter', 'filter' => 'trim'],
            ['phone_no', 'required'],
            [['phone_no'], 'integer'],
            */

            ['address', 'filter', 'filter' => 'trim'],
            ['address', 'required'],
           /* ['city', 'filter', 'filter' => 'trim'],
            ['city', 'required'],*/
            ['state', 'filter', 'filter' => 'trim'],
           // ['state', 'required'],
            ['country_id', 'filter', 'filter' => 'trim'],
            ['country_id', 'required'],
            [['usertype'],'safe'],
            [['password','verifyPassword'], 'required'],

            ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/','message'=>"Password must contain at least one lower and upper case character and a digit."],
            [['password','verifyPassword'], 'string', 'min' => 4 , 'max'=>18],
            ['verifyPassword','compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],

          //  [['password', 'verifyPassword'], 'required', 'on' => 'changepassword'],
            /*[['username', 'password','verifyPassword','name','supplier_id','country_id','service_type','client_type'], 'required', 'on' => 'client'],*/

            ['post_code', 'match', 'pattern' => '/[A-Z][0-9][A-Z] [0-9][A-Z][0-9]/','when' => function ($model) {
                return $model->country_id == 38;
            }, 'whenClient' => "function (attribute, value) {
                return $('#signupform-country_id').val() == '38';
            }",'message'=>"The Canada post code format should be A#A #A#"],

            ['post_code', 'string', 'length' => 7, 'when' => function ($model) {
                return $model->country_id == 38;
            }, 'whenClient' => "function (attribute, value) {
                return $('#signupform-country_id').val() == '38';
            }",'message'=>"The length of Canada post code should be 7."],

            ['post_code', 'match', 'pattern' => '/\d{5,15}$/','when' => function ($model) {
                return $model->country_id == 226;
            }, 'whenClient' => "function (attribute, value) {
                return $('#signupform-country_id').val() == '226';
            }",'message'=>"The USA ZIP Code should contain the only digit."],

            ['post_code', 'string', 'min' => 5, 'max'=> 15, 'when' => function ($model) {
                return $model->country_id == 226;
            }, 'whenClient' => "function (attribute, value) {
                return $('#signupform-country_id').val() == '226';
            }"],
            //[['captcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className()]
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['register'] = ['username', 'password','verifyPassword','name','country_id'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * The labels for attributes
     * @return array
     */
    public function attributeLabels(){
        return [
            'name' => 'Name',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            //'usertype'=>'User type',
            'account_activation_token'=>'Activation key',
            'captcha'=>'',
            'country_id'=>'Country',
            'state'=>'State/Province',
            'states'=>'State/Province',
            'post_code'=>'Zip Code/Post code',
            'from_date'=>'from_date',
            'address'=>'Address',
            'verifyPassword' => 'Verify Password',
            'ageLimit'=>'I am agree ,my age is greater then 18 years old',
            'aggrement'=>'I accept the terms and conditions',
            'date_of_birth'=>'date of birth',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            //$user->usertype = 'register';
            $user->status = '10';

            $user->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();

            $mail = Yii::$app->mailer->compose(['html' => 'accountActivationToken'], ['username' => $this->username, 'name' =>$this->username, 'key'=>'1','account_activation_token' => $user->account_activation_token]);


            $sub = Yii::$app->name . ' user registration and email verification';
            $mail->setFrom('idtflrdemo@webpicid.com');
            //Yii::$app->params['adminEmail']
            $mail->setTo($this->email);

            $mail->setSubject($sub);
//changed by GP
//            $data = $mail->send();

            //$user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->setPassword($this->password);

            $user->generateAuthKey();
            $last_no= \app\models\SerialNo::find()->Where(['status'=>0])->orderBy('id asc')->one();
            $user->user_code= $last_no['serial_no'];


            $lastgc = \app\models\UserProfile::find()->orderBy('group_code desc')->one();
            $newgc = ($lastgc['group_code'] + 1);

            $dateOfBirth = \app\components\GeneralHelper::inserDateformate($this->date_of_birth);;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');

           if ($user->save()) {
                Yii::$app->db->createCommand()->update('serial_no', ['status' => 1], ['serial_no'=>$last_no['serial_no']])->execute();
                $userprofile= new UserProfile();
                $userprofile->user_id=$user->id;
                $userprofile->first_name=$this->first_name;
                $userprofile->last_name=$this->last_name;
//                $userprofile->phone_no=$this->phone_no;   // deleted by JINMINGHE 20191129
                $userprofile->phone_no=''; // added by JIN MINGHE 20191129

                $userprofile->address=$this->address;
                $userprofile->city=$this->city;
                if(!empty($this->states)){
                  $userprofile->state=$this->states;
                }
                if(!empty($this->state)){
                  $userprofile->state=$this->state;
                }

                $userprofile->country_id=$this->country_id;
                $userprofile->post_code=$this->post_code;
                $userprofile->date_of_birth=\app\components\GeneralHelper::inserDateformate($this->date_of_birth);
                $userprofile->group_code=$newgc;
                $userprofile->age=$age;

               //added by GP
               $userprofile->mtype = MtypeControl::getMtype($age);

               if($userprofile->mtype !== 'U')
               {
                   $pay_code = new PayCode();
                   $pay_code->pay_code = '1';
                   $pay_code->save();

                   $realPayCode = MtypeControl::getPayCode($pay_code->id);
                   $pay_code->pay_code = $realPayCode;
                   $pay_code->save();
                   $userprofile->pay_code = $realPayCode;
               }

               $userprofile->date_of_membership = $today;

                if ($userprofile->save()) {

                }

                Yii::$app->authManager->assign(Yii::$app->authManager->getRole('register'), $user->id);
                return $user;
           }

        }

        return null;
    }

    public function sendAccountActivationEmail($user,$password)
    {
         $customers = UserProfile::find()->where(['user_id' => $user->id])->one();

        return Yii::$app->mailer->compose('accountActivationToken', ['user' => $user,'name'=>$customers->first_name,'password'=>$password])
            ->setFrom("gaurav.parashar@dotsquares.com")
            ->setTo($this->email)
            ->setSubject('Account activation for ' . Yii::$app->name)
            ->send();
    }
    public function sendAccountEmail($user,$password)
    {
         /*$customers = UserProfile::find()->where(['user_id' => $user->id])->one();

        return Yii::$app->mailer->compose('adminEmail', ['user' => $user,'name'=>$customers->first_name,'password'=>$password])
            ->setFrom("santosh.mohan@dotsquares.com")
            ->setTo($this->email)
            ->setSubject('Account activation for ' . Yii::$app->name)
            ->send();*/
       $customers = UserProfile::find()->where(['user_id' => $user->id])->one();

        return Yii::$app->mailer->compose('accountActivationToken', ['user' => $user,'name'=>$customers->first_name,'password'=>$password])
            ->setFrom("santosh.mohan@dotsquares.com")
            ->setTo($this->email)
            ->setSubject('Account activation of 4statetruck.com')
            ->send();

    }

}
