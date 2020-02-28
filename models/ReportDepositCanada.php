<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_deposit_canada".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $amount
 * @property string $bank_name
 * @property string $upload_receive
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class ReportDepositCanada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $payment_date_time;
    public $payment_time;
    public $importfile;
    public static function tableName()
    {
        return 'report_deposit_canada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'payment_date_time','bank_name'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['bank_name'], 'string'],
            [['payment_date_time'],'safe'],
            [['created_at', 'updated_at',], 'safe'],
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
            'amount' => 'Amount',
            'bank_name' => 'Bank Name',
            //'importfile' =>'',
            'payment_date_time' => 'Date of Payment',
            'payment_time' => 'Time of Payment',
            'date_of_birth'=>'date of birth',
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
