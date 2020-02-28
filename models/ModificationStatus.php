<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modification_status".
 *
 * @property integer $id
 * @property string $modification_status
 */
class ModificationStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modification_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modification_status'], 'required'],
            [['modification_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modification_status' => 'Modification Status',
        ];
    }
}
