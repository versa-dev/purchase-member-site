<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $item_code
 * @property string $item_name
 * @property string $description
 * @property string $se_directory
 * @property string $search_word
 * @property integer $status
 * @property integer $modification_status
 * @property integer $deleted
 * @property string $created_date
 * @property string $modified_date
 *
 * @property ProductCat[] $productCats
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public $category_id;
    public function rules()
    {
        return [
            [['user_id', 'item_code', 'item_name', 'description', 'se_directory', 'search_word','category_id'], 'required'],
            [['user_id', 'status', 'modification_status', 'deleted'], 'integer'],
            [['description', 'search_word'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['item_code', 'item_name', 'se_directory'], 'string', 'max' => 255],
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
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
            'description' => 'Description',
            'se_directory' => 'Se Directory',
            'search_word' => 'Search Word',
            'status' => 'Status',
            'modification_status' => 'Modification Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'category_id'=>'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCats()
    {
        return $this->hasMany(ProductCat::className(), ['product_id' => 'id']);
    }
    /*public function getCats()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id'])->via('productCats');
    }*/
}
