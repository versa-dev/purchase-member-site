<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MerchantSignupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Merchant Signups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-signup-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Merchant Signup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'user_id',
             [
            'attribute'=>'user_id',
            'label'=>'Username',
            'value'=>function($model){
                $user=\app\models\User::find()->where(['id'=>$model->user_id])->one();
                return $user->username;
            }
            ],
            'company_name',
            'company_type',
            'telephone',
            // 'street_address',
             'city',
           'state',
            [
            'attribute'=>'country',
            'label'=>'Country',
            'value'=>function($model){
                $user=\app\models\Country::find()->where(['id'=>$model->country])->one();
                return $user->nicename;
            }
            ],
            // 'country',
             'postal_code',
            // 'website_url:url',
             'first_name',
            'last_name',
            'job_title',
             'current_contact_number',
            // 'email_address:email',
            // 'time_zone_for_contact',
            // 'created_at',
            // 'updated_at',

          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
