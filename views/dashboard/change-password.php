<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-md-12">
    <div class="product-block">
      <div class="registration-form product-box clearfix">
        <!--  <div class="col-md-6 col-sm-6">
          <h1>Change Password</h1>
        </div> -->
        <div class="view_detail">
          <h2><i aria-hidden="true" class="fa fa-bars"></i> Change Password</h2>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'changepassword-form']); ?>
        <?php
        $show_apprasier_option = false;
        if($model->buyer_appraiser == 2){
        $show_apprasier_option = true;
        }
        ?>
        <!--  <div class="col-md-6 col-sm-6">
          <div class="user-role">
            <label>User Role:</label>
            <?//= HTML::activeradioList($model, 'buyer_appraiser',['1' => 'Buyer/Seller', '2' => 'Appraiser'],['class'=>'checkbox-inline user-role']); ?>
          </div>
        </div>
      </div> -->
      <div class="nor-space"></div>
      <div class="row-fluid">
        <div class="changepassword-section">
          <div class="clearfix">
            <div class="col-md-12 col-sm-12 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'areaOfExperties')->listBox(['1'=>'Action Figure','2'=>'Coins','3'=>'Collectables']); ?>
            </div>
            <div class="col-md-6 col-sm-6 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'companyName') ?>
            </div>
            <div class="col-md-6 col-sm-6 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'website') ?>
            </div>
            <div class="col-md-6 col-sm-6 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'contactPerson') ?>
            </div>
            <div class="col-md-6 col-sm-6 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'buisnessPhoneNumber') ?>
            </div>
            <div class="ol-md-12 col-sm-12 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'companyAddress')->textarea(); ?>
            </div>
            <div class="ol-md-12 col-sm-12 appraiser" <?php if(!$show_apprasier_option) echo 'style="display:none;"' ?>>
              <?= $form->field($model, 'comments')->textarea(); ?>
            </div>
            <div class="col-md-6 col-sm-6">
              <?= $form->field($model, 'old_password')->passwordInput(); ?>
            </div>
            <div class="col-md-6 col-sm-6 appraiser">
              <?= $form->field($model, 'password',[
              'inputOptions'=>[
              'placeholder'=>'Password must be between 5 to 8 character'
              ]
              ])->passwordInput(); ?>
            </div>
            <div class="col-md-6 col-sm-6">
              <?= $form->field($model, 'verifyPassword')->passwordInput(); ?>
            </div>
            
            
            <div class="col-md-12 col-sm-12">
              <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="nor-space"></div>
    </div>
  </div>
</div>