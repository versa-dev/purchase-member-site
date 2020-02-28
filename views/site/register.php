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


    <div class="row login-page" id="login-box">
        <div class="col-md-12"  style="<?php if(!empty(yii::$app->user->id)){ echo "display: block"; }?>">
            <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>
            <div class="site-login">
                <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
                <div class="title-heading">
                    <div class="suv-divider-border-text text-center"><span class="divider-text ">Register</span><div class="border-line-login-bottom"></div></div>
                </div>
                <div class="row">
                     <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'first_name') ?>
                    </div>
                     <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'last_name') ?>
                    </div>

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
                     <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'country_id')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>
                    </div>
                   <div class="col-md-6 col-sm-6" id="state_select">
                        <?= $form->field($model, 'state')->dropDownList([],['prompt'=>'Select your state']) ?>
                    </div>
                    <div class="col-md-6 col-sm-6" style="display: none;" id="state_inbox">
                        <?= $form->field($model, 'states') ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'address') ?>
                    </div>

                    <!-- // deleted by JIN MINGHE 20191129
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'phone_no') ?>
                    </div>-->

                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'city') ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?= $form->field($model, 'post_code') ?>
                    </div>
                   <!--  <div class="col-lg-6">
                     <div class="form-group field-signupform-aggrement">
                    <div class="checkbox">
                    <label for="signupform-aggrement">
                     <?= $form->field($model, 'aggrement')->checkbox(['template' => '{input} {error}','label'=>false ,'class'=>'checkbox_aggerement']); ?>
                    <a href='<?= Yii::$app->urlManager->createAbsoluteUrl(['site/page', 'alias' => 'terms-and-conditions']); ?>' target='_blank'>I accept the terms and conditions</a>
                    </label>
                    </div>
                    </div>
                    </div> -->
                    <div  class="col-lg-6"><?= $form->field($model, 'date_of_birth'); ?></div>
                    <div  class="col-lg-6"><?= $form->field($model, 'aggrement')->checkbox(['label' => 'I accept the <a href="'.Yii::$app->urlManager->createUrl("site/terms-condition").'" target="_blank">Terms and Conditions</a>']);?></div>
                    <div class="col-md-12 col-sm-12">
                        <?= Html::submitButton('Save & Next', ['class' => 'btn btn-primary btn-uniform']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<style type="text/css">
.checkbox_aggerement{
    position: absolute;

margin-top: 4px \9;

margin-left: -120px !important;
}
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    var j = jQuery.noConflict();
    j(function() {
        j("#signupform-date_of_birth").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1920:' + '2025',
            dateFormat: 'yy-mm-dd'
        });

        $("#signupform-country_id").on('change', function() {
            var levels = $(this).val();
            if((levels == 38) || (levels == 226)){
                if(levels){
                       $.ajax ({
                        type: 'GET',
                        url: 'ajax-commissionss',
                        data: { country_id: '' + levels + ''},
                        success : function(htmlresponse) {

                            $("#state_select").css("display", "block");
                            $("#signupform-states").val("");
                            $("#state_inbox").css("display", "none");
                            $("#signupform-state").html(htmlresponse);
                           /*var obj = JSON.parse(htmlresponse);
                           $("#commission-name").html(obj.name);
                           $("#commission_id_store").css("display", "none");
                           $("#commission-name").css("display", "block");
                           $("#commission_id_assign").css("display", "block");  */
                        },error:function(e){
                        alert("error");}
                    });
                }
            }
            else{

                $("#state_select").css("display", "none");
               $("#state_inbox").css("display", "block");
            }
        });

  } );
  </script>
