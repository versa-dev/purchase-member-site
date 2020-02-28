<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MerchantSignup */
/* @var $form yii\widgets\ActiveForm */
$countries_list = ArrayHelper::map(\app\models\Country::find()->all(), 'id', 'nicename');
?>

<div class="merchant-signup-form">
    <p>When entering time zone, enter EST MST PST then , Referring Member Frist Name Last Name Email Address</p>

    <?php $form = ActiveForm::begin(); ?>

   

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_type')->dropDownList([ 'ltd' => 'Ltd', 'proprietorship' => 'Proprietorship', ], ['prompt' => 'Select one of them']) ?>

    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'country')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>

      <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_zone_for_contact')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
