<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MerchantSignup */

$this->title = 'Update Merchant Signup: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Merchant Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="merchant-signup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
