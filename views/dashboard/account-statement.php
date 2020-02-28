<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Account Statement';
?>


 <section class="product-block">
     <div class="container">
   <table class="table table-bordered">
       <h2>Account Statement</h2>
 
  <tbody>
 
  <tr>
   <th scope="col">Detail Link</th>
   <th scope="col">Date</th>
   <th scope="col">Time</th>
   <th scope="col">Balance Forward</th>
   <th scope="col">Credit</th>
   <th scope="col">Debit</th>
   <th scope="col">Description</th>
   <th scope="col">Current Balance</th>
      
  </tr>
<?php if(!empty($model)){
foreach ($model as $key => $value) {
  //$current_balance= \app\models\AccountStatement::find()->Where(['user_id'=>Yii::$app->user->identity->id])->orderBy('id DESC')->one(); 
    ?>
  <tr>
   <td scope="col"><?php echo $value['detail_link'];?></td>
   <td scope="col"><?php echo date('d/m/Y',strtotime($value['date']));?></td>
   <td scope="col"><?php echo $value['time'];?></td>
   <td scope="col">$<?php echo $value['balance_forward'];?></td>
   <td scope="col">$<?php echo $value['credit'];?></td>
   <td scope="col">$<?php echo $value['debit'];?></td>
   <td scope="col"><?php echo $value['description'];?></td>
   <td scope="col">$<?php echo $value['current_balance'];?></td>
   
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
