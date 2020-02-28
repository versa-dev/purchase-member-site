<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_deposit_emt".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $amount
 * @property string $question_answer
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class ReportDepositEmt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $payment_time;
    public static function tableName()
    {
        return 'report_deposit_emt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'question_answer','payment_date_time'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['question_answer'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
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
            'payment_date_time' => 'Date of Payment',
            'payment_time' => 'Time of Payment',
            'question_answer' => 'Answer to the security question. It should be different every time',
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
