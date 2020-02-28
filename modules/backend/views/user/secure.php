<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Secure Login';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index admin-garph-block">

    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="category-zx-section">   
<div class="vendorbtn-box">
    <div style="float: left;"><p>
        <?php //echo Html::a('Create Vendor', ['register'], ['class' => 'btn  yellow-btn-box']) ?>
       
    </p>
    </div>
   
    <div style="clear:both;"></div>
</div>




 <div class="col-md-6">
          <div class="ribbon"></div>
          <div class="site-login">
            <!-- <div class="blue-iocn"><a href="#"><i class="fa fa-lock"></i></a></div> -->
            <!-- <div class="title-heading">
              <div class="suv-divider-border-text text-center"><span class="divider-text ">Login</span><div class="border-line-login-bottom"></div></div>
            </div> -->
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['placeholder'=>'Username'])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
            
            <div class="form-group text-center">
              <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div>
        </div>

</div>
</div>


