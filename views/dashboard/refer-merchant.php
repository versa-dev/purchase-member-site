<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */
/* @var $form yii\widgets\ActiveForm */
$this->title='Refer a Merchant';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<section class="product-block">
     <div class="container">
<div class="safe-purchase-form">
<h2><strong><?php echo $this->title;?></strong></h2>
<br><br>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

   
   
    <?= $form->field($model, 'organization_name')->textInput() ?> 
    <?= $form->field($model, 'organization_website')->textInput() ?> 
    <?= $form->field($model, 'name_of_contact')->textInput() ?> 
    <?= $form->field($model, 'position')->textInput() ?> 
    <?= $form->field($model, 'email')->textInput() ?> 
    <?= $form->field($model, 'contact')->textInput() ?> 

    <?= $form->field($model, 'extension')->textInput() ?>
    

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</section>