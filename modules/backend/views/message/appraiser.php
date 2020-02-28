<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->title = "Contact Appraiser";
$form = ActiveForm::begin([
    'id' => 'compose-form'
]);
?>
    <div id="suggestion-box">
        <h1><?= $this->title ?></h1>
        <?= $form->errorSummary($model); ?>
        <div class="message-center clearfix">


            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="sel1">
                            To:
                        </label>
                        <?=
                            $form->field($model, 'to_user', [
                                'template' => '{input}{error}',
                            ])->dropDownList($appraisersList);
                        ?>
                    </div>
                </div>

            </div>

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
                            Message:
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
            <div>
                <div class="pull-left form-bt-mar-2">
                    <?= Html::submitButton('Send Message', ['class' => 'btn btn-primary']) ?>
                </div>
                <div class="pull-left form-bt-mar-2">
                    <?= Html::button('Cancel', ['class' => 'btn btn-default', 'onclick' => 'window.location.href="' . Yii::$app->urlManager->createAbsoluteUrl('site/appraiser') . '"']) ?>
                </div>
            </div>
        </div>
    </div>
<?php
ActiveForm::end();
