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


 <section class="product-block">
          <div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
              <ul class="list-group">
              <li class="list-group-item active">Plan Description </li>
              <li class="list-group-item">Membership Service(Basic) : $<?php echo $member_service; ?> </li>
              <li class="list-group-item">Tax : $<?php echo $tax; ?> </li>
              <!--<li class="list-group-item">Bank : $<?php echo $bank; ?> </li>
              <li class="list-group-item">Tracking Amount : $<?php echo $tracking_amount; ?> </li>            
              <li class="list-group-item"><h3>Services</h3> </li>
              <li class="list-group-item">Family Protection : <?php echo $family_protection ==0? 'Not Choose' : '$'.$family_protection; ?> </li>
              <li class="list-group-item">Identity Theft Loss reduction : Free </li>
              <li class="list-group-item">Safe Purchase : <?php echo $safe_purchase ==0? 'Not Choose' : '$'.$safe_purchase; ?> </li>
              <li class="list-group-item">Payment Options:  USA TDBank,Wells Fargo, Bank of America, or Chase Canada Bank of Montreal and Toronto Dominion. </li>-->
              </ul>
              </div>
              <div class="col-md-12 col-sm-12" style="text-align: center;position: relative;display: block;padding: 10px 15px;margin-bottom: -1px;color:#fff;border: 1px solid #ddd; float: left; background-color: #000; font-size: 18px;"><strong>Total amount Pay: $<?php echo $total_amount; ?></strong></div>
            
             <div class="col-md-12 col-sm-12" style="text-align: center;position: relative;display: block;padding: 10px 15px;margin-bottom: -1px;color:#000;border: 1px solid #ddd; float: left"> <?= Html::a('Accept', ['accept-plan'], ['class' => 'btn btn-primary']) ?> <?= Html::a('Cancel', ['membership'], ['class' => 'btn btn-primary']) ?></div>
            </div>
            
          </div>
         </section>


 