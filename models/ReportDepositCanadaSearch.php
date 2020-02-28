<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportDepositCanada;


/**
 * SafePurchaseSearch represents the model behind the search form about `app\models\SafePurchase`.
 */
class ReportDepositCanadaSearch extends ReportDepositCanada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['payment_date_time', 'bank_name', 'email','created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],


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

        $query = ReportDepositCanada::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        /* if (!$this->validate()) {
             // uncomment the following line if you do not want to return any records when validation fails
             // $query->where('0=1');
             return $dataProvider;
         }*/

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            //'payment_date_time'=>$this->payment_date_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name]);

        // ->andFilterWhere(['like', 'description', $this->description]);
        // ->andFilterWhere(['like', 'more_items', $this->more_items]);

        return $dataProvider;
    }
}
