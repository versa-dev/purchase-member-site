<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "se_directory".
 *
 * @property integer $id
 * @property string $se_directory
 */
class SeDirectory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'se_directory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['se_directory'], 'required'],
            [['se_directory'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'se_directory' => 'Se Directory',
        ];
    }
}
