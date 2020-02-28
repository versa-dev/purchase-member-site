<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SearchTermCategory;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
$this->title = 'Product import';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index product-block admin-garph-block"">
    <div class="product-box">
        <h1><i class="fa fa-archive" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
         
        <div class="inner-bodyform category-zx-section">
        <div class="vendorbtn-box">
        <?= Html::a('Import demo file', ['/csv/demo.csv'], ['class' => 'btn  yellow-btn-box']);  ?>
        </div> 
        <div class="restaurant-view">
           <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">
            <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'user_id')->dropDownList($user,['prompt'=>'Select Vendor'])->label('Vendor') ?>
            </div>
            <div class="col-md-6 col-sm-6">
             <?= $form->field($model, 'importfile')->fileInput(['maxlength' => true]) ?>
            </div>
            </div>
            <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Upload' : 'Upload', ['class' => $model->isNewRecord ? 'btn btn-primary yellow-btn-box' : 'btn btn-primary']) ?>
            <?= Html::a('Cancel', ['/backend/product'], ['class'=>'btn btn-danger red-btn-box']) ?>
            </div>

         <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>




<!-- <section class="content">
    
</section> -->