<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountStatement;

/**
 * AccountStatementSearch represents the model behind the search form about `app\models\AccountStatement`.
 */
class AccountStatementSearch extends AccountStatement
{
    /**
     * @inheritdoc
     */
    public $user_id;
    public $email;
    public function rules()
    {
        return [
            [['id', 'user_id', 'detail_link'], 'integer'],
            [['date', 'time', 'email','description', 'current_balance', 'created_at', 'updated_at', 'email'], 'safe'],
            [['balance_forward', 'credit', 'debit'], 'number'],
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
        $query = AccountStatement::find();
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'time' => $this->time,
            'balance_forward' => $this->balance_forward,
            'credit' => $this->credit,
            'debit' => $this->debit,
            'detail_link' => $this->detail_link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.id', $this->user_id])
            ->andFilterWhere(['like', 'user.email', $this->email])
            ->andFilterWhere(['like', 'current_balance', $this->current_balance]);

        return $dataProvider;
    }
}
