<?php
namespace app\models;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
class User extends ActiveRecord implements \yii\web\IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_NOT_ACTIVE = 0;
    const ROLE_USER = 10;
    public $country_id;
    public $name;
    public $client_type;

   
   /* public $email;

    public $password;
    public $captcha;
    public $country_id;
    public $name;
    public $verifyPassword;
    public $usertype;
    public $address;
    public $account_activation_token;
    public $from_date;
    public $supplier_id;
    public $parent_id;
    public $service_type;
    public $client_type;*/

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
  public function rules()
    {
        return [
           
           /* ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 5, 'max' => 15],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],


            ['country_id', 'filter', 'filter' => 'trim'],
            ['country_id', 'required'],

           
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            
           
            ['usertype', 'filter', 'filter' => 'trim'],
            ['usertype', 'required','message'=>'Please select User Type'],
            [['usertype'],'safe'],*/

           /* [['password','verifyPassword'], 'required'],
            [['password','verifyPassword'], 'required'],
            [['password','verifyPassword'], 'string', 'min' => 5 , 'max'=>8],
            ['verifyPassword','compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"],
            [['password', 'verifyPassword'], 'required', 'on' => 'changepassword'],*/
            
            /*[['username','name','email','supplier_id','country_id','service_type','client_type'], 'required', 'on' => 'client'],
    
            ['parent_id', 'required',  'on' => 'client','when' => function ($model) {
                return $model->client_type == 'Child';
            }, 'whenClient' => "function (attribute, value) {
                return $('#signupform-client_type').val() == 'Child';
            }"],*/
            //[['captcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className()]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
       $this->password_hash = Yii::$app->security->generatePasswordHash($password); 
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
    /**
     * Finds user by account activation token.
     *
     * @param  string $token Account activation token.
     * @return static|null
     */
    public static function findByAccountActivationToken($token)
    {
        return static::findOne([
            'account_activation_token' => $token,
            'status' => User::STATUS_NOT_ACTIVE,
        ]);
    }
      /**
     * Generates new account activation token.
     */
    public function generateAccountActivationToken()
    {
        $this->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removeAccountActivationToken()
    {
        $this->account_activation_token = null;
    }
    /**
     * Finds user by user_id
     *
     * @param string $user_id
     * @return static|null
     */
    public static function findById($id) {
        return static::findOne(['id' => $id]);
    }
    public static function findByEmail($email) {
        $email_id= static::findOne(['email' => $email]);
        return $email_id->id;
    }
    
    public static function getUserRoles(){
        $user_roles =Yii::$app->authManager->getRoles();
        return $userRoles  = ArrayHelper::map($user_roles, 'name', 'name');
    }
    
    /*public function getUser()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'user_id']);
    }*/
     public function getProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }
    public function getParentName(){

        $model=$this->profile;

        return $model?$model->first_name:'';

    }
     public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id'])->via('profile');
    }
     
}
