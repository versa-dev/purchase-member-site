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
<div class="product-index admin-garph-block">
   <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>

   <div class="category-zx-section">

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
        
        $j('#show_sub_categories').append('<img src="<img src="<?php echo Yii::$app->request->baseUrl; ?>/images/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
        
        $j.get("subcates", {
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
        'action' => ['manager'],
        'method' => 'get',
    ]); ?>

    <div class="row">
    <div class="col-md-12 col-sm-12 form-group">
     <div id="show_sub_categories">
     <?php if(empty($sub_cat_list)){ ?>
      <select name='ProductCatSearch[category_id][]' class='form-control parent'>
         <option value='' selected='selected'>Please choose  category</option>
         <?php foreach ($cat_list as $key => $value) {
          echo "<option value=".$key.">".$value."</option>";
          }
         ?>
      </select>
      <?php } else{ ?>
     <?php foreach ($sub_cat_list as $key => $value) { 
          $sub_id=ProductCategory::find()->where(['id'=>$value])->one();
          
          $sub_cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$sub_id['parent_id']])->all(), 'id', 'cat_name');
          if(!empty($sub_cat_list)){?>
          
          <select name='ProductCatSearch[category_id][]' class='form-control parent'>
             <option value='' selected='selected'>Please choose  category</option>
             <?php foreach ($sub_cat_list as $keys => $values) {  ?>
              <option value="<?php echo $keys ?>" <?php if($keys==$value) echo "selected" ?>><?php echo $values ?></option>
              <?php }
             ?>
          </select>
           <?php }}} ?>
       
      </div>
    </div>
    </div>
<div class="row">
      
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
      </div>
    
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>
      </div>
      
    </div>
<div class="form-group">
       <?= Html::submitButton('Search', ['class' => 'btn yellow-btn-box']) ?>
        <?= Html::a('Reset', ['/product/manager'], ['class'=>'btn red-btn-box']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
<table class="table table-striped table-bordered"><thead>
<tr>
<th>#</th>
<th>category</th>
<th>item name</th>
<th>item code</th>
<th>action</th>
</tr>
<tbody>
<?php if(!empty($searchModel)){ $i=1; foreach ($searchModel as $key => $value) {?>
  

<tr data-key="17">
<td><?php echo $i; ?></td>
<td><?php echo $value['category']['cat_name']; ?></td>
<td><?php echo $value['product']['item_name']; ?></td>
<td><?php echo $value['product']['item_code']; ?></td>

  <td><!--<a href="<?php //echo Yii::$app->urlManager->createUrl(['/product/update','id'=>$value['product']['id']]); ?>" title="Edit product"><span class="glyphicon glyphicon-pencil icon-oval"></span></a>-->

  <a href="<?php echo Yii::$app->urlManager->createUrl(['/product/view','id'=>$value['product']['id']]); ?>" title="View Child product"><span class="fa fa-child icon-oval"></span></a> 

  <a href="javascript:void(0);" title="Unblock product"><span class="glyphicon glyphicon-ban-circle icon-oval"></span></a>

  <a href="<?php echo Yii::$app->urlManager->createUrl(['/product/delete','id'=>$value['product']['id']]); ?>" title="Delete product" data-confirm="Are you sure you want to delete this product ?"><span class="glyphicon glyphicon-trash icon-oval"></span></a>
  </td>

</tr>
<?php $i++; }} ?>
</tbody>
</table>
</div>
</div>
