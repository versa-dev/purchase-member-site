<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MemberServiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-service-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'member_service') ?>

    <?= $form->field($model, 'tax') ?>

    <?= $form->field($model, 'bank') ?>

    <?php // echo $form->field($model, 'tracking_amount') ?>

    <?php // echo $form->field($model, 'family_protection') ?>

    <?php // echo $form->field($model, 'safe_purchase') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
