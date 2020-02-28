<?php

namespace app\models;

use Yii;

class ReferMerchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refer_a_merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_name', 'organization_website','name_of_contact','position','email','contact','extension'], 'required'],
            [['user_id'], 'integer'],
            [['email'], 'email'],
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
            'organization_name' => 'Organization Name',
            'organization_website' => 'Organization Website',
            'name_of_contact' => 'Name of Contact',
            'position' => 'Position',
            'email' => 'Email',
            'contact' => 'Contact',
            'extension' => 'Extension',
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
