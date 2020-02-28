<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agent_identification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $primary_identification_type
 * @property string $primary_date_issued
 * @property string $primary_date_expiry
 * @property string $primary_serial_number
 * @property string $primary_body_location
 * @property string $secondary_identification_type
 * @property string $secondary_date_issued
 * @property string $secondary_date_expiry
 * @property string $secondary_serial_number
 * @property string $secondary_body_location
 * @property string $type
 * @property string $date_issued
 * @property string $date_of_birth
 * @property string $serial_number
 * @property string $body_location
 * @property string $witness_name
 * @property string $country_of_birth
 * @property string $city_of_birth
 * @property string $other
 * @property string $mother_firstname
 * @property string $mother_middlename
 * @property string $mother_lastname
 * @property string $mother_maidenname
 * @property string $mother_date_of_birth
 * @property string $mother_wetness_name
 * @property string $father_firstname
 * @property string $father_middlename
 * @property string $father_lastname
 * @property string $father_maidenname
 * @property string $father_date_of_birth
 * @property string $father_wetness_name
 * @property string $address_identification_type
 * @property string $address_date_issued
 * @property string $address_serial_number
 * @property string $address_issuing_body_name
 * @property string $address_street_address
 * @property string $address_phone_number
 * @property string $address_utility
 * @property integer $status
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 */
class AgentIdentification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agent_identification';
    }

    /**
     * @inheritdoc
     */
    public $aggrement;
    public function rules()
    {
        $before_month_time = time() - (30 * 24 * 60 * 60);
        $before_month_string = date('Y-m-d', $before_month_time);

        return [
            [['primary_identification_type', 'primary_date_issued', 'primary_date_expiry','primary_serial_number','primary_body_location',
                'secondary_identification_type', 'address_date_issued', 'address_serial_number', 'address_issuing_body_name', 'address_street_address',
                'address_phone_number', 'address_identification_type','first_name_agent','last_name_agent','email_agent','decleration'], 'required'],
            ['aggrement', 'required','requiredValue' => 1, 'message' => 'click accept terms and conditions'],

            [['user_id', 'status'], 'integer'],

            [['primary_identification_type', 'secondary_identification_type', 'type', 'address_identification_type'], 'string'],

            [['primary_date_issued', 'primary_date_expiry', 'secondary_date_issued', 'secondary_date_expiry', 'date_issued', 'date_of_birth',
                'mother_date_of_birth', 'father_date_of_birth', 'address_date_issued', 'created', 'updated','primary_identification_other',
                'secondary_identification_other', 'first_name_agent','last_name_agent','email_agent','decleration'], 'safe'],

            [['primary_serial_number', 'primary_body_location', 'secondary_serial_number', 'secondary_body_location', 'serial_number',
                'body_location', 'witness_name', 'country_of_birth', 'city_of_birth', 'other', 'mother_firstname', 'mother_middlename',
                'mother_lastname', 'mother_maidenname', 'mother_wetness_name', 'father_firstname', 'father_middlename', 'father_lastname',
                'father_maidenname', 'father_wetness_name', 'address_serial_number', 'address_issuing_body_name', 'address_street_address',
                'address_utility', 'address_phone_number'], 'string', 'max' => 255],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            [['mother_firstname', 'mother_lastname', 'country_of_birth', 'city_of_birth'], 'required','when' => function ($model) {

                    return $model->secondary_identification_type == "Birth Certificate";
                }, 'whenClient' => "function (attribute, value) {

                return $(\"#agentidentification-secondary_identification_type\").val() == 'Birth Certificate';

            }"],

            [['secondary_date_expiry', 'secondary_date_issued', 'secondary_serial_number', 'secondary_body_location'], 'required','when' => function ($model) {

                return $model->secondary_identification_type != "Birth Certificate";
            }, 'whenClient' => "function (attribute, value) {

                return $(\"#agentidentification-secondary_identification_type\").val() != 'Birth Certificate';

            }"],


            ['address_phone_number', 'match', 'pattern' => '/^\+?([0-9]{10,})$/'],
            ['address_phone_number', 'string', 'min' => 5, 'max'=> 15],

            [['address_date_issued'], 'compare', 'compareValue'=>$before_month_string, 'operator'=> '>=', 'message'=>"The issue date is valid from 30 days before."],
            [['address_date_issued'], 'compare', 'compareValue'=>date('Y-m-d'), 'operator'=> '<', 'message'=>"The date of the issue should be today before."],

//            [['primary_date_issued'], 'compare', 'compareAttribute'=>'primary_date_expiry', 'operator'=> '<', 'message'=>"The issued date should be before the expired date."],
//            [['primary_date_expiry'], 'compare', 'compareAttribute'=>'primary_date_issued', 'operator'=> '>', 'message'=>"The expired date should be after the issued date."],
//            [['secondary_date_issued'], 'compare', 'compareAttribute'=>'secondary_date_expiry', 'operator'=> '<', 'message'=>"The issued date should be before the expired date."],
//            [['secondary_date_expiry'], 'compare', 'compareAttribute'=>'secondary_date_issued', 'operator'=> '>', 'message'=>"The expired date should be after the issued date."],
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
            'primary_identification_type' => 'Identification Type',
            'primary_date_issued' => 'Date Issued',
            'primary_date_expiry' => 'Date Expiry',
            'primary_serial_number' => 'Serial Number',
            'primary_body_location' => 'Issing Government Department',
            'secondary_identification_type' => 'Identification Type',
            'secondary_date_issued' => 'Date Issued',
            'secondary_date_expiry' => 'Date Expiry',
            'secondary_serial_number' => 'Serial Number',
            'secondary_body_location' => 'Issing Government Department',
            'type' => 'Type',
            'date_issued' => 'Date Issued',
            'date_of_birth' => 'Date Of Birth',
            'serial_number' => 'Serial Number',
            'body_location' => 'Issing Government Department',
            'witness_name' => 'Witness Name',
            'country_of_birth' => 'Country Name',
            'city_of_birth' => 'City Name',
            'other' => 'Other',
            'mother_firstname' => 'Firstname',
            'mother_middlename' => 'Middlename',
            'mother_lastname' => 'Lastname',
            'mother_maidenname' => 'Maiden Name',
            'mother_date_of_birth' => 'Date Of Birth',
            'mother_wetness_name' => 'Wetness Name',
            'father_firstname' => 'Firstname',
            'father_middlename' => 'Middlename',
            'father_lastname' => 'Lastname',
            'father_maidenname' => 'Miscellaneous',
            'father_date_of_birth' => 'Date Of Birth',
            'father_wetness_name' => 'Wetness Name',
            'address_identification_type' => 'Identification Type',
            'address_date_issued' => 'Date Issued',
            'address_serial_number' => 'Serial Number',
            'address_issuing_body_name' => 'Issuing Body Name',
            'address_street_address' => 'Street Address',
            'address_phone_number' => 'Phone Number',
            'address_utility' => 'Utility',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
            'primary_identification_other'=>'Other Identification Type',
            'secondary_identification_other'=>'Other Identification Type',
            'first_name_agent'=>'First name',
            'last_name_agent'=>'Last name',
            'email_agent'=>'Email',
            'decleration'=>'Affirmation',
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
