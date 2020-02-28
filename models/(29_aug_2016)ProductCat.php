<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_cat".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 *
 * @property Product $product
 * @property ProductCategory $category
 */
class ProductCat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_cat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['product_id', 'category_id'], 'required'],
           // [['product_id', 'category_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->via('product');
    }
}
