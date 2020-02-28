<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "family_protection".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FamilyProtectionMember[] $familyProtectionMembers
 */
class FamilyProtection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'family_protection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['user_id'], 'required'],
            [['user_id'], 'integer'],
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyProtectionMembers()
    {
        return $this->hasMany(FamilyProtectionMember::className(), ['family_protection_id' => 'id']);
    }
}
