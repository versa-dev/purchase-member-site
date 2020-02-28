<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "safe_purchase".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property double $total_amount
 * @property string $shopping_cart
 * @property string $description
 * @property string $more_items
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class SafePurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'safe_purchase';
    }

    /**
     * @inheritdoc
     */
     public $image;
    public function rules()
    {
        return [
            [['vendor_name','url', 'total_amount','cart_user_id','cart_password'], 'required'],
            [['user_id'], 'integer'],
            [['total_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            //[['url', 'shopping_cart'], 'string', 'max' => 255],
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
            'url' => 'Paste the URL here',
            'total_amount' => 'Total Amount of the purchase',
            'cart_user_id' => 'Cart User ID',
            'cart_password' =>'Cart Password',
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
