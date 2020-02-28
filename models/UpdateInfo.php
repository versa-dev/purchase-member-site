<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "update_info".
 *
 * @property string $update_date
 * @property int $id
 */
class UpdateInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'update_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['update_date'], 'required'],
            [['update_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'update_date' => 'Update Date',
            'id' => 'ID',
        ];
    }
}
