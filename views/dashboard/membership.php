<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Membership';
$member_service=25;
$tax=1.25;
$bank=1;
$tracking_amount=0.01;
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>

 <section class="product-block">
     <div class="container">
   <table class="table table-bordered">
       <h2>Invoice Membership</h2>
 
  <tbody>
 
  <tr>
      <th scope="col" width="71%">Fee</th><td>$25.00</td></tr>
      <tr> <th scope="col">GST 5%</th><td>1.25</td></tr>
      <tr> <th scope="col">Total</th><td>26.15</td></tr>
      <tr> <th scope="col"></th><td></td></tr>
     <tr>  <td scope="col">Make a Deposit to pay this amount.<br>

Minimum Deposit is $30.00.<br> The difference is credited to your WebPicID account.</td><td></td>
      
    </tr>
  
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
