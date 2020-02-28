<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="registration-form clearfix bg-center">
    <h1>Register</h1>
   <?php $form = ActiveForm::begin(); ?>
   
  

<div class="register-bg">
    <div class="clearfix">

        

        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'country_id')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>
        </div>
         
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'name') ?>
        </div>

        

        <!-- <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'email') ?>
        </div> -->
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'username',[
                'inputOptions'=>[
                    'placeholder'=>'Username must be between 5 to 15 character'
                ]
            ]) ?>
        </div>

                 
       <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'supplier_id')->dropDownList($supplier_list,['prompt'=>'Select your supplier']) ?>
       </div>
        <div class="col-md-6 col-sm-6">
        <?php  $htmloption=array('Corporate annual  Scope list'=>'Corporate annual Scope list','Corporate Health check report'=>'Corporate Health check report');?>
            <?= $form->field($model, 'service_type')->dropDownList($htmloption,['prompt'=>'Select Service type','multiple' => 'true']) ?>
        </div>
        <div class="col-md-6 col-sm-6">
         <?php  $htmloption=array('Parent'=>'Group','Child'=>'Entity');?>
            <?= $form->field($model, 'client_type')->dropDownList($htmloption,['prompt'=>'Select Service type','class'=>'form-control drop']) ?>
        </div>
        <div class="col-md-6 col-sm-6"  id="client_hide" style="display:<?php if($model->client_type='Child') echo 'block'; else echo 'none'; ?>;">
            <?=  $form->field($model, 'parent_id')->dropDownList($client_list,['prompt'=>'Select your client']) ?>
       </div>
        <input type="hidden" value="Client" name="SignupForm[usertype]" class="form-control" id="signupform-usertype">
        
        <div class="col-md-6 col-sm-6">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
               <?= Html::a('cancel', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
<?php
$script = <<< JS
 $(".drop").change(function(){
    client_val= $('.drop').val();
   if(client_val=='Child'){
     $('#client_hide').show();
   }
   else{
     $('#client_hide').hide();
   }


});

JS;

$this->registerJs($script);
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/product.js', ['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>
