<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'item_code',
            'item_name',
            'description:ntext',
            // 'se_directory',
            // 'search_word:ntext',
            // 'status',
            // 'modification_status',
            // 'deleted',
            // 'created_date',
            // 'modified_date',
             [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{view} {status}{delete}',
            'buttons' => [
                'status' =>  function ($url, $model) {
                    return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-ban-circle icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Unblock product'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to unblock this product ?'),
                    ]) :
                    Html::a('<span class="glyphicon glyphicon-ok icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Block product'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to block this Category ?'),
                    ]);
                },

                /*'profile' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;
                },*/
                
                    'view' =>  function ($url, $model) {
                    return  Html::a('<span class="fa fa-child icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'View Child product'),
                    ]) ;},
                    'delete' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-trash icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete product'),
                         'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this product ?'),
                    ]) ;
                },
            ],
        ]
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
