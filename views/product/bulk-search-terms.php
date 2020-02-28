<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
  .product-box select.form-control.itm_khicho {
    border-radius: 0;
    height: 200px;
}
</style>
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.css">
<script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery.livequery.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>

<script>
var j = jQuery.noConflict();
j(document).ready(function() {
   j(".chosen").chosen(); 
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


<div class="product-block">
      <div class="product-box">
         <h2><i class="fa fa-pencil" aria-hidden="true"></i> Bulk Search Terms</h2>
         
         <div class="process-step"> 
         <div class="clearfix">
          <div class="col-md-12">
           
             </div>
         </div>
         </div>
         

         <div class="clearfix">
         <!-- <div class="col-md-4 col-sm-4">
         </div>
         <div class="col-md-8 col-sm-8">
         
          <form id="search_word_id">
          <div class="row">
            
             <div class="col-md-8 col-sm-8">
             <div class="form-group">
               <input type="text" name="Item id" value="" class="form-control" placeholder="Enter Item id" id="word_id">
               </div>
             </div>
             <div class="col-md-4 col-sm-4">
             <div class="form-group">
               <input type="submit" name="" class="btn yellow-btn-box" value="Search">
               </div>
             </div>
          </div>
            
            
          </form>
         
         </div> -->
 <?php $form = ActiveForm::begin([]); ?>
            
           <div class="col-md-4 col-sm-4 select-box-category">
            <div id="show_sub_categories">
              <select name='Product[category_id][]' class='form-control parent'>
                 <option value='' selected='selected'>Please choose  category</option>
                 <?php foreach ($cat_list as $key => $value) {
                  echo "<option value=".$key.">".$value."</option>";
                  }
                 ?>
              </select>
              </div>
              
           </div>
           <div class="col-md-8 col-sm-8">
            
            <?= $form->field($model, 'product_id')->dropDownList($product_list,['multiple' => 'multiple','class'=>'form-control itm_khicho chosen'])->label(false) ?>
           </div>
           <div class="form-group">
                 <?= Html::submitButton($model->isNewRecord ? 'Create Search Terms' : 'Create Search Terms', ['class' => $model->isNewRecord ? 'btn yellow-btn-box' : 'btn yellow-btn-box']) ?>
                  <?= Html::a('Cancel', ['/product'], ['class'=>'btn btn-danger red-btn-box']) ?>
             </div>
        <?php ActiveForm::end(); ?>
         </div>
     

      </div>
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
jQuery(document).ready(function() {
  $('#search_word_id').submit(function() { //alert("hello");
    //var data = $(this).serialize();
    var id= $(word_id).val();

    $.ajax({
              url: "<?php echo Yii::$app->urlManager->createUrl(['/product/procat']); ?>",
              data : {'id':id},
              method: "POST",
              success: function (data) {
                //console.log(data);
                //$("#search_word_id").empty();
                //var obj = jQuery.parseJSON(data);
                $("#searchtermcategory-product_id").html(data);
               /* $.each( obj, function( key, value ) { 
                $("#searchtermcategory-product_id").append(value+'\n');
                });*/
               //$("#product-search_word").html(data);
              }

            });
    return false;
  });

});
   

    </script>
