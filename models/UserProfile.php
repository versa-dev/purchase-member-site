<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $paypal_email
 * @property integer $country_id
 * @property string $address
 * @property string $company_name
 * @property string $website
 * @property string $business_phone
 * @property string $company_address
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
  
  
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['user_id','phone_no','address','state', 'country_id'], 'required'],
            [['user_id', 'country_id'], 'integer'],
            
            [['image'], 'file'],
            [['image'], 'file', 'skipOnEmpty'=>TRUE, 'extensions'=>'jpg, jpeg, gif, png'],
            [['first_name', 'last_name'], 'safe'],
            //[['business_phone'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First name',
            'last_name'=>'Last name',
            'company_name'=>'Company name',
            'country_id' => 'Country ',
            'address' => 'Address',
            'image'=>'Profile picture'
        ];
    }
      /**
     * Finds user by user_id
     *
     * @param string $user_id
     * @return static|null
     */
    public static function findProfileByUserId($user_id) {

        return static::findOne(['user_id' =>$user_id]);
    }
    public static function findProfileByUId($user_id) {

        $uid= static::findOne(['user_id' =>$user_id]);
        return $uid->country_id;
    }
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function CountryName($id){
        if(!empty($id)){
            $c = Country::find()->where(['id' =>$id])->one()->name;
        }
        return $c; 
    }
}
