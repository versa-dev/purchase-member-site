<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SafePurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Safe Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safe-purchase-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  ///echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Safe Purchase', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'user_id',
                'label'=>'Username',
                'value'=>function($data){
                    $user=\app\models\User::find()->where(['id'=>$data->user_id])->one();
                    return $user->username;
                }
            ],
            [
                'attribute'=>'user_id',
                'label'=>'Email',
                'value'=>function($data){
                    $user=\app\models\User::find()->where(['id'=>$data->user_id])->one();
                    return $user->email;
                }
            ],
            [
                'attribute'=>'user_id',
                'label'=>'code',
                'value'=>function($data){
                    $user=\app\models\User::find()->where(['id'=>$data->user_id])->one();
                    return $user->user_code;//return the value of user_code
                }
            ],
            [
                'attribute'=>'user_id',
                'label'=>'Current_Balance',
                'format' => 'raw',
                'value' => function($model){
                    $name=\app\models\AccountStatement::find()->where(['user_id'=>$model->user_id])->one();
                    return $name['current_balance'];
                },
            ],
            'url:url',
            'total_amount',
            [
                'label'=>'View',
                'format' => 'html',
                'value' => function ($model, $key, $index) {
                return Html::a('<span class="glyphicon glyphicon-eye-open icon-oval"></span>', ['view', 'id' => $model->id],[
                'title' => Yii::t('yii', 'View'),
                ]);
                },
                'headerOptions' => ['style' => 'width:10%'],

            ],
            // 'description:ntext',
            // 'more_items',
            // 'created_at',
            // 'updated_at',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
