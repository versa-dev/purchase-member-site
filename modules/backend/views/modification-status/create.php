<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModificationStatus */

$this->title = 'Create Modification Status';
$this->params['breadcrumbs'][] = ['label' => 'Modification Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
