<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pay_code".
 *
 * @property int $id
 * @property string $pay_code
 * @property string $created_at
 * @property string $updated_at
 */
class PayCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pay_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pay_code'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['pay_code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pay_code' => 'Pay Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
