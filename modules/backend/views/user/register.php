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



<div class="admin-garph-block">
    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?php echo $this->title; ?></h1>

    <div class="category-zx-section">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'usertype')->hiddenInput(['value'=>'Vendor'])->label(false); ?>
         <div class="row">
          <div class="col-md-12 col-sm-12">
                <?= $form->field($model, 'company_name') ?>
           </div>     
           
        </div>
        <div class="row">
          <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'first_name') ?>
           </div>     
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'last_name') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'username',[
                'inputOptions'=>[
                'placeholder'=>'Username must be between 5 to 15 character'
                ]
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'password',[
                'inputOptions'=>[
                'placeholder'=>'Password must be between 5 to 8 character'
                ]
                ])->passwordInput(); ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <?= $form->field($model, 'verifyPassword')->passwordInput(); ?>
            </div>
        </div>

        <div class="row">
        <div class="col-md-6 col-sm-6">
                
                <?= $form->field($model, 'phone_no') ?>
            </div>
         <div class="col-md-6 col-sm-6">
             <?= $form->field($model, 'city') ?>
         </div>   
        </div>

        <div class="row">
             <div class="col-md-12 col-sm-12"><?= $form->field($model, 'address')->textArea(['rows' => '6']) ?></div>
        </div>

        <div class="row">
             <div class="col-md-6 col-sm-6">
                 <?= $form->field($model, 'state') ?>
             </div>
             <div class="col-md-6 col-sm-6">
                 <?= $form->field($model, 'country_id')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>
             </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <?= Html::submitButton('Register', ['class' => 'btn yellow-btn-box']) ?>
                <?= Html::a('Cancel', ['index'], ['class' => 'btn   red-btn-box']) ?>
            </div>
        </div>


      <?php ActiveForm::end(); ?>
    </div>

</div>    
