<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_service".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $member_service
 * @property double $tax
 * @property double $bank
 * @property double $tracking_amount
 * @property double $family_protection
 * @property double $safe_purchase
 * @property double $total_amount
 * @property string $status
 * @property string $created_date
 * @property string $updated_date
 */
class MemberService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['member_service', 'tax', 'bank', 'tracking_amount', 'family_protection', 'safe_purchase'], 'number'],
            [['status'], 'string'],
            [['created_date', 'updated_date'], 'safe'],*/
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
            'member_service' => 'Member Service',
            'tax' => 'Tax',
            'bank' => 'Bank',
            'tracking_amount' => 'Tracking Amount',
            'family_protection' => 'Family Protection',
            'safe_purchase' => 'Safe Purchase',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'total_amount' => 'Total Amount',
        ];
    }
    public function getUploadInvoice()
    {
        return $this->hasOne(UploadInvoice::className(), ['member_service_id' => 'id']);
    }
}
