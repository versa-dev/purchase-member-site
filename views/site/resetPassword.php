<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- inner-container-box-start -->
      <div class="row login-page" id="login-box">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="ribbon"></div>
          <div class="site-login">
            <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
            <div class="title-heading">
              <div class="suv-divider-border-text text-center"><span class="divider-text "><?php echo $this->title; ?></span> <div class="border-line-login-bottom"></div></div>
            </div>
           <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
           <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter new password'])->label(false) ?>
            <div class="form-group text-center">
              <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
              <?= Html::a('Cancel', ['/site'], ['class'=>'btn btn-danger red-btn-box red-cancel-btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
        <div class="col-md-3"></div>
  </div><!-- inner-container-box-End -->
