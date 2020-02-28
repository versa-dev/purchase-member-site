<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
$this->title = "Suggestion";
?>


    <div class="white-wrapper">
          <div class="white-wrapper-inner">
    <h3>Need Your Suggestions! Tell us what you think </h3>
    <?php
    $form = \yii\widgets\ActiveForm::begin([
                'id' => 'suggesation-form',
                'fieldConfig' => ['template' => '{input}{error}'],
                'options' => ['class' => 'Suggestions_form']
    ]);
    ?>

    <input type="hidden" name="c" value="auctionhelper">
    <input type="hidden" name="task" value="suggesationbox">
    <input type="hidden" name="option" value="com_userregister">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="form-group">
                <label for="name">
                    Name:
                </label>
                <?= $form->field($model, 'name'); ?>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6">
            <div class="form-group">
                <label for="email">
                    Email Address:
                </label>
                <?= $form->field($model, 'email'); ?>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                        <label for="country_code">
                            Country Code:
                        </label>
                        <?= $form->field($model, 'country_code')->textInput(['maxlength' => 3]); ?>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <div class="form-group">
                        <label for="mobile">
                            Mobile Number:
                        </label>
                        <?= $form->field($model, 'mobile_number'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6">
            <div class="form-group">
                <label for="sel1">
                    Suggestion Regarding:
                </label>
                <?=
                $form->field($model, 'suggesation_regarding')->dropDownList([
                    'Improve the Design of website' => 'Improve the Design of website',
                    'Improve the Design of website' => 'Improve the Design of website',
                    'Suggest new features/ideas' => 'Suggest new features/ideas',
                    'Bidding Experience' => 'Bidding Experience',
                    'Others- General Suggestion' => 'Others- General Suggestion'
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
                <?= $form->field($model, 'comments')->textarea(); ?>
            </div>
        </div>
    </div>

    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']); ?>
    <?php \yii\widgets\ActiveForm::end(); ?>


</div>
</div>

<?php
$js = 'jQuery("#suggesation-country_code").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                jQuery(this).addClass("invalid");
                return false;
            } else {
                jQuery(this).removeClass("invalid");
            }
        });';
$this->registerJs($js);
