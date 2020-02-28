<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\SearchTermCategory;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
$data_pro=SearchTermCategory::find()->where(['product_id'=>$model->id])->orderBy('add_tree asc')->all();
            $sam_str=array();
            foreach ($data_pro as $data_pros) {
                $sam_str[]=$data_pros['add_tree'];
            }
$dada=$sam_str;
?>
<script type="text/javascript">

  jQuery(document).ready(function(myArray) {
    var myArray = <?php echo json_encode($dada); ?>;
 $("#product-search_word").empty();
jQuery.each(myArray, function(index, value) {
   $("#product-search_word").append(value+'\n');
});
 });
</script>
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


<div class="product-block">
      <div class="product-box">
         <h2><i class="fa fa-search" aria-hidden="true"></i> Add Search Terms</h2>
         
         <div> 
         <div class="clearfix">
          <div class="inner-bodyform">

             <ol class="cd-breadcrumb triangle">
               <li><span>1 Step</span></li>
               <li class="current"><span>2 Step</span></li>
             </ol>

             <div class="row">

               <div class="col-md-4 col-sm-4 select-box-category">
                 <?php $form = ActiveForm::begin(['id'=>'search_word_cat','action'=>false]); ?>
                 <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>
                 <div id="show_sub_categories">
                  <select name='Product[category_id][]' class='form-control parent'>
                     <option value='' selected='selected'>Please choose  category</option>
                     <?php foreach ($cat_list as $key => $value) {
                      echo "<option value=".$key.">".$value."</option>";
                      }
                     ?>
                  </select>
                  </div>
                  <div class="form-group">
                  <?= Html::submitButton($model->isNewRecord ? 'Create Search Terms' : 'Create Search Terms', ['class' => $model->isNewRecord ? 'btn yellow-btn-box' : 'btn yellow-btn-box']) ?>
                  <?= Html::a('Bulk Search Terms', ['/product/bulk-search-terms'], ['class'=>'btn btn-danger red-btn-box']) ?>
                  </div>
                   <?php ActiveForm::end(); ?>
               </div>
               <div class="col-md-8 col-sm-8">
                 <?php $form = ActiveForm::begin(); ?>
                 <?= $form->field($model, 'search_word')->textarea(['rows' => 10,'readOnly'=>true]) ?>
                 <div class="form-group">
                     <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn yellow-btn-box' : 'btn yellow-btn-box']) ?>
                      <?= Html::a('Cancel', ['/product'], ['class'=>'btn btn-danger red-btn-box']) ?>
                 </div>
                 <?php ActiveForm::end(); ?>

               </div>
             </div>
             </div>
         </div>
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
  $('#search_word_cat').submit(function() { //alert("hello");
    var data = $(this).serialize();
    $.ajax({
              url: "<?php echo Yii::$app->urlManager->createUrl(['/product/searchterms']); ?>",
              data : data,
              method: "POST",
              success: function (data) {
                //alert(data);
                //console.log(data);
                $("#product-search_word").empty();
                var obj = jQuery.parseJSON(data);
                $.each( obj, function( key, value ) { 
                $("#product-search_word").append(value+'\n');
                });
               //$("#product-search_word").html(data);
              }

            });
    return false;
  });

});
   

    </script>
