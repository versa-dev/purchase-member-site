<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
            'id' => 'category-form',
            'options' => ['class' => 'form-vertical'],
        ])
?>
<h1>Add Category</h1>
<?= $form->field($model, 'cat_name'); ?>
<?= $form->field($model, 'alias'); ?>



<?= $form->field($model, 'description')->textarea(['class' => 'form-control']); ?>
<?= $form->field($model, 'published')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>

<div class="form-group">
    <div class="">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
  
    <?= Html::a('Cancel', ['/backend/category/manager'], ['class'=>'btn btn-danger']) ?>
    </div>
    
</div>
<?php ActiveForm::end() ?>
