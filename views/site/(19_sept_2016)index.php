<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
//echo $this->render('_slider',['data'=>$data]);
$this->title = 'Vuportal';
?>

  <!-- inner-container-box-start -->
      <div class="row login-page" id="login-box">
        <div class="col-md-3"></div>
        <div class="col-md-6"  style="<?php if(!empty(yii::$app->user->id)){ echo "display: none"; }?>">
          <div class="ribbon"></div>
          <div class="site-login">
            <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
            <div class="title-heading">
              <div class="suv-divider-border-text text-center"><span class="divider-text ">Login</span></div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
            <div class="remember-box">
              <div class="row">
                <div class="col-md-6 col-sm-12 text-left">
                  <div class="form-group field-loginform-rememberme">
                    <div class="checkbox">
                      <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-sm-12 forgot-pass">
                  <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/request-password-reset']); ?>">Forgot Password</a>
                </div>
              </div>
            </div>
            <div class="form-group text-center">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>
        <div class="col-md-3"></div>
  </div><!-- inner-container-box-End -->