<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MemberService */

$this->title = 'Update Member Service: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Member Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
