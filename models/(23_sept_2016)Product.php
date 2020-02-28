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
            [['user_id', 'item_code', 'item_name', 'description'], 'required'],
            [['user_id', 'published','deleted'], 'integer'],
            [['description', 'search_word'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['item_code', 'item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Vendor',
            'item_code' => 'Item Code',
            'item_name' => 'Description_Sage',
            'description' => 'Description_Web',
            'se_directory' => 'SE_Directory',
            'search_word' => 'Search Terms',
            'status' => 'Status',
            'modification_status' => 'Modification Status',
            'deleted' => 'Deleted',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'category_id'=>'Category',
            'published'=>'Published',
            'product_category'=>'Product Category'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCats()
    {
        return $this->hasMany(ProductCat::className(), ['product_id' => 'id']);
    }
    public function getProductCatSearch()
    {
        return $this->hasMany(SearchTermCategory::className(), ['product_id' => 'id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /*public function getCats()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id'])->via('productCats');
    }*/
}
