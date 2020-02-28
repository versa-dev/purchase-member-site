<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Upload */

$this->title = 'Create Upload';
$this->params['breadcrumbs'][] = ['label' => 'Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
