<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
   public $nicename;
    public function attributes()
    {
    // add related fields to searchable attributes
    return array_merge(parent::attributes(), ['name']);
    }
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'account_activation_token', 'email', 'usertype','status','name','nicename'], 'safe'],
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
        $query = User::find();
        $query->where(["user.usertype"=>"Vendor"]);
        $query->joinWith(['profile']);
        $query->joinWith(['country']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);
$dataProvider->sort->attributes['name'] = [
        'asc' => ['user_profile.first_name' => SORT_ASC],
        'desc' => ['user_profile.first_name' => SORT_DESC],
    ];
        if (!($this->load($params) && $this->validate())) {
            //return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'account_activation_token', $this->account_activation_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'usertype', $this->usertype]);
            $query->andFilterWhere(['like', 'user_profile.first_name', $this->name]);
            $query->andFilterWhere(['like', 'country.nicename', $this->nicename]);
        return $dataProvider;
    }
}
