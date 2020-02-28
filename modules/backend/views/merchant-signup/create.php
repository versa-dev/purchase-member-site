<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MerchantSignup */

$this->title = 'Create Merchant Signup';
$this->params['breadcrumbs'][] = ['label' => 'Merchant Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-signup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
