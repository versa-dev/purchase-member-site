<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SeDirectory */

$this->title = 'Create Se Directory';
$this->params['breadcrumbs'][] = ['label' => 'Se Directories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="se-directory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
