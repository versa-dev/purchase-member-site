<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ad Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cat_id',
            'name',
            'description:ntext',
            'price',
            // 'address:ntext',
            // 'city',
            // 'state',
            // 'country',
            // 'post_code',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
