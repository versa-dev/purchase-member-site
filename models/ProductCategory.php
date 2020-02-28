<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "product_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $cat_name
 * @property string $alias
 * @property string $description
 * @property string $image
 * @property string $published
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id','orders'], 'integer'],
            [['cat_name'], 'required'],
            [['description'], 'string'],
            [['cat_name', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'cat_name' => 'Category Name',
            'alias' => 'Alias',
            'description' => 'Description',
            'image' => 'Image',
            'orders' => 'Order',
            'published' => 'Published',
        ];
    }

    public function getProduct()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
    public function getSubCategory()
    {
        return $this->hasMany(ProductCategory::className(),['parent_id' => 'id'])->from(['cat' => 'product_category'])->orderBy(['orders'=>'SORT_ASC','cat_name'=>'SORT_DESC']);
    }
    public function getSubSubCategory()
    {
        return $this->hasMany(ProductCategory::className(),['parent_id' => 'id'])->via('subCategory')->from(['cat1' => 'product_category']);
    }

    public static function getCategories($parent_id=0){
        return $catList = ArrayHelper::map(ProductCategory::find()->where("parent_id = $parent_id")->orderBy(['orders'=>'SORT_ASC','cat_name'=>'SORT_DESC'])->asArray()->all(), 'id', 'cat_name');
    }
    public static function getAllCategories($parent_id=0){
        return $catList = ArrayHelper::map(ProductCategory::find()->asArray()->all(), 'id', 'cat_name');
    }
    public static function getCountCategory($parent_id=0){
            return $count = HelpCategory::find()->where(['parent_id' =>$parent_id,'published'=>1])->count(); 

    }
    
    public static function getCategoryName($id){
        if(!empty($id)){
            $c = ProductCategory::find()->where(['id' =>$id])->one()->cat_name;
        }else{
            $c='Category';
        }
        return $c; 
    }
    

}
