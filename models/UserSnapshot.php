<?php

namespace app\models;

use app\models\User;
use app\models\UserProfile;
use Yii;

/**
 * This is the model class for table "family_protection_member".
 *
 * @property integer $id
 * @property integer $family_protection_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $relation
 * @property string $email
 * @property integer $age
 * @property string $cell_phone
 * @property string $apg
 * @property string $home_phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FamilyProtection $familyProtection
 */
class UserSnapshot extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_snapshot';
    }

   
    
}
