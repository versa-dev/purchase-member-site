<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */
/* @var $form yii\widgets\ActiveForm */
?>




	
<div class="report-payment-form">

    <?php $form = ActiveForm::begin(); ?>



    

    <?= $form->field($model, 'bank')->textInput() ?>
    
    <?= $form->field($model, 'date')->textInput() ?>


    <?= $form->field($model, 'time')->textInput() ?>
    <?= $form->field($model, 'amount')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   var k = jQuery.noConflict();
  k( function() {
    k("#reportpayment-date").datepicker({
            changeMonth: true,
            changeYear: true,
           yearRange: '1920:' + '2025',
           dateFormat: 'yy-mm-d'
        });
  });
  </script>
