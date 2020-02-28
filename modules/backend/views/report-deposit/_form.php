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
    <?php if(isset($data)){
        for($i=0; $i<count($data);$i++){?>
            <?= $form->field($model, 'user_id')->textInput(['maxlength' => true,'value' => $data[$i+1]['in1']]) ?>
            <?= $form->field($model, 'amount')->textInput(['maxlength' => true,'value' => $data[$i+1]['in2']]) ?>
            <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true,'value' => $data[$i+1]['in3']]) ?>
            <?= $form->field($model, 'payment_date_time')->textInput(['maxlength' => true,'value' => $data[$i+1]['in4']]) ?>
            <?= $form->field($model, 'created_at')->textInput(['maxlength' => true,'value' => $data[$i+1]['in5']]) ?>
        <?php } }else{ ?>
            <?= $form->field($model, 'user_id')->dropDownList($users,['prompt'=>'Select User']) ?>

            <?= $form->field($model, 'amount')->textInput() ?>

            <?= $form->field($model, 'bank_name')->textInput() ?>

            <?= $form->field($model, 'payment_date_time')->textInput() ?>

            <?= $form->field($model, 'created_at')->textInput() ?>

            <?= $form->field($model, 'updated_at')->textInput() ?>
    <?php }?>
    <div class="form-inline">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Import csv file', ['report-deposit/importcsv'], ['class' => 'btn btn-primary btn-uniform']);?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var j = jQuery.noConflict();
    j( function() {
        j("#accountstatement-importfile").css('margin-top', '10px');
        j("#accountstatement-importfile").css('padding', '5px 10px');

    } );
</script>
