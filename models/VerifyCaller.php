<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "verify_caller".
 *
 * @property int $id
 * @property string $s_first_name
 * @property string $s_last_name
 * @property string $s_phone_number
 * @property string $s_extension
 * @property string $s_email
 * @property string $org_name
 * @property string $org_address
 * @property string $org_city
 * @property string $state_province
 * @property string $zip_postal_code
 * @property string $country
 * @property int $s_user_id
 * @property string $date
 * @property string $time
 * @property string $r_first_name
 * @property string $r_last_name
 * @property string $r_email_address
 * @property string $r_phone_number
 * @property int $r_user_id
 * @property string $challese_word
 * @property int $s_status
 * @property int $r_status
 */
class VerifyCaller extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify_caller';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_last_name', 's_phone_number', 's_email', 'r_first_name', 'r_last_name', 'r_email_address', 'r_phone_number'], 'required'],
            [['s_extension'], 'string'],
            [['s_user_id', 'r_user_id', 's_status', 'r_status'], 'integer'],
            [['date', 'time'], 'safe'],
            [['s_first_name', 's_last_name', 's_phone_number', 'r_first_name', 'r_last_name', 'r_phone_number'], 'string', 'max' => 30],
            [['s_email', 'org_address', 'org_city', 'state_province', 'zip_postal_code', 'r_email_address', 'challese_word'], 'string', 'max' => 255],
            [['org_name', 'country'], 'string', 'max' => 100],
            ['zip_postal_code', 'match', 'pattern' => '/[A-Z][0-9][A-Z] [0-9][A-Z][0-9]/','when' => function ($model) {
                return $model->country == 38;
            }, 'whenClient' => "function (attribute, value) {
                return $('#verifycaller-country').val() == '38';
            }",'message'=>"The Canada post code format should be A#A #A#"],


            ['s_email', 'filter', 'filter' => 'trim'],
            ['s_email', 'required'],
            ['s_email', 'email'],

            ['r_email_address', 'filter', 'filter' => 'trim'],
            ['r_email_address', 'required'],
            ['r_email_address', 'email'],


            ['zip_postal_code', 'string', 'length' => 7, 'when' => function ($model) {
                return $model->country == 38;
            }, 'whenClient' => "function (attribute, value) {
                return $('#verifycaller-country').val() == '38';
            }",'message'=>"The length of Canada post code should be 7."],

            ['zip_postal_code', 'match', 'pattern' => '/\d{5,15}$/','when' => function ($model) {
                return $model->country == 226;
            }, 'whenClient' => "function (attribute, value) {
                return $('#verifycaller-country').val() == '226';
            }",'message'=>"The USA ZIP Code should contain the only digit."],

            ['zip_postal_code', 'string', 'min' => 5, 'max'=> 15, 'when' => function ($model) {
                return $model->country == 226;
            }, 'whenClient' => "function (attribute, value) {
                return $('#verifycaller-country').val() == '226';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_first_name' => 'S First Name',
            's_last_name' => 'S Last Name',
            's_phone_number' => 'S Phone Number',
            's_extension' => 'S Extension',
            's_email' => 'S Email',
            'org_name' => 'Org Name',
            'org_address' => 'Org Address',
            'org_city' => 'Org City',
            'state_province' => 'State Province',
            'zip_postal_code' => 'Zip Postal Code',
            'country' => 'Country',
            's_user_id' => 'S User ID',
            'date' => 'Date',
            'time' => 'Time',
            'r_first_name' => 'R First Name',
            'r_last_name' => 'R Last Name',
            'r_email_address' => 'R Email Address',
            'r_phone_number' => 'R Phone Number',
            'r_user_id' => 'R User ID',
            'challese_word' => 'Challese Word',
            's_status' => 'S Status',
            'r_status' => 'R Status',
        ];
    }
}
