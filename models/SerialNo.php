<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "serial_no".
 *
 * @property integer $id
 * @property string $serial_no
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class SerialNo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'serial_no';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['serial_no'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['serial_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'serial_no' => 'Serial No',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
