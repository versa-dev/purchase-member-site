<?php
namespace app\models;

use app\models\User;
use app\models\UserProfile;
use yii\base\Model;
use Yii;

/**
 * Changepassword form
 */
class ChangePassword extends Model
{

    public $username;
    public $email;
    public $password;
    public $captcha;
    public $country_id;
    public $name;
    public $verifyPassword;
    public $old_password;
    public $aggrement;
    public $ageLimit;
    public $buyer_appraiser=1;
    public $usertype;
    public $paypal_email;
    public $address;
    public $account_activation_token;

    /*
     * For Buyer/Seller type registration
     * */
    public $ebayId;
    public $ebayRating;
    
    /*
     * For Appraiser type registration
     * */
    public $areaOfExperties;
    public $companyName;
    public $website;
    public $contactPerson;
    public $buisnessPhoneNumber;
    public $companyAddress;
    public $comments;
  


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            


            [['areaOfExperties','companyName','website','contactPerson','buisnessPhoneNumber','companyAddress'],'required',
                'when'=>function($model){
                    return $model->buyer_appraiser == 2;
                },
            ],
            [['companyName','website','contactPerson','buisnessPhoneNumber','companyAddress'],'filter', 'filter' => 'trim'],
            ['buisnessPhoneNumber','integer','when'=>function($model){
                    return $model->buyer_appraiser == 2;
                },
            ],

          
            //[['password','verifyPassword'], 'required'],
            [['password','verifyPassword','old_password'], 'required'],
            [['password','verifyPassword'], 'string', 'min' => 5 , 'max'=>18],
            [['old_password'], 'checkpassword'],
            ['verifyPassword','compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
              [['password', 'verifyPassword'], 'required', 'on' => 'changepassword'],
           // [['password', 'verifyPassword','username','email','country_id','name','usertype','address','paypal_email'], 'required', 'on' => 'register'],

            
        ];
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
            'password' => 'New Password',
            'old_password' => ' Old Password',
            'usertype'=>'User type',
            'paypal_email'=>'paypal email',
            'account_activation_token'=>'Activation key',
            'captcha'=>'',
            'country_id'=>'Country',
            'address'=>'Address',
            'verifyPassword' => 'Verify Password',
            'aggrement'=>'I have read and accepted the User Agreement and Privacy Policy',
            'ageLimit'=>'I am over 18 years of age ',
            'ebayId'=>'eBay ID',
            'ebayRating'=>'eBay Rating',

            'areaOfExperties'=>'Area Of Expertise',
            'companyName'=>'Company Name',
            'website'=>'Website',
            'contactPerson'=>'Contact Person',
            'buisnessPhoneNumber'=>'Buisness Phone',
            'companyAddress'=>'Company Address',
            'comments'=>'Comments',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
   
    public function changepassword()
    {
            $user= User::findById(Yii::$app->user->id);
        if ($this->validate()) {
           $user->password_hash= Yii::$app->security->generatePasswordHash($this->password);
            if($user->save()){
             return $user; 
            }
           //$p=  $user->setPassword($this->password); print_r( $p);die;
          
            
        }
       

        return null;
    }

      public function sendAccountActivationEmail($user)
    {
        return Yii::$app->mailer->compose('accountActivationToken', ['user' => $user])
            ->setFrom("gaurav.parashar@dotsquares.com")
            ->setTo($this->email)
            ->setSubject('Account activation for ' . Yii::$app->name)
            ->send();

    }

   public function checkpassword($attribute, $params)
    {
          $id = \Yii::$app->user->identity->id;
         $pass = $this->old_password; 
         $user = User::findOne(['id'=>$id]);
         $da =    $user->validatePassword($pass);
        if($da=='' and $da!="1"){
       $this->addError($attribute, 'You entered an invalid old password.');  
          }  
    }

}
