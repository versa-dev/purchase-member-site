<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'My Plan';
?>

<section class="product-block">
  <div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
<table class="table table-striped table-bordered"><thead>
<tr>
  <th>S No</th>
  <th>Membership Service</th>
  <th>Tax</th>
  <th>Bank </th>
  <th>Tracking Amount</th>
  <th>Family Protection</th>
  <th>Identity Theft Loss reduction</th>
  <th>Safe Purchase</th>
  <th>Total Amount</th>
  <th>Status</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php if(!empty($model)){ $i=1; foreach ($model as $key => $value) {?>

<tr data-key="22">
  <td>1</td>
  <td>$<?php echo $value['member_service']; ?></td>
  <td>$<?php echo $value['tax']; ?></td>
  <td>$<?php echo $value['bank']; ?></td>
  <td>$<?php echo $value['tracking_amount']; ?></td>
  <td><?php echo $value['family_protection'] ==0? 'Not Choose' : '$'.$value['family_protection']; ?></td>
  <td>Yes</td>
  <td><?php echo $value['safe_purchase'] ==0? 'Not Choose' : '$'.$value['safe_purchase']; ?></td>
  <td>$<?php echo $value['total_amount']; ?></td>
  <td><?php echo $value['status']; ?></td>
  <td><?php if($value['status'] !='Paid'){?><?= Html::a('Upload Receipt', ['upload-receipt','id'=>$value['id']], ['class' => 'btn btn-primary']) ?>
      <?php } else{?>Uploaded done<?php }?>
  </td>
 </tr>
<?php $i++; }} else { echo "No! plan you purchased";} ?>
</tbody></table>
 
      </div>
    </div>
  </div>
</section>

