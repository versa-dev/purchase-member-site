<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ReportDepositCanada */
/* @var $form yii\widgets\ActiveForm */
$users = ArrayHelper::map(app\models\User::find()->all(), 'id', 'email');
?>

<div class="payment-canada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList($users,['prompt'=>'Select User']) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'question_answer')->textInput() ?>

    <?= $form->field($model, 'payment_date_time')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
