<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery.livequery.js"></script>
<script>
var j = jQuery.noConflict();
j(document).ready(function() {
    
    //$('#loader').hide();
    
    j('.parent').livequery('change', function() {
        //debugger
        j(this).nextAll('.parent').remove();
        j(this).nextAll('label').remove();
        
        j('#show_sub_categories').append('<img src="<?php echo Yii::$app->request->baseUrl; ?>/images/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
        
        j.get("<?php echo Yii::$app->urlManager->createUrl('product/subcat'); ?>", {
            id: j(this).val(),
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



    <?php $form = ActiveForm::begin(); ?>

   
     <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
    <div class="row">
     
      <div class="col-md-4 col-sm-4">
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-md-4 col-sm-4">
        <?= $form->field($model, 'item_code')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-md-4 col-sm-4">
        <?= $form->field($model, 'se_directory')->textInput(['maxlength' => true]) ?>
      </div>
    </div>

    <div class="row">
      
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>
      </div>
      
     
      <div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'modification_status')->textInput(['maxlength' => true]) ?>
      </div>
     
      
    </div>
   

    <div class="row">
      <div class="col-md-6 col-sm-6">
         <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
      </div>
      <div class="col-md-6 col-sm-6">
       <?= $form->field($model, 'product_category')->textarea(['rows' => 6]) ?>
      </div>
      
    </div>
     

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Next' : 'Next', ['class' => $model->isNewRecord ? 'btn btn-primary yellow-btn-box' : 'btn btn-primary']) ?>
         <?= Html::a('Cancel', ['/product'], ['class'=>'btn btn-danger red-btn-box']) ?>
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
/*jQuery( document ).ready(function() {
  $('#w0').submit(function() { alert("hello");
    document.getElementById("w0").submit();
    return false;
  });
});*/
   

    </script>
