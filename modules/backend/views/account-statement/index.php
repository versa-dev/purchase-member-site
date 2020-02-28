<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountStatementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Statements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-statement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account Statement', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',            
            [
                'attribute'=>'user_id',
                'label'=>'User_ID',
                'value'=>function($data){
                    return $data->user->id;
                }
            ],
            [
                'attribute'=>'email',
                'label'=>'User_Email',
                'value'=>function($data){
                    return $data->user->email;
                }
            ],
            'date',
            'time',
            'balance_forward',
             'credit',
             'debit',
            'description:ntext',
             'detail_link',
             'current_balance',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions' => ['style' => 'width:5%'],
            ]
        ],
    ]); ?>
</div>
