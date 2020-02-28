<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgentIdentificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agent-identification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'primary_identification_type') ?>

    <?= $form->field($model, 'primary_date_issued') ?>

    <?= $form->field($model, 'primary_date_expiry') ?>

    <?php // echo $form->field($model, 'primary_serial_number') ?>

    <?php // echo $form->field($model, 'primary_body_location') ?>

    <?php // echo $form->field($model, 'secondary_identification_type') ?>

    <?php // echo $form->field($model, 'secondary_date_issued') ?>

    <?php // echo $form->field($model, 'secondary_date_expiry') ?>

    <?php // echo $form->field($model, 'secondary_serial_number') ?>

    <?php // echo $form->field($model, 'secondary_body_location') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'date_issued') ?>

    <?php // echo $form->field($model, 'date_of_birth') ?>

    <?php // echo $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'body_location') ?>

    <?php // echo $form->field($model, 'witness_name') ?>

    <?php // echo $form->field($model, 'mother_firstname') ?>

    <?php // echo $form->field($model, 'mother_middlename') ?>

    <?php // echo $form->field($model, 'mother_lastname') ?>

    <?php // echo $form->field($model, 'mother_maidenname') ?>

    <?php // echo $form->field($model, 'mother_date_of_birth') ?>

    <?php // echo $form->field($model, 'mother_wetness_name') ?>

    <?php // echo $form->field($model, 'father_firstname') ?>

    <?php // echo $form->field($model, 'father_middlename') ?>

    <?php // echo $form->field($model, 'father_lastname') ?>

    <?php // echo $form->field($model, 'father_maidenname') ?>

    <?php // echo $form->field($model, 'father_date_of_birth') ?>

    <?php // echo $form->field($model, 'father_wetness_name') ?>

    <?php // echo $form->field($model, 'address_identification_type') ?>

    <?php // echo $form->field($model, 'address_date_issued') ?>

    <?php // echo $form->field($model, 'address_serial_number') ?>

    <?php // echo $form->field($model, 'address_issuing_body_name') ?>

    <?php // echo $form->field($model, 'address_street_address') ?>

    <?php // echo $form->field($model, 'address_phone_number') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
