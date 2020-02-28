<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'user_id', 'status', 'modification_status', 'deleted'], 'integer'],
            [['item_code', 'item_name', 'description', 'se_directory', 'search_word', 'created_date', 'modified_date','published','user_id'], 'safe'],
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
        //$query = Product::find()->where(['published' =>1]);
        $query = Product::find();
        $query->joinWith(['productCatSearch','user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           // return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'published' => $this->published,
            'modification_status' => $this->modification_status,
            'deleted' => $this->deleted,
            'created_date' => $this->created_date,
            //'product.modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'item_code', $this->item_code])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'se_directory', $this->se_directory])
            ->andFilterWhere(['like', 'product.modified_date', $this->modified_date]);
            $query->andFilterWhere(['like', 'search_term_category.add_tree', $this->search_word]);
            //$query->andFilterWhere(['=', 'user.id', $this->user_id]);
            //->andFilterWhere(['like', 'search_word', $this->search_word]);

        return $dataProvider;
    }
    public function unsearch($params)
    {
        $query = Product::find()->where(['published' =>0]);
        $query->joinWith(['productCatSearch']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
           // return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'published' => $this->published,
            'modification_status' => $this->modification_status,
            'deleted' => $this->deleted,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'item_code', $this->item_code])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'se_directory', $this->se_directory]);
            $query->andFilterWhere(['like', 'search_term_category.add_tree', $this->search_word]);
           // ->andFilterWhere(['like', 'search_word', $this->search_word]);

        return $dataProvider;
    }
    public function frontendsearch($params)
    {
        $query = Product::find()->where(['user_id' =>Yii::$app->user->id]);
        $query->joinWith(['productCatSearch']);
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
         //   return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'published' => $this->published,
            'modification_status' => $this->modification_status,
            'deleted' => $this->deleted,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'item_code', $this->item_code])
            ->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'se_directory', $this->se_directory]);
            $query->andFilterWhere(['like', 'search_term_category.add_tree', $this->search_word]);
            //->andFilterWhere(['like', 'search_word', $this->search_word]);

        return $dataProvider;
    }
}
