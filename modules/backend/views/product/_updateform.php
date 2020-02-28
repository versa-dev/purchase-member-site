<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
//$main_cat=array_reverse($cat);//print_r($main_cat);
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
<div>
    <ol class="cd-breadcrumb triangle">
      <li class="current"><span>1 Step</span></li>
      <li><a href="#0">2 Step</a></li>
    </ol>
</div>

    <?php $form = ActiveForm::begin(); ?>

      
<?= $form->field($model, 'user_id')->dropDownList($vendor,['prompt'=>'Select Vendor'])->label('vendor') ?>
    <div class="row">
      
       <div class="col-md-6 col-sm-6">
         <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>
       </div>
        <div class="col-md-6 col-sm-6">
         <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
       </div>
       
    </div>

   <div class="row">
      <div class="col-md-12 col-sm-12">
        <?= $form->field($model, 'se_directory')->dropDownList($se_directory, ['prompt' => 'choose se_directory']) ?>
      </div>
    </div>



    <div class="row">
      
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'status')->dropDownList($status, ['prompt' => 'choose status']) ?>
      </div>
      
     
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'modification_status')->dropDownList($modification_status, ['prompt' => 'choose modification_status']) ?>
      </div>
     
      
    </div>

    <div class="row">
   <!--  <div class="col-md-6 col-sm-6">
      <?php //echo  $form->field($model, 'product_category')->textarea(['rows' => 6]) ?>
     </div> -->
       <div class="col-md-12 col-sm-12">
         <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
       </div>
      <div class="col-md-12 col-sm-12">
      <?php $published=['1'=>'Approved','0'=>'Unapproved'];
      echo  $form->field($model, 'published')->dropDownList($published)->label('Product Status'); ?>
         
       </div>
       
       
    </div>
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Next' : 'Next', ['class' => $model->isNewRecord ? 'btn btn-primary yellow-btn-box' : 'btn btn-primary yellow-btn-box']) ?>
        <?= Html::a('Cancel', ['/backend/product'], ['class'=>'btn btn-danger red-btn-box']) ?>
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
