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
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
            'template' => '{update}{view} {status}{delete}',
            'buttons' => [
                'status' =>  function ($url, $model) {
                    return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-ban-circle icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Unblock category'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to unblock this Category ?'),
                    ]) :
                    Html::a('<span class="glyphicon glyphicon-ok icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Block category'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to block this Category ?'),
                    ]);
                },

                /*'profile' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;
                },*/
                'update' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit category'),
                    ]) ;},
                    'view' =>  function ($url, $model) {
                    return  Html::a('<span class="fa fa-child icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'View Child category'),
                    ]) ;},
                    'delete' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-trash icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete category'),
                         'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this category ?'),
                    ]) ;
                },
            ],
        ]
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
