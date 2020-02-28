<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "Help_category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $cat_name
 * @property string $alias
 * @property string $description
 * @property string $image
 * @property string $published
 */
class HelpCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'help_category';
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

    public function getHelp()
    {
        return $this->hasMany(Help::className(), ['category_id' => 'id']);
    }
    public function getSubCategory()
    {
        return $this->hasMany(HelpCategory::className(),['parent_id' => 'id'])->from(['cat' => 'help_category'])->orderBy(['orders'=>'SORT_ASC','cat_name'=>'SORT_DESC']);
    }
    public function getSubSubCategory()
    {
        return $this->hasMany(HelpCategory::className(),['parent_id' => 'id'])->via('subCategory')->from(['cat1' => 'help_category']);
    }

    public static function getCategories($parent_id=0){
        return $catList = ArrayHelper::map(HelpCategory::find()->where("parent_id = $parent_id")->orderBy(['orders'=>'SORT_ASC','cat_name'=>'SORT_DESC'])->asArray()->all(), 'id', 'cat_name');
    }
    public static function getAllCategories($parent_id=0){
        return $catList = ArrayHelper::map(HelpCategory::find()->asArray()->all(), 'id', 'cat_name');
    }
    public static function getCountCategory($parent_id=0){
            return $count = HelpCategory::find()->where(['parent_id' =>$parent_id,'published'=>1])->count(); 

    }
    
    public static function getCategoryName($id){
        if(!empty($id)){
            $c = HelpCategory::find()->where(['id' =>$id])->one()->cat_name;
        }else{
            $c='Category';
        }
        return $c; 
    }
    

}
