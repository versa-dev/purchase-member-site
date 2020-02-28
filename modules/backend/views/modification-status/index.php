<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModificationStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Modification Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Modification Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'modification_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
