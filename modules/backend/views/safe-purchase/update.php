<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */

$this->title = 'Update Safe Purchase: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Safe Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="safe-purchase-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
