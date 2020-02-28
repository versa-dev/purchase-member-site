<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  <p>
        <?= Html::a('Create Member Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
            'attribute'=>'Name',
            'label'=>'Name',
            'format'=>'html',//raw, html
            'content'=>function($data){
              $first_name=  \app\models\UserProfile::find()->where(['user_id'=>$data['user_id']])->one();
             return $first_name['first_name'];
            }
            ],
            'member_service',
            'tax',
            'bank',
             'tracking_amount',
             'family_protection',
             'safe_purchase',
             [
            'attribute'=>'total_amount',
            'label'=>'Total Amount',
            'format'=>'html',//raw, html
            'content'=>function($data){
             return '$'.$data->total_amount;
            }
            ],
             'status',
             'created_date',
            // 'updated_date',
             [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{view}',
            'buttons' => [
                
                'view' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-eye-open icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;},
                  
            ],
        ]
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
