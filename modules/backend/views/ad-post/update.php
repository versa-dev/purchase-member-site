<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdPost */

$this->title = 'Update Ad Post: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ad Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
