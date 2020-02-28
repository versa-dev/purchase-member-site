<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report_payment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property date $date
 * @property time $time
 * @property string $bank
 * @property float $amount
 * @property string $pay_code
 * @property string $email
 * @property float $account_balance
 * @property float $new_balance
 * @property int $confirmed
 *
 * @property User $user
 */
class ReportPayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reported_payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date','time', 'bank','amount'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User Name',
            'Bank' => 'Enter Bank Name',
            'amount' => 'Ammount',
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
