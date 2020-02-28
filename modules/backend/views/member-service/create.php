<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MemberService */

$this->title = 'Create Member Service';
$this->params['breadcrumbs'][] = ['label' => 'Member Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
