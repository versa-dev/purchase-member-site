<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title = 'Change Password';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index admin-garph-block">
<h1><i class="fa fa-bars" aria-hidden="true"></i> <?php echo Html::encode($this->title) ?></h1>
<div class="registration-form clearfix category-zx-section">
    <?php $form = ActiveForm::begin(['id' => 'changepassword-form']); ?>
   
  
<div class="row">
<div class="changepassword-section">
    <div class="clearfix">

       <div class="col-md-12 col-sm-12">
            <?= $form->field($model, 'old_password')->passwordInput(); ?>
        </div>
        
    </div>

</div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-6 appraiser">
        <?= $form->field($model, 'password',[
            'inputOptions'=>[
                'placeholder'=>'Password must be between 5 to 8 character'
            ]
        ])->passwordInput(); ?>
    </div>
    
    <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'verifyPassword')->passwordInput(); ?>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-sm-12">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-success btn-uniform yellow-btn-box']) ?>
    </div>
</div>

</div>

