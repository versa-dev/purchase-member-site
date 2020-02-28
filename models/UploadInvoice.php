<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "upload_invoice".
 *
 * @property integer $id
 * @property integer $member_service_id
 * @property string $invoice_receipt
 * @property string $created_date
 * @property string $updated_date
 */
class UploadInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'upload_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['member_service_id', 'invoice_receipt'], 'required'],
            [['invoice_receipt'], 'file'],
           [['created_date', 'updated_date','invoice_receipt'], 'safe'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_service_id' => 'Member Service ID',
            'invoice_receipt' => 'Invoice Receipt',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
