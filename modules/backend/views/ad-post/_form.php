<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_cat_id')->dropDownList($cat_list,['prompt'=>'Select your cat']) ?>
    <?= $form->field($model, 'sub_cat_id')->dropDownList([],['prompt'=>'Select your cat']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'country')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>

    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
jQuery( document ).ready(function() {
    $("#adpost-parent_cat_id").change(function (){
      var id=$(this).val();
        alert(id);
  //alert(user_email);
       
            $.ajax({
              url: "subcat",
              data : {'id':id},
              method: "GET",
              success: function (data) {
                //alert(data);
                //console.log(data);
                var obj = jQuery.parseJSON(data);
               $("#help-block-error").html(obj);
              }

            })
      
   });
});
    </script>
