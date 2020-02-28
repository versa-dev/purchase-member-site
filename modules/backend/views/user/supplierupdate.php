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
      <?= $form->field($model, 'usertype')->hiddenInput(['value'=>'Supplier']); ?>
</div>
       
        
        <div class="col-md-6 col-sm-6">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
               <?= Html::a('cancel', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>

