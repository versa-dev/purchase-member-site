<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_question".
 *
 * @property integer $id
 * @property string $question
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProfileQuestionAnswer[] $profileQuestionAnswers
 */
class ProfileQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileQuestionAnswers()
    {
        return $this->hasMany(ProfileQuestionAnswer::className(), ['question_id' => 'id']);
    }
}
