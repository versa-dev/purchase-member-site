<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\AccountStatement */
/* @var $form yii\widgets\ActiveForm */
$users = ArrayHelper::map(app\models\User::find()->all(), 'id', 'username');
?>
<div class="account-statement-form">
    <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'user_id')->dropDownList($users,['prompt'=>'Select User']) ?>
                <?= $form->field($model, 'balance_forward')->textInput() ?>
                <?= $form->field($model, 'credit')->textInput() ?>
                <?= $form->field($model, 'debit')->textInput() ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'current_balance')->textInput(['maxlength' => true]) ?>
        <div class="form-inline">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
