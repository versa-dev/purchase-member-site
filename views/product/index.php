<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="product-index product-block">
<div class="product-box">

    <h2><i class="fa fa-archive" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h2>
    <div class="inner-bodyform">
    <div class="row">
    <div class="col-md-12">

    <div class="vendorbtn-box">
    <?= Html::a('Create Product', ['create'], ['class' => 'btn  yellow-btn-box']) ?>
    </div>
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery.livequery.js"></script>
<script>
var $j = jQuery.noConflict();
$j(document).ready(function() {
    
    //$j('#loader').hide();
    
    $j('.parent').livequery('change', function() {
        //debugger
        $j(this).nextAll('.parent').remove();
        $j(this).nextAll('label').remove();
        
        $j('#show_sub_categories').append('<img src="<?php echo Yii::$app->request->baseUrl; ?>/images/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
        
        $j.get("<?php echo Yii::$app->urlManager->createUrl('product/subcates'); ?>", {
            id: $j(this).val(),
        }, function(response){
            
            setTimeout("finishAjax('show_sub_categories', '"+escape(response)+"')", 400);
        });
        
        return false;
    });
});
function finishAjax(id, response){
  $j('#loader').remove();

  $j('#'+id).append(unescape(response));
} </script>
<div class="product-form">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    
<div class="row">
      
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
      </div>
    
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>
      </div>
</div>
<div class="row">
<div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'search_word')->textInput(['maxlength' => true]) ?>
      </div>
       <div class="col-md-6 col-sm-6">
         <?php  $htmloption=array('1'=>'Approved','0'=>'Unapproved');?>
            <?= $form->field($model, 'published')->dropDownList($htmloption,['prompt'=>'Select status','class'=>'form-control drop'])?>
        </div>
</div>
      
    </div>
<div class="form-group">
       <?= Html::submitButton('Search', ['class' => 'btn yellow-btn-box']) ?>
        <?= Html::a('Reset', ['/product/index'], ['class'=>'btn red-btn-box']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
    </div>



<table class="table table-striped table-bordered">
<thead>
<tr>
<th>#</th>
<th>Description_Sage</th>
<th>Item Code</th>
<th>Modified Date</th>
<th>Product Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php if(!empty($searchModel)){ $i=1; foreach ($searchModel as $key => $value) {?>
  

<tr data-key="17">
<td><?php echo $i; ?></td>
<td><?php echo $value['item_name']; ?></td>
<td><?php echo $value['item_code']; ?></td>
<td><?php echo date('Y-m-d',strtotime($value['modified_date'])); ?></td>

<td><?php if($value['published']==1){ echo "Approved"; } else{ echo 'Unapproved';}?></td>

  <td><a href="<?php echo Yii::$app->urlManager->createUrl(['/product/update','id'=>$value['id']]); ?>" title="Edit product"><span class="glyphicon glyphicon-pencil icon-oval"></span></a>

  <a href="<?php echo Yii::$app->urlManager->createUrl(['/product/view','id'=>$value['id']]); ?>" title="View product"><span class="fa fa-eye icon-oval"></span></a> 

  <a href="<?php echo Yii::$app->urlManager->createUrl(['/product/delete','id'=>$value['id']]); ?>" title="Delete product" data-confirm="Are you sure you want to delete this product ?"><span class="glyphicon glyphicon-trash icon-oval"></span></a>
  </td>

</tr>
<?php $i++; }} ?>
</tbody>
</table>
</div>
</div>

</div>
</div>

