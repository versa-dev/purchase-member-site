<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */
/* @var $form yii\widgets\ActiveForm */
$this->title='Report a Deposit at a WebPicID bank branch in The USA';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<section class="product-block">
     <div class="container">
<div class="safe-purchase-form">
<h2><strong><?php echo $this->title;?></strong></h2>
<br><br>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    
    
    <?php
echo $form->field($model, 'bank_name')->dropDownList(
            ['bank_of_america' => 'Bank of America', 'tdbank' => 'TDBank', 'wells_fargo' => 'Wells Fargo'],['prompt'=>'Select Bank']
    ); ?>

        <?= $form->field($model, 'payment_date_time')->textInput(['type'=>'date','value'=>'']) ?>
    <?= $form->field($model, 'payment_time')->textInput(['type'=>'time','value'=>'']) ?>
    <?= $form->field($model, 'amount')->textInput() ?>textInput(['type'=>'date','value'=>'']) ?>
    

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var j = jQuery.noConflict();
    j( function() {
        j("#reportdepositusa-payment_date_time").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1920:' + '2025',
            dateFormat: 'yy-mm-d'
        });
    } );
    j(document).ready(function () {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        var today_time= h + ":" + m;
        j('#reportdepositusa-payment_time').val(today_time);

        //document.getElementById("demo").innerHTML = d.toLocaleTimeString();

    });
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>