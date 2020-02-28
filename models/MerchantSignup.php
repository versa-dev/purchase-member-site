<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "merchant_signup".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $company_name
 * @property string $company_type
 * @property string $telephone
 * @property string $street_address
 * @property string $city
 * @property string $state
 * @property integer $country
 * @property string $postal_code
 * @property string $website_url
 * @property string $first_name
 * @property string $last_name
 * @property string $job_title
 * @property string $current_contact_number
 * @property string $email_address
 * @property string $time_zone_for_contact
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class MerchantSignup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant_signup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'telephone', 'street_address', 'city', 'state', 'country', 'postal_code', 'website_url', 'first_name', 'last_name', 'job_title', 'current_contact_number', 'email_address', 'time_zone_for_contact'], 'required'],
            [['user_id', 'country'], 'integer'],
            [['company_type'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_name', 'telephone', 'street_address', 'city', 'state', 'postal_code', 'website_url', 'first_name', 'last_name', 'job_title', 'current_contact_number', 'email_address', 'time_zone_for_contact'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'company_name' => 'Company Name',
            'company_type' => 'Company Type',
            'telephone' => 'Telephone',
            'street_address' => 'Street Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'website_url' => 'Website Url',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'job_title' => 'Job Title',
            'current_contact_number' => 'Current Contact Number',
            'email_address' => 'Email Address',
            'time_zone_for_contact' => 'Time Zone For Contact',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
