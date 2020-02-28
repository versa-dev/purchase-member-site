<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountStatement */

$this->title = 'Create Report Deposit';
$this->params['breadcrumbs'][] = ['label' => 'Payment account', 'url' => ['payusa']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Report-Deposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
