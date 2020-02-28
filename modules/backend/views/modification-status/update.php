<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModificationStatus */

$this->title = 'Update Modification Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Modification Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="modification-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
