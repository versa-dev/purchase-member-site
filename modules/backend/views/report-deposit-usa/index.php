<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportDepositUSASearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment in USA';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="Payment-Usa-index">

    <div class="form-inline">
        <h1><?= Html::encode($this->title) ?></h1>
        <p style="float: right">
            <?= Html::a('Create Payment account', ['create'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'user_id',
                'label'=>'User_ID',
                'value'=>function($data){
                    $user=\app\models\User::find()->where(['id'=>$data->user_id])->one();
                    return $user->id;
                }
            ],
            [
                'attribute'=>'user_id',
                'label'=>'User_Email',
                'value'=>function($data){
                    $user=\app\models\User::find()->where(['id'=>$data->user_id])->one();
                    return ($user->email);
                }
            ],
            'amount',
            'bank_name',
            'payment_date_time',
            'created_at',
            'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions' => ['style' => 'width:5%'],
            ]
        ],
    ]);
    ?>
</div>
