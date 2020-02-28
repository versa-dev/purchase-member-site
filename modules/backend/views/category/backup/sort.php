<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sprting';
//$this->params['breadcrumbs'][] = $this->title;
$pid=Yii::$app->getRequest()->getQueryParam('id');


?>
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  
  .ui-sortable-handle {
    /* background: #3c8dbc; */
    border: 0 none !important;
    color: rgb(255, 255, 255) !important;
    margin-bottom: 5px;
    padding: 10px 5px;
  cursor: all-scroll;
}

.ui-sortable-handle a {
    color: rgb(255, 255, 255) !important;
    padding: 10px !important;
}
.ui-sortable-handle a i{
  margin-right:10px;
}
#sortable li.inactive{
  background:#920700;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background: #CA0818 none repeat scroll 0 0 !important;
    border: medium none !important;
    color: #fff !important;
    font-size: 14px !important;
    font-weight: normal;
    text-align: center !important;
}
  </style>
  
    <script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery-ui_002.js"></script>
  <script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/jquery-ui_002.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
  <script>
  $(function() {
    $('#sortable').sortable();
    $( "#sortable" ).sortable({
      placeholder: "ui-state-highlight",
    update: function(event, ui) {

      var Order = $("#sortable").sortable('toArray').toString();
      $('#order_sort').val(Order);
    
 }
    });
    $( "#sortable" ).disableSelection();
  });
  
   
   function noclild_alert(){
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }
 
  
  </script>
<div class="user-index">
<?php $form = ActiveForm::begin([
            'id' => 'sort-form',
            'options' => ['class' => 'form-vertical'],
        ])
?>
<input id="order_sort" name="order_sort" type="hidden">
<div class="form-group">
     <ul id="sortable">
      
      <?php
     // echo "<pre>"; print_r($solicitorList);die;
      
         
        
        foreach($model as $value)
        {
        //$clickable=Yii::app()->createUrl('/scheduleWork/sort',array('id' =>$page['id']));
       $clickable= Yii::$app->urlManager->createUrl(['/backend/category/sort','id'=>$value['id']]);
        echo '<li   id="'.$value['id'].'" class="ui-state-default"><a href="'.$clickable.'"   ><i class="fa fa-arrows"></i>'.$value['cat_name'].'</a></li>';
        }
      
      
      
     ?>
     
    </ul>
    </div>
<?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end() ?>
</div>
