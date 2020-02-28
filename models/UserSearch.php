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
    public $family_code;
    public $statue;
    public $date_membership;

    public function attributes()

    {

    // add related fields to searchable attributes

    return array_merge(parent::attributes(), ['name']);

    }

    public function rules()

    {

        return [

            [['id', 'status', 'created_at', 'updated_at','date_membership'], 'integer'],

            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'account_activation_token', 'email','user_code','status','name','nicename','family_code'], 'safe'],

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

        //$query->where(["user.usertype"=>"register"]);
        $query->joinWith(['familyProtection','profile']);
       // $query->joinWith(['familyProtection','familyProtectionMember']);

        //$query->joinWith(['userprofile']);

        //$query->joinWith(['country']);

        $dataProvider = new ActiveDataProvider([

            'query' => $query,
                'pagination' => [
                'pageSize' => 200,
                ],

            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]

        ]);

    $dataProvider->sort->attributes['name'] = [

       // 'asc' => ['user_profile.first_name' => SORT_ASC],

       // 'desc' => ['user_profile.first_name' => SORT_DESC],

    ];

    $dataProvider->sort->attributes['nicename'] = [

        'asc' => ['country.name' => SORT_ASC],

        'desc' => ['country.name' => SORT_DESC],

    ];

        if (!($this->load($params) && $this->validate())) {

            //return $dataProvider;

        }



        $query->andFilterWhere([

            'user.'.'id' => $this->id,

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


            ->andFilterWhere(['like', 'email', $this->email]);

            $query->andFilterWhere(['like', 'family_protection.id', $this->family_code])
                  ->andFilterWhere(['like', 'user_profile.date_of_birth', $this->date_membership]);

           // $query->andFilterWhere(['like', 'country.nicename', $this->nicename]);

        return $dataProvider;

    }

}

