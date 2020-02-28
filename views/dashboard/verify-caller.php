<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Verify Caller';
//$this->params['breadcrumbs'][] = $this->title;


?>


<div class="row login-page" id="login-box">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['id' => 'verify-caller-form']); ?>
        <div class="site-login">
            <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
            <div class="title-heading">
                <div class="suv-divider-border-text text-center"><span class="divider-text ">Verify Caller</span><div class="border-line-login-bottom"></div></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 's_first_name') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 's_last_name') ?>
                </div>

                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 's_phone_number') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 's_extension') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 's_email')?>
                </div>
            </div>
            <div class="title-heading">
                <div class="suv-divider-border-text text-center"><span class="divider-text ">Organization</span><div class="border-line-login-bottom"></div></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'org_name') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'org_address') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'org_city') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'country')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>
                </div>
                <div class="col-md-6 col-sm-6" id="state_select">
                    <?= $form->field($model, 'state_province')->dropDownList([],['prompt'=>'Select your state province']) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'zip_postal_code') ?>
                </div>
            </div>
            <div class="title-heading">
                <div class="suv-divider-border-text text-center"><span class="divider-text ">Recipient</span><div class="border-line-login-bottom"></div></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'r_first_name') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'r_last_name') ?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'r_email_address')?>
                </div>
                <div class="col-md-6 col-sm-6">
                    <?= $form->field($model, 'r_phone_number')?>
                </div>
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

        $("#verifycaller-country").on('change', function() {
            var levels = $(this).val();
            if((levels == 38) || (levels == 226)){
                if(levels){
                    $.ajax ({
                        type: 'GET',
                        url: 'ajax-commissionss',
                        data: { country_id: '' + levels + ''},
                        success : function(htmlresponse) {

                            $("#state_select").css("display", "block");
                            // $("#verifycaller-states").val("");
                            // $("#state_inbox").css("display", "none");
                            $("#verifycaller-state_province").html(htmlresponse);
                        },error:function(e){
                            alert("error");}
                    });
                }
            }
            else{
                $("#state_select").css("display", "none");
            }
        });

    } );
</script>
