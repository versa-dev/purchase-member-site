<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */

$this->title = 'Create Safe Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Safe Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="safe-purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
