<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper">
<h1><a href="index.html">CSC Portal</a></h1>
    <div class="login-body">
        <h2>Login</h2>
        <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                ],
    ]);
    ?>
             <?= $form->field($model, 'username', ['template' => "{input}\n{hint}\n{error}\n<span><i class='fa fa-envelope-o'></i></span>\n"])->textInput(array('placeholder' => 'Username')); ?>
               <?= $form->field($model, 'password', ['template' => "{input}\n{hint}\n{error}\n<span><i class='fa fa-key'></i></span>\n"])->passwordInput(array('placeholder' => 'password')); ?>
      
                <div class="submit">
                    <div class="remember">
                        <div class="checkbox checkbox-primary">
                             <?=
    $form->field($model, 'rememberMe', [
        'template' => "<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
    ])->checkbox()
    ?>
                        </div>
                        
                    </div>
                    <div class="login-block-btn">
                   <?= Html::submitInput('Login', ['class' => 'btn btn-primary form-control', 'name' => 'login-button']) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
            <!-- <div class="forget">
                <a href="#">
                    <span>Forgot password?</span>
                </a>
            </div> -->
               <?php ActiveForm::end(); ?>
                

    </div>
    </div>