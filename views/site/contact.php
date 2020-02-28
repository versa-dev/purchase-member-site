<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\ContactForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(yii\helpers\BaseUrl::base() . '/css/message.css');
?>
<div class="row">
        <div id="suggestion-box">
        <div class="view_detail">
            <h1><span>Contact Us </span></h1>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'contact-form',
                                'fieldConfig' => ['template' => '{input}{error}'],
                                'options' => ['class' => 'Suggestions_form']
                    ]);
                    ?>
                    <form role="form" action="" method="post" name="adminForm" id="adminForm" class="Suggestions_form">
                        <input type="hidden" name="c" value="auctionhelper">
                        <input type="hidden" name="task" value="suggesationbox">
                        <input type="hidden" name="option" value="com_userregister">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">
                                        Name:
                                    </label>
                                    <?= $form->field($model, 'name') ?>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">
                                        Email:
                                    </label>
                                    <?= $form->field($model, 'email') ?>
                                </div>
                            </div>

                        </div>



                        <div class="row">


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="sel1">
                                        Subject:
                                    </label>
                                    <?= $form->field($model, 'subject') ?>
                                </div>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="comment">
                                        Comments:
                                    </label>
                                    <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?=
                        $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())
                        ?>
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-uniform', 'name' => 'contact-button']) ?>

                    <?php ActiveForm::end(); ?>
                </div>


                <div class="col-lg-4 col-md-offset-2">

                    <h2>Address</h2>

                    <h3>Hunter Investor</h3>

                    <p>Unit 1 / 8-10 Lindaway Place,<br>

                        Tullamarine, VIC 3043<br>

                        Australia</p>

                    <p>Email:<a target="_blank" href="mailto:admin@hunterinvestor.com"> admin@hunterinvestor.com</a></p>

                    <p>Website: http://www.hunterinvestor.com</p>

                </div>

            </div>

        </div>


