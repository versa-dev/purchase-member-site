<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_statement".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $time
 * @property double $balance_forward
 * @property double $credit
 * @property double $debit
 * @property string $description
 * @property integer $detail_link
 * @property string $current_balance
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class AccountStatement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $email;
    public static function tableName()
    {
        return 'account_statement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','balance_forward', 'credit', 'debit', 'description', 'current_balance'], 'required'],
            [['user_id', 'detail_link'], 'integer'],
            [['date', 'time', 'email','created_at', 'updated_at'], 'safe'],
            [['balance_forward', 'credit', 'debit'], 'number'],
            [['description'], 'string'],
            [['current_balance'], 'string', 'max' => 255],
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
            'user_id' => 'User Name',
            'date' => 'Date',
            'time' => 'Time',
            'email' =>'email',
            'balance_forward' => 'Balance Forward',
            'credit' => 'Credit',
            'debit' => 'Debit',
            'description' => 'Description',
            'detail_link' => 'Detail Link',
            'current_balance' => 'Current Balance',
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
