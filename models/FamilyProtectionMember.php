<?php

namespace app\models;

use app\components\MtypeControl;
use app\models\User;
use app\models\UserProfile;
use Yii;

/**
 * This is the model class for table "family_protection_member".
 *
 * @property integer $id
 * @property integer $family_protection_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $relation
 * @property string $email
 * @property integer $age
 * @property string $cell_phone
 * @property string $apg
 * @property string $home_phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FamilyProtection $familyProtection
 */
class FamilyProtectionMember extends \yii\db\ActiveRecord
{
    public $username;
    public $password;
    public $date_of_birth;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'family_protection_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name', 'relation', 'email',  'cell_phone',  'date_of_birth', 'username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            [['family_protection_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'relation', 'email'], 'string', 'max' => 255],
            ['cell_phone', 'filter', 'filter' => 'trim'],
            [['cell_phone'], 'integer'],
            [['cell_phone'], 'string', 'min' =>10],
            [['family_protection_id'], 'exist', 'skipOnError' => true, 'targetClass' => FamilyProtection::className(), 'targetAttribute' => ['family_protection_id' => 'id']],
        ];
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'family_protection_id' => 'Family Protection ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'relation' => 'Relation',
            'email' => 'Email',
            'cell_phone' => 'Cell Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'date_of_birth'=>'Date of Birth',
            'username'=>'Username',
            'password'=>'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyProtection()
    {
        return $this->hasOne(FamilyProtection::className(), ['id' => 'family_protection_id']);
    }
    
     public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            //$user->usertype = 'register';
            $user->status = '10'; 
           
            $user->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();
           
           //$user->password = Yii::$app->security->generatePasswordHash($this->password);
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $last_no= \app\models\SerialNo::find()->Where(['status'=>0])->orderBy('id asc')->one();
            $user->user_code= $last_no['serial_no'];
            
            $dateOfBirth = \app\components\GeneralHelper::inserDateformate($this->date_of_birth);;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');
            
            $row=\app\models\UserProfile::find()->Where(['user_id'=>Yii::$app->user->id])->one(); 
            $newgc = $row->group_code;
            
           if ($user->save()) {
                Yii::$app->db->createCommand()->update('serial_no', ['status' => 1], ['serial_no'=>$last_no['serial_no']])->execute();
                $userprofile= new UserProfile();
                $userprofile->user_id=$user->id;
                $userprofile->first_name=$this->first_name;
                $userprofile->last_name=$this->last_name;
                $userprofile->phone_no=$this->cell_phone;
                $userprofile->date_of_birth=\app\components\GeneralHelper::inserDateformate($this->date_of_birth);
                $userprofile->group_code=$newgc;
                $userprofile->age=$age;
                $userprofile->pass_change = '1';

               //added by GP

               $userprofile->mtype = MtypeControl::getMemberMtype($age);
               $userprofile->date_of_membership = $today;

               if($userprofile->mtype === 'D')
               {
                   $userprofile->pay_code = $row->pay_code;
               }
               else
               {
                   $pay_code = new PayCode();
                   $pay_code->pay_code = '1';
                   $pay_code->save();
                   $realPayCode = MtypeControl::getPayCode($pay_code->id);
                   $pay_code->pay_code = $realPayCode;
                   $pay_code->save();
                   $userprofile->pay_code = $realPayCode;
               }

                if ($userprofile->save()) {
                
                }
                Yii::$app->authManager->assign(Yii::$app->authManager->getRole('register'), $user->id);
                return $user;
            }
            
        }

        return null;
    }
    
}
