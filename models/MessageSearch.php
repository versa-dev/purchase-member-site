<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;

/**
 * MessageSearch represents the model behind the search form about `app\models\Message`.
 */
class MessageSearch extends Message
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'to_user', 'mark_read', 'published'], 'integer'],
            [['subject', 'message', 'from_user', 'send_date'], 'safe'],
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
        $query = Message::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        //echo $this->send_date;

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'to_user' => $this->to_user,
            'DATE(send_date)' => $this->send_date,
            'mark_read' => $this->mark_read,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'from_user', $this->from_user]);
        $query->orderBy(['send_date' => SORT_DESC]);

        return $dataProvider;
    }
}
