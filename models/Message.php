<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $subject
 * @property string $message
 * @property string $from_user
 * @property integer $to_user
 * @property string $send_date
 * @property integer $mark_read
 * @property integer $published
 *
 * @property User $toUser
 */
class Message extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_id', 'to_user', 'mark_read', 'published'], 'integer'],
           // [['subject', 'from_user', 'to_user'], 'required'],
           // [['message'], \app\components\ProfanityFilter::className()],
           // [['subject'], \app\components\ProfanityFilter::className()],[['subject', 'from_user', 'to_user'], 'required'],   
             [['subject', 'message', 'email','first_name','last_name'], 'required'],
            [['message'], 'string'],
            [['send_date'], 'safe'],
            [['subject'], 'string', 'max' => 255],
            [['attachment'], 'file', 'extensions' => 'gif, jpg, jpeg, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'subject' => 'Subject',
            'message' => 'Message',
            'from_user' => 'From User',
            'to_user' => 'To User',
            'send_date' => 'Send Date',
            'mark_read' => 'Mark Read',
            'published' => 'Published',
        ];
    }
    public function checkBadWords($attribute, $params) {
        $words = explode(" ", $this->$attribute);

        $alias = Yii::getAlias('@root') . "/badwords.txt";
        if ($fp = fopen($alias, 'r')) {
            $badWords = file_get_contents($alias);
            foreach ($words as $word) {
                if (strripos($badWords, $word) > 0) {
                    $this->addError($attribute, '"' . ucwords(str_replace("_", " ", $attribute)) . '" contain inappropriate words.');
                }
            }
            fclose($fp);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser() {
        return $this->hasOne(User::className(), ['id' => 'to_user']);
    }

    public function getFromUser() {
        return $this->hasOne(User::className(), ['id' => 'from_user']);
    }

    /**
     * send an email
     */
    public function sendMail() {
        return \Yii::$app->mailer->compose()
                        ->setFrom([\Yii::$app->user->identity->email => \Yii::$app->user->identity->profile->name])
                        ->setTo(\app\models\User::findOne($this->to_user)->email)
                        ->setSubject($this->subject)
                        ->setTextBody($this->message)
                        ->send();
    }

}
