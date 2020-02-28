<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */
$this->title = 'Detail Safe Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Safe Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user= \app\models\User::find()->where(['id'=>$model->user_id])->one();
//$more_item = Yii::$app->db->createCommand('SELECT more_item FROM safe_purchase_more_item WHERE safe_purchase_id="'.$model->id.'"')->queryAll();
//$sufe_purchage_image = Yii::$app->db->createCommand('SELECT image FROM sufe_purchage_image WHERE safe_purchase_id="'.$model->id.'"')->queryAll();
//echo "<pre>"; print_r($data); die;
?>
<div class="safe-purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>
<table class="table table-bordered">
    <tbody>
      <tr><th>Username</th><td><?php echo $user['username']; ?></td>
      <th>Url</th><td><?php echo $model['url']; ?></td>
      </tr>
      <tr><th>Total Amount</th><td><?php echo $model['total_amount']; ?></td>
      <th>Vendor Name</th><td><?php echo $model['vendor_name']; ?></td>
      </tr>
      <tr>
      <th>Cart User ID</th><td><?php echo $model['cart_user_id']; ?></td>
      <th>Cart Password</th><td><?php echo $model['cart_password']; ?></td>
      </tr>
      <tr>
      <th>Created Date</th><td><?php echo $model['created_at']; ?></td>
      </tr>
       </tbody>
  </table>
  <!-- <table class="table table-bordered">
    <tbody>
      <tr>
       <td colspan="2"><h2>Items</h2></h2></td>
      </tr>
     
       
      <?php //$i=1; foreach($more_item as $value){ ?>     
     <tr> <th>Item<?php //$i; ?></th><td><?php //echo $value['more_item']; ?></td>
      </tr><?php //$i++; } ?> 
       <tr>
       <td colspan="2"><h2>Attachment</h2></h2></td>
      </tr>
        <?php //$i=1; foreach($sufe_purchage_image as $value){ ?>  
     <tr> <th>Attachment<?php //$i; ?></th><td><img src="<?php //;Yii::$app->request->baseUrl . '/images/attachment/' . $value['image'] ?>" class=" img-responsive" width="30%"></td>
       </tr> <?php //$i++; } ?>
    
     
      
      
     </tbody>
  </table> -->
   <p>
        <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
         //   'data' => [
         //       'confirm' => 'Are you sure you want to delete this item?',
         //       'method' => 'post',
        //    ],
       // ]) ?>
    </p>

    <!-- <?php //echo DetailView::widget([
        //'model' => $model,
       // 'attributes' => [
      //      'id',
      //      'user_id',
      //      'url:url',
       //     'total_amount',
       //     'shopping_cart',
       //     'description:ntext',
       //     'more_items',
       //     'created_at',
       //     'updated_at',
      //  ],
   // ]) ?>-->

</div>
