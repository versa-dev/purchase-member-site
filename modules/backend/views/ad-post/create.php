<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdPost */

$this->title = 'Create Ad Post';
$this->params['breadcrumbs'][] = ['label' => 'Ad Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countries_list'=> $countries_list,
        'cat_list' => $cat_list,
    ]) ?>

</div>
