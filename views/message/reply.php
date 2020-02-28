<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/message-index.js', ['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);


$this->title = "Reply";
$form = ActiveForm::begin([
            'id' => 'compose-form'
        ]);
echo $form->field($model, 'parent_id', ['template' => '{input}'])->hiddenInput();
?>

     <div class="white-wrapper">
     <div class="white-wrapper-inner ">
        <?= $form->errorSummary($model); ?>
        <div class="message-center clearfix">


            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="sel1">
                            Subject:
                        </label>
                        <?=
                        $form->field($model, 'subject', [
                            'template' => '{input}{error}',
                        ]);
                        ?>
                    </div>
                </div>

            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="comment">
                            Comments:
                        </label>
                        <?=
                        $form->field($model, 'message', [
                            'template' => '{input}{error}',
                        ])->textarea();
                        ?>
                    </div>
                </div>
            </div>
            <br>

            <div class="form-group">
            
                    
                        <?= Html::submitButton('Send Message', ['class' => 'btn btn-primary']) ?>
                
                   
                        <?= Html::button('Cancel', ['class' => 'btn btn-default', 'onclick' => 'window.location.href="' . Yii::$app->urlManager->createAbsoluteUrl('/message') . '"']) ?>

                   
          
            </div>



        </div>

    </div>
</div>
<?php
ActiveForm::end();
