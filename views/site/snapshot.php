<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Snapshot';
$this->params['breadcrumbs'][] = $this->title;


?>
 <style>
        /* HIDE RADIO */
        [type=radio] { 
          position: absolute;
          opacity: 0;
          width: 0;
          height: 0;
        }
        
        /* IMAGE STYLES */
        [type=radio] + img {
          cursor: pointer;
        }
        
        /* CHECKED STYLES */
        [type=radio]:checked + img {
          outline: 2px solid #f00;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <div class="row login-page" id="login-box">
        <div class="col-md-12"  >
           
            <div class="site-login">
                <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
                <div class="title-heading">
                    <div class="suv-divider-border-text text-center"><span class="divider-text ">Take Snapshot</span><div class="border-line-login-bottom"></div></div>
                </div>
                <div class="row">
                     <?php $form = ActiveForm::begin(); ?>
                    <div class="col-md-12 col-sm-12">
                         <div id="my_camera"></div>
                        <input type=button value="Take Snapshot" onClick="take_snapshot()" style="float: left;margin-top: 20px;">
                        <div class="col-md-12"  id="results" style="border: 1px solid #ccc;margin-top: 20px;"></div> 
                         
                     </div>
                       <div class="col-md-12" style="margin-top: 20px;">
                             <?= Html::submitButton('Save & Next', ['class' => 'btn btn-primary btn-uniform']) ?>
                      </div>
                     <?php ActiveForm::end(); ?>
                </div>
                
            </div>
           
        </div>
         
    </div>
     <script language="JavaScript">

        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100
        });
    
        Webcam.attach( '#my_camera' );
    
        function take_snapshot() {
            Webcam.snap( function(data_uri) {
                var today = new Date();
                $('#results').append('<label style="padding:10px;width:auto; float:left;"><input type="hidden" name="UserSnapshot[time][]" value="'+today+'"><input type="hidden" name="UserSnapshot[photo][]" value="'+data_uri+'"><input type="radio" name="UserSnapshot[image]" value="'+data_uri+'" checked><img style="width:100px;" src="'+data_uri+'" /></label>');
            } );
        }
    </script>

