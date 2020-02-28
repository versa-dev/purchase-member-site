<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeDirectory */

$this->title = 'Update Se Directory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Se Directories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="se-directory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
