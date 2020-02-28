<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
$main_cat=array_reverse($cat);print_r($main_cat);
?>
<style>
.both h4{ font-family:Arial, Helvetica, sans-serif; margin:0px; font-size:14px;}
#search_category_id{ padding:3px; width:200px;}

.parent{ padding:3px; width:150px; float:left; margin-right:12px;}
.both{ float:left; margin:0 0px 0 0; padding:0px;}
</style>
<script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery.livequery.js"></script>
<script>
$(document).ready(function() {
    
    //$('#loader').hide();
    
    $('.parent').livequery('change', function() {
        //debugger
        $(this).nextAll('.parent').remove();
        $(this).nextAll('label').remove();
        
        $('#show_sub_categories').append('<img src="http://localhost/vuportal/web/images/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
        
        $.get("subcat", {
            id: $(this).val(),
        }, function(response){
            
            setTimeout("finishAjax('show_sub_categories', '"+escape(response)+"')", 400);
        });
        
        return false;
    });
});
function finishAjax(id, response){
  $('#loader').remove();

  $('#'+id).append(unescape(response));
} </script>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'user_id')->dropDownList($vendor,['prompt'=>'Select Vendor'])->label('vendor') ?>
    <div class="row">
   <div id="show_sub_categories">
   <select name='Product[category_id][]' class='form-control parent' required="">
       <option value='' selected='selected'>Please choose  category</option>
       <?php foreach ($cat_list as $key => $value) { ?>
        <option value="<?php echo $key ?>" <?php if($key==$main_cat[0]) echo "selected" ?>><?php echo $value ?></option>
       <?php } ?>
    </select>
   <?php foreach ($main_cat as $key => $value) { 
    if($value>0){
    $sub_cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$value])->all(), 'id', 'cat_name'); 
    $sub_id=ProductCategory::find()->where(['parent_id'=>$value])->one();
    }
    else{
      $sub_cat_list=array();
    }
    if(!empty($sub_cat_list)){?>
    
    <select name='Product[category_id][]' class='form-control parent' required="">
       <option value='' selected='selected'>Please choose  category</option>
       <?php foreach ($sub_cat_list as $keys => $values) {  ?>
        <option value="<?php echo $keys ?>" <?php if($keys==$sub_id['id']) echo "selected" ?>><?php echo $values ?></option>
        <?php }
       ?>
    </select>
     <?php }} ?>
  </div>
  </div>
  

    <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'se_directory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'search_word')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
/*jQuery( document ).ready(function() {
    $(".sub_class").change(function (){
      var id=$(this).val();
       // alert(id);
  //alert(user_email);
       
            $.ajax({
              url: "subcat",
              data : {'id':id},
              method: "GET",
              success: function (data) {
               // alert(data);
                //console.log(data);
               // var obj = jQuery.parseJSON(data);
               $("#sub_cat_id").html(data);
              }

            })
      
   });
});*/
    </script>
