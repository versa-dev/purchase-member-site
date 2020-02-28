<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MemberService */

$this->title = 'Deatil';
$this->params['breadcrumbs'][] = ['label' => 'Member Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$resut= \app\models\UploadInvoice::find()->where(['member_service_id'=>$model->id])->one();
$items=['Pending'=>'Pending','Paid'=>'Paid','Overdue'=>'Overdue'];
?>
<div class="member-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

<table class="table table-striped table-bordered detail-view">
<tbody>

<tr><th>Member Service</th><td>$<?php echo $model['member_service']; ?></td></tr>
<tr><th>Tax</th><td>$<?php echo $model['tax']; ?></td></tr>
<tr><th>Bank</th><td>$<?php echo $model['bank']; ?></td></tr>
<tr><th>Tracking Amount</th><td>$<?php echo $model['tracking_amount']; ?></td></tr>
<tr><th>Family Protection</th><td><?php echo $model['family_protection'] ==0? 'Not Choose' : '$'.$model['family_protection']; ?></td></tr>
<tr><th>Safe Purchase</th><td><?php echo $model['safe_purchase'] ==0? 'Not Choose' : '$'.$model['safe_purchase']; ?></td></tr>
<tr><th>Identity Theft Loss reduction</th><td>Yes</td></tr>


<tr><th>Created Date</th><td><?php echo $model['created_date']; ?></td></tr>
<tr><th>Updated Date</th><td><?php echo $model['updated_date']; ?></td></tr>
<tr><th>Status</th><td><?php echo $model['status']; ?> 

<?php $form = ActiveForm::begin(['action'=>'change-status?id='.$model->id]); ?>  
   Change Status<?php echo  $form->field($model, 'status')->dropDownList($items,['onchange'=>'this.form.submit()'])->label(false); ?>
 <?php ActiveForm::end(); ?></td>
</tr>
<tr><th style="background-color: #000;color: #fff;font-size: 18px;font-weight: bold;" colspan="2">Paid Amount Total: <?php echo $model['total_amount']; ?></th></tr>
</tbody>
</table>
<table class="table table-striped table-bordered detail-view">
<tbody>
 <h2>Reeipt:</h2>
<tr><th>Uploaded Receipt</th><td>
   <?php if(!empty($resut->invoice_receipt)){?> <img style="width: 300px;" src="<?php echo Yii::getAlias('@web').'/images/invoice/'.$resut->invoice_receipt; ?>"> <?= Html::a(' Download', ['download','id'=>$model['id']], ['class' => 'btn btn-primary']) ?><?php } else { echo "Receipt not uploaded yet!";} ?></td></tr>
</tbody>
</table>
</div>
