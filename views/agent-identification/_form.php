<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgentIdentification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row login-page" id="login-box">
    <div class="col-md-12" >
        <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>
            <div class="site-login">
                <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
                <div class="title-heading">
                    <div class="suv-divider-border-text text-center"><span class="divider-text ">IDENTIFICATION DOCUMENT and AGENT AFFIRMATION PAGE</span><div class="border-line-login-bottom"></div></div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-identy"> <h4>Primary Identification:</h4></div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'primary_identification_type')->dropDownList([ 'Drivers License' => 'Drivers License', ' Passport' => ' Passport', 'Other' => 'Other', ], ['prompt' => 'Choose Type']) ?>
                    </div>
                    <div class="col-md-12" id="primary_identification_other" style="display:none">
                        <?= $form->field($model,'primary_identification_other')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'primary_date_issued')->textInput(['class' => 'form-control datepic']) ?>
                        <div id="primary_date_issued_alert" style="color: #9c3328"></div>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'primary_date_expiry')->textInput(['class' => 'form-control datepic']) ?>
                        <div id="primary_date_expired_alert" style="color: #9c3328"></div>
                    </div>

                    <div class="col-md-12"> <?= $form->field($model, 'primary_serial_number')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-md-12"> <?= $form->field($model, 'primary_body_location')->textInput(['maxlength' => true]) ?></div>



                    <div class="col-md-12 text-identy"><h4>Secondary Identification:</h4></div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'secondary_identification_type')->dropDownList([ 'Drivers License' => 'Drivers License', ' Passport' => ' Passport','Birth Certificate' => 'Birth Certificate', 'Other' => 'Other', ], ['prompt' => 'Choose Type']) ?>
                    </div>
                    <div class="col-md-12" id="secondary_identification_other" style="display:none">
                        <?= $form->field($model,'secondary_identification_other')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-12" id="secondary_date_issued_div">
                        <?= $form->field($model, 'secondary_date_issued')->textInput(['class' => 'form-control datepic']) ?>
                        <div id="secondary_date_issued_alert" style="color: #9c3328"></div>
                    </div>

                    <div class="col-md-12" id="secondary_date_expire_div">
                        <?= $form->field($model, 'secondary_date_expiry')->textInput(['class' => 'form-control datepic']) ?>
                        <div id="secondary_date_expired_alert" style="color: #9c3328"></div>
                    </div>

                    <div class="col-md-12" id="secondary_serial_number_div">
                        <?= $form->field($model, 'secondary_serial_number')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-md-12" id="secondary_body_location_div">
                        <?= $form->field($model, 'secondary_body_location')->textInput(['maxlength' => true]) ?>
                    </div>


                    <div id="birth_cetificate_show" style="display:none;">
                        <div class="col-md-12 text-identy"><h4>For a Birth Certificate (Required for a Minor Member under 18 years of age):</h4></div>

                        <div class="col-md-12">  <?= $form->field($model, 'country_of_birth')->dropDownList($countries_list,['prompt'=>'Select country']) ?> </div>

                        <div class="col-md-12">  <?= $form->field($model, 'city_of_birth')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"> <?= $form->field($model, 'date_issued')->textInput(['class' => 'form-control datepic']) ?></div>

                        <div class="col-md-12"> <?= $form->field($model, 'date_of_birth')->textInput(['class' => 'form-control datepic']) ?></div>

                        <div class="col-md-12"> <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12">  <?= $form->field($model, 'body_location')->textInput(['maxlength' => true]) ?></div>

                        <!--<div class="col-md-12">  <?= $form->field($model, 'other')->textInput(['maxlength' => true]) ?></div>-->

                        <div class="col-md-12 text-identy"><h4>Mother's:</h4></div>

                        <div class="col-md-12"><?= $form->field($model, 'mother_firstname')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"><?= $form->field($model, 'mother_middlename')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"><?= $form->field($model, 'mother_lastname')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"><?= $form->field($model, 'mother_maidenname')->textInput(['maxlength' => true]) ?></div>


                        <div class="col-md-12 text-identy"><h4>Father's:</h4></div>
                        <div class="col-md-12"> <?= $form->field($model, 'father_firstname')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"><?= $form->field($model, 'father_middlename')->textInput(['maxlength' => true]) ?></div>

                        <div class="col-md-12"><?= $form->field($model, 'father_lastname')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="col-md-12 text-identy"><h4>Address Identification:</h4></div>
                    <div class="col-md-12">  <?= $form->field($model, 'address_identification_type')->dropDownList([ 'Utility Bill' => 'Utility Bill', 'Other Address ID' => 'Other Address ID', ], ['prompt' => 'Choose Type']) ?></div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'address_date_issued')->textInput(['class' => 'form-control datepic']) ?>
                        <div id="address_date_issued_alert" style="color: #9c3328"></div>
                    </div>

                    <div class="col-md-12">  <?= $form->field($model, 'address_serial_number')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-md-12"> <?= $form->field($model, 'address_issuing_body_name')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-md-12">  <?= $form->field($model, 'address_street_address')->textInput(['maxlength' => true]) ?></div>

                    <div class="col-md-12">  <?= $form->field($model, 'address_phone_number')->textInput(['maxlength' => true]) ?></div>

                    <!--<div class="col-md-12">  <?= $form->field($model, 'address_utility')->textInput(['maxlength' => true]) ?></div>-->

                    <!-- <div class="col-md-12">  <?= $form->field($model, 'name_of_issuing_body')->textInput(['maxlength' => true]) ?></div>
                    -->

                    <div class="col-md-12 text-identy"><h4>Agent Section:</h4></div>
                    <div class="col-md-12">   <?= $form->field($model, 'first_name_agent')->textInput(['class' => 'form-control']) ?></div>
                    <div class="col-md-12">   <?= $form->field($model, 'last_name_agent')->textInput(['class' => 'form-control']) ?></div>
                    <div class="col-md-12">   <?= $form->field($model, 'email_agent')->textInput(['class' => 'form-control']) ?></div>
                    <div class="col-md-12">  <?= $form->field($model, 'aggrement')->checkbox(['label' => 'I accept the <a href="'.Yii::$app->urlManager->createUrl("site/terms-condition").'" target="_blank">Terms and Conditions</a>']);?></div>


                    <div class="col-md-12">  <?= $form->field($model, 'decleration')->textarea(['class' => 'form-control','rows' => '4','style'=>'height:85px;']) ?></div>


                    <div class="col-md-12 col-sm-12">
                    <?= Html::submitButton('I AFFIRM', ['class' => 'btn btn-primary btn-uniform']) ?>
                    </div>
                </div>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<style type="text/css">
.text-identy{
text-align: left;
margin-top: 19px;
font-size: 18px;
font-weight: bold;
}
</style>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   var j = jQuery.noConflict();
  j( function() {
    j(".datepic").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:' + '2025',
        dateFormat: 'yy-mm-dd'
    });

    j('#agentidentification-primary_identification_type').on('change', function() {
         if(this.value=="Other"){
             j("#primary_identification_other").show();
         } else{
            j("#primary_identification_other").hide();
        }
    });

    j('#agentidentification-secondary_identification_type').on('change', function() {
        if(this.value=="Other"){
            j("#secondary_identification_other").show();
        } else {
            j("#secondary_identification_other").hide();
        }
    });


    j("#agentidentification-aggrement").click(function() {
        if (j(this).is(':checked')) {
            var first_name = $('#agentidentification-first_name_agent').val();
            var last_name = $('#agentidentification-last_name_agent').val();
            var msg= "  AFFIRM that the information on the Identification Document screens matches the information on the Identification Documents.";
            var final_msg= 'I '+ first_name +' ' + last_name +  msg;
            $("#agentidentification-decleration").val(final_msg);
        } else{
            $("#agentidentification-decleration").val("");
        }
    });

    j('#agentidentification-secondary_identification_type').on('change', function() {
        if(this.value=="Birth Certificate"){
            j("#birth_cetificate_show").show();
            // added by JIN MINGHE 2019/11/30
            j("#secondary_identification_other").hide();
            j("#secondary_date_issued_div").hide();
            j("#secondary_date_expire_div").hide();
            j("#secondary_serial_number_div").hide();
            j("#secondary_body_location_div").hide();
        }
        else{
           j("#birth_cetificate_show").hide();
            // added by JIN MINGHE 2019/11/30
            if(this.value=="Other") {
                j("#secondary_identification_other").show();
            } else {
                j("#secondary_identification_other").hide();
            }
            j("#secondary_date_issued_div").show();
            j("#secondary_date_expire_div").show();
            j("#secondary_serial_number_div").show();
            j("#secondary_body_location_div").show();
        }
    } );
  });


   j("#agentidentification-primary_identification_type").on('change', function() {
       var value = $(this).val();
       var sec_value = $("#agentidentification-secondary_identification_type").val();

       var html = "<option>Choose Type</option>";
       if (value != 'Drivers License') {
           html += "<option value='Drivers License'>Drivers License</option>";
       } else if (value == sec_value) {
           sec_value = "";
       }
       if (value != ' Passport') {
           html += "<option value=' Passport'> Passport</option>";
       } else if (value == sec_value) {
           sec_value = "";
       }
       html += "<option value='Birth Certificate'>Birth Certificate</option>";
       html += "<option value='Other'>Other</option>";

       $("#agentidentification-secondary_identification_type").html(html);
       if (sec_value != "")
        $("#agentidentification-secondary_identification_type").val(sec_value);
   });

   j("#agentidentification-primary_date_issued").on('change', function() {
       validateDate($("#agentidentification-primary_date_issued"), $("#agentidentification-primary_date_expiry"), $("#primary_date_issued_alert"), $("#primary_date_expired_alert"), true);
   });

   j("#agentidentification-primary_date_expiry").on('change', function() {
       validateDate($("#agentidentification-primary_date_issued"), $("#agentidentification-primary_date_expiry"), $("#primary_date_issued_alert"), $("#primary_date_expired_alert"), false);
   });

   j("#agentidentification-secondary_date_issued").on('change', function() {
       validateDate($("#agentidentification-secondary_date_issued"), $("#agentidentification-secondary_date_expiry"), $("#secondary_date_issued_alert"), $("#secondary_date_expired_alert"), true);
   });

   j("#agentidentification-secondary_date_expiry").on('change', function() {
       validateDate($("#agentidentification-secondary_date_issued"), $("#agentidentification-secondary_date_expiry"), $("#secondary_date_issued_alert"), $("#secondary_date_expired_alert"), false);
   });

   function validateDate(issue_date_obj, expired_date_obj, issue_alert_obj, expired_alert_obj, focus_issue_date) {
       var issue_date = issue_date_obj.val();
       if (expired_date_obj == null) {
           issue_alert_obj.html("");
           expired_alert_obj.html("");
           return;
       }
       var expired_date = expired_date_obj.val();
       if (focus_issue_date) {
           if (expired_date != "" && issue_date >= expired_date) {
               issue_alert_obj.html("The issued date should be before the expired date.");
               issue_date_obj.focus();
           } else {
               issue_alert_obj.html("");
               expired_alert_obj.html("");
           }
       } else {
           if (issue_date != "" && issue_date >= expired_date) {
               expired_alert_obj.html("The expired date should be after the issued date.");
               expired_date_obj.focus();
           } else {
               issue_alert_obj.html("");
               expired_alert_obj.html("");
           }
       }
   }

   // j("#agentidentification-address_date_issued").on('change', function() {
   //     var address_date_string = $(this).val();
   //     var alert_obj = $('#address_date_issued_alert');
   //     if (address_date_string.empty()) {
   //         alert_obj.html("")
   //         return;
   //     }
   //     var cur_date = new Date();
   //     var address_date = new Date(address_date_string);
   //
   //     const diffTime = Math.abs(cur_date - address_date);
   //     const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
   //
   //     if (diffDays < 30) {
   //         alert_obj.html("The address issued date should be one month before.")
   //     } else {
   //         alert_obj.html("");
   //     }
   // });

   document.getElementById('registration-form').onsubmit = function() {

       if ($("#primary_date_issued_alert").html() != "") {
           $("#agentidentification-primary_date_issued").focus();
           return false;
       }

       if ($("#secondary_date_issued_alert").html() != "") {
           $("#agentidentification-secondary_date_issued").focus();
           return false;
       }

       if ($("#primary_date_expired_alert").html() != "") {
           $("#agentidentification-primary_date_expired").focus();
           return false;
       }

       if ($("#secondary_date_expired_alert").html() != "") {
           $("#agentidentification-secondary_date_expired").focus();
           return false;
       }

       // if ($("#address_date_issued_alert").html() != "") {
       //     $("#agentidentification-address_date_issued").focus();
       //     return false;
       // }

       // You must return false to prevent the default form behavior
       return true;

   };

  </script>