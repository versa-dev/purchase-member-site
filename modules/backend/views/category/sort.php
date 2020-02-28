<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sorting';
//$this->params['breadcrumbs'][] = $this->title;
$pid=Yii::$app->getRequest()->getQueryParam('id');
if(!empty($pid)){
$url='manager?id='.$pid;
}
else {
$url='manager';
}

?>

  
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
<div class="user-index admin-garph-block">
<h1><i class="fa fa-bars" aria-hidden="true"></i> <?php echo Html::encode($this->title) ?></h1>
<div class="category-zx-section">

<?php $form = ActiveForm::begin([
            'id' => 'sort-form',
            'options' => ['class' => 'form-vertical'],
        ])
?>
<input id="order_sort" name="order_sort" type="hidden">
<div class="row">
  <div class="col-md-6">
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
    </div>
<?= Html::submitButton('Save', ['class' => 'btn btn-primary yellow-btn-box']) ?>
 <?= Html::a('Back', [$url], ['class' => 'btn btn-primary yellow-btn-box']) ?>
<?php ActiveForm::end() ?>
</div>
</div>
