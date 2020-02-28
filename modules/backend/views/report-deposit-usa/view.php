<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReportDepositCanada */
$this->title = 'Detail of Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payment_Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user= \app\models\User::find()->where(['id'=>$model->user_id])->one();
//$more_item = Yii::$app->db->createCommand('SELECT more_item FROM safe_purchase_more_item WHERE safe_purchase_id="'.$model->id.'"')->queryAll();
//$sufe_purchage_image = Yii::$app->db->createCommand('SELECT image FROM sufe_purchage_image WHERE safe_purchase_id="'.$model->id.'"')->queryAll();
//echo "<pre>"; print_r($data); die;
?>
<div class="Report-Deposit-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>User_ID</th><td><?php echo $user['id'];?></td>
            <th>Username</th><td><?php echo $user['username']; ?></td>
        </tr>
        <tr>
            <th>User_Email</th><td><?php echo $user['email'];?></td>
            <th>Amount</th><td><?php echo $model['amount']; ?></td>
        </tr>
        <tr>
            <?php if(isset($model['bank_name'])) {?>
                <th><?php echo 'Bank_name';?></th>
                <td><?php echo $model['bank_name']; ?></td>
            <?php }?>
            <?php if(!isset($model['bank_name'])) {?>
            <th><?php echo 'Question_Answer';?></th>
            <td><?php echo $model['question_answer']; ?></td>
            <?php }?>
            <th>Payment-Datetime</th><td><?php echo $model['payment_date_time']; ?></td>
        </tr>
        <tr><th>Created_At</th><td><?php echo $model['created_at']; ?></td>
            <th>Updated_At</th><td><?php echo $model['updated_at']; ?></td>
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
