<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_question_answer".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $question_id
 * @property integer $answer
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property ProfileQuestion $question
 */
class ProfileQuestionAnswerCustom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_question_answer_custom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['user_id', 'question_id'], 'required'],
            //[['user_id', 'question_id', 'answer'], 'integer'],
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
            'question' => 'Question',
            'answer' => 'Answer',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(ProfileQuestion::className(), ['id' => 'question_id']);
    }
}
