<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductCat;
use app\components\CategoryTree;

/**
 * ProductCatSearch represents the model behind the search form about `app\models\ProductCat`.
 */
class ProductCatSearch extends ProductCat
{
    /**
     * @inheritdoc
     */
    public $item_name;
    public $item_code;
    public $published;
    public $search_word;
    public function rules()
    {
        return [
            [['id', 'product_id', 'category_id'], 'integer'],
            [['item_name','item_code','category_id','search_word','published'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProductCat::find();
        $query->joinWith(['product','category']);
        //$query->joinWith(['product','category','user']);
        $query->where(["product.published"=>"1"]);

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize'=>12],
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
        'attributes' => [
            'id',
            'cat_name' => [
                'asc' => ['cat_name' => SORT_ASC],
                'desc' => ['cat_name' => SORT_DESC],
                'label' => 'Category'
                ],
           'item_name' => [
                'asc' => ['item_name' => SORT_ASC],
                'desc' => ['item_name' => SORT_DESC],
                'label' => 'Item name'
                ],
            'item_code' => [
                'asc' => ['item_code' => SORT_ASC],
                'desc' => ['item_code' => SORT_DESC],
                'label' => 'Item code'
                ],
            //'country_id'
        ]
    ]);

        if(!empty($this->category_id)){  
                //get child categories 
                $cate =new CategoryTree();
                $cate=$cate->getChildCategories($this->category_id);
                $cate[]=$this->category_id;
                $query->andFilterWhere(['product_category.id'=>$cate]);
        }

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'product_id' => $this->product_id,
            //'category_id111' => $this->category_id,
        ]);
         $query->andFilterWhere(['like', 'product.item_code', $this->item_code]);
         $query->andFilterWhere(['like', 'product.item_name', $this->item_name]);
         $query->andFilterWhere(['like', 'product.search_word', $this->search_word]);

        return $dataProvider;
    }
    public function unapprovesearch($params)
    {
        $query = ProductCat::find();
        $query->joinWith(['product','category']);
        //$query->joinWith(['product','category','user']);
        $query->where(["product.published"=>"0"]);

        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize'=>12],
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
        'attributes' => [
            'id',
            'cat_name' => [
                'asc' => ['cat_name' => SORT_ASC],
                'desc' => ['cat_name' => SORT_DESC],
                'label' => 'Category'
                ],
           'item_name' => [
                'asc' => ['item_name' => SORT_ASC],
                'desc' => ['item_name' => SORT_DESC],
                'label' => 'Item name'
                ],
            'item_code' => [
                'asc' => ['item_code' => SORT_ASC],
                'desc' => ['item_code' => SORT_DESC],
                'label' => 'Item code'
                ],
            //'country_id'
        ]
    ]);

        if(!empty($this->category_id)){  
                //get child categories 
                $cate =new CategoryTree();
                $cate=$cate->getChildCategories($this->category_id);
                $cate[]=$this->category_id;
                $query->andFilterWhere(['product_category.id'=>$cate]);
        }

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'product_id' => $this->product_id,
            //'category_id111' => $this->category_id,
        ]);
         $query->andFilterWhere(['like', 'product.item_code', $this->item_code]);
         $query->andFilterWhere(['like', 'product.item_name', $this->item_name]);
         $query->andFilterWhere(['like', 'product.search_word1', $this->search_word]);

        return $dataProvider;
    }
    public function frontendsearch($params)
    {
        $query = ProductCat::find();
        $query->joinWith(['product','category']);
        //$query->joinWith(['product','category','user']);
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize'=>12],
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
        'attributes' => [
            'id',
            'cat_name' => [
                'asc' => ['cat_name' => SORT_ASC],
                'desc' => ['cat_name' => SORT_DESC],
                'label' => 'Category'
                ],
           'item_name' => [
                'asc' => ['item_name' => SORT_ASC],
                'desc' => ['item_name' => SORT_DESC],
                'label' => 'Item name'
                ],
            'item_code' => [
                'asc' => ['item_code' => SORT_ASC],
                'desc' => ['item_code' => SORT_DESC],
                'label' => 'Item code'
                ],
            //'country_id'
        ]
    ]);

        if(!empty($this->category_id)){  
                //get child categories 
                $cate =new CategoryTree();
                $cate=$cate->getChildCategories($this->category_id);
                $cate[]=$this->category_id;
                $query->andFilterWhere(['product_category.id'=>$cate]);
        }

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'product_id' => $this->product_id,
            //'category_id111' => $this->category_id,
        ]);
         $query->andFilterWhere(['like', 'product.item_code', $this->item_code]);
         $query->andFilterWhere(['like', 'product.item_name', $this->item_name]);
         $query->andFilterWhere(['=', 'product.published', $this->published]);

        return $dataProvider;
    }
}
