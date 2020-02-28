<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$pid=Yii::$app->getRequest()->getQueryParam('id');
if(empty($pid)){ $heading='Add Category';}else{ $heading='Update Category';}
$this->title= $heading;
$form = ActiveForm::begin([
            'id' => 'category-form',
            'options' => ['class' => 'form-vertical'],
        ])
?>


<div class="admin-garph-block">
<h1><i class="fa fa-bars" aria-hidden="true"></i> <?php echo Html::encode($this->title) ?></h1>

<div class="category-zx-section">

<div class="row">
	<div class="col-md-6 col-sm-6">
		<?= $form->field($model, 'cat_name'); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6 col-sm-6">
		<?= $form->field($model, 'description')->textarea(['class' => 'form-control']); ?>
	</div>
	
</div>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<?= $form->field($model, 'published')->dropDownList(['1' => 'Yes', '0' => 'No']); ?>
	</div>
</div>









<div class="form-group">
    <div class="">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary yellow-btn-box']) ?>
  
    <?= Html::a('Cancel', ['/backend/category/manager'], ['class'=>'btn btn-danger red-btn-box']) ?>
    </div>
    
</div>
</div>
</div>
<?php ActiveForm::end() ?>
