<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Safe Purchase';
?>


 <section class="product-block">
     <div class="container">
   <table class="table table-bordered">
       <h2>Safe Purchase</h2>
 
  <tbody>
 
  <tr>
   <th scope="col">Vendor Name:</th>
   <th scope="col">URL:</th>
   <th scope="col">Total Amount</th>
   <th scope="col">Cart User ID</th>
   <th scope="col">Cart Password</th>  
   <th scope="col">Created At</th>      
  </tr>
<?php if(!empty($model)){
foreach ($model as $key => $value) {
    ?>
  <tr>
   <td scope="col"><?php echo $value['vendor_name'];?></td>
   <td scope="col"><?php echo $value['url'];?></td>
   <td scope="col"><?php echo $value['total_amount'];?></td>
   <td scope="col"><?php echo $value['cart_user_id'];?></td>
   <td scope="col"><?php echo $value['cart_password'];?></td>
   <td scope="col"><?php echo date('d/m/Y',strtotime($value['created_at']));?></td> 
  </tr>
  <?php }} else{ "There is no record!!!";} ?>
  </tbody>
</table>
   <!--   <div class="row">
            <div class="col-md-12 col-sm-12" style="text-align: center;position: relative;display: block;padding: 10px 15px;margin-bottom: -1px;color:#fff;border: 1px solid #ddd; float: left; background-color: #000; font-size: 18px;"><strong>Total amount Pay: $<?php echo 30; ?></strong></div>
            
             <div class="col-md-12 col-sm-12" style="text-align: center;position: relative;display: block;padding: 10px 15px;margin-bottom: -1px;color:#000;border: 1px solid #ddd; float: left"> 
             <?php //echo Html::a('Accept', ['accept-plan'], ['class' => 'btn btn-primary']) ?> <?php //echo  Html::a('Cancel', ['index'], ['class' => 'btn btn-primary']) ?></div>
            </div>-->
          </div>
         </div> 
         </section>
