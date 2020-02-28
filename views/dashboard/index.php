<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Dashboard';
 function ago($timestamp)
    { 
       $difference = time() - $timestamp;
       $periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
       $lengths = array("60","60","24","7","4.35","12","10");
       for($j = 0; $difference >= $lengths[$j]; $j++)
       $difference /= $lengths[$j];
       $difference = round($difference);
       if($difference != 1) $periods[$j].= "s";
       $text = "$difference $periods[$j] ago";
       return $text;
    }
    $models = \app\models\User::findOne(Yii::$app->user->id);
$user_code= $models['user_code'];
?>
<style>
.text-align{
padding: 28px 0px 0px 16px;
text-align: left !important;
}
.btn-info {
color: #000;
background-color: #fff!important;
border-color: #46b8da;
font-size: 24px;
}
.btn-info:hover {
    color: #000;
    border-color: #46b8da;
    font-size: 24px;
}
</style>

<!--<table class="table table-bordered" style=" text-align: center;font-size: 18px;">
  
  <tbody>
        <tr>
            <td colspan="4"></td>
        </tr>
         <tr>
            <td></td>
            <td></td>
            <td>Web Picture Identification Inc. O/A WebPicID<br>

<a href="Http://www.WebPicID.com">Http://www.WebPicID.com</a></td>
            <td></td>
        </tr>
        
         <tr>
            <td></td>
            <td colspan="2">
Your Deposit Code is: <?php echo $user_code; ?><br>
Your WebPicID Account Balance is -$26.15.<br>
Please make a deposit</td>
            <td></td>
        </tr>
         <tr>
            <td></td>
            <td colspan="2">
We have sent you an email to verify your email address.<br>

WebPicID has sent messages to your Secure Message In Box</td>
            <td></td>
        </tr>
         
   
    
  </tbody>
</table>-->
<table class="table table-bordered" style="text-align: left;font-size: 18px;height:auto;width:30%;margin-left: 35%;">
  
  <tbody>
      <tr>
        <td></td>    
   <td colspan="2"><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/identity-theft-loss-reduction'); ?>">Identity Theft Fraud Loss Reduction</a></td>
        </tr>
        <tr>
            <td></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('message'); ?>">Secure Message</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/create-safe-purchase'); ?>">Safe Purchase</a></td>
            </tr>
            <tr>
            <td></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option'); ?>">Payment options</a></td>
              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-service'); ?>">Family Protection</a></td>
            </tr>
            <tr>
            <td></td>
              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/notification'); ?>">Notification</a></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/pre-registration'); ?>">Pre Registration</a></td>
            </tr>
             <tr>
            <td></td>
               <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/share-an-organization'); ?>">Share an organization</a></td>
               <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/refer-an-organization'); ?>">Refer an organization</a></td>
            </tr>
             <tr>
            <td></td>
               <td><a class="btn btn-info" href="#">Statement</a></td>
               <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-signup'); ?>">Merchant Sign Up</a></td>
            </tr>
             <tr>
            <td></td>
               <td><a class="btn btn-info" href="#">Act of Agency</a></td>
               <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/profile'); ?>">Profile</a></td>
            </tr>
        
        </tbody>
</table>



<<!--table class="table table-bordered" style=" text-align: center;font-size: 18px;height:auto">
  
  <tbody>
      <tr>
            
            <td colspan="7">

<h3>Member Services</h3>    <p>Please read you Secure Messages from WebPicID</p>   </td>
    
        </tr>
        <tr>
            <td></td>
            <td colspan="2"><a class="btn btn-success" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/identity-theft-loss-reduction'); ?>">Identity Theft Fraud Loss Reduction</a></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
              </tr>
        <tr>
            <td></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('message'); ?>">Secure Message</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/create-safe-purchase'); ?>">Safe Purchase</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-service'); ?>">Family Protection</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-usa'); ?>">Payment Options USA</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-usa'); ?>">Report a deposit USA</a></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
          
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-add'); ?>">Family AGP Dashboard</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-canada'); ?>">Payment Options Canada</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/account-statement'); ?>">WebPicID Statement of Account</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-emt'); ?>">Report an EMT Canada</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-canada'); ?>">Report a Deposit Canada</a></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            
          
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-usa'); ?>">How to Make a Deposit USA</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-canada'); ?>">How to Make a Deposit Canada</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/notification'); ?>">Notification</a></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/profile'); ?>">Profile</a</td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/refer-an-organization'); ?>">Refer an organization</a></td>
             <td></td>
            
        </tr>
       
   <tr>
            <td></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/share-an-organization'); ?>">Share an organization</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/act-of-agency'); ?>">Act of Agency</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/pre-registration'); ?>">Pre Registration</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-signup'); ?>">Merchant Sign Up</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('/images/IDTheftrecovery_checklist.doc__-Linux-generated_files-job_109.pdf'); ?>" target="_blank">ID Theft Recovery checklist</a></td> 
            <td></td>
             
        </tr>
   <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
              </tr>
    
  </tbody>
</table>-->
            
<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
   <?php
        //$dataPoints = $month;
      //  //echo "<pre>"; print_r($dataPoints);die;
    ?>
 <section class="product-block">
          <div>
            <div class="row">
                <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Identity Theft Fraud Loss Reduction </h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                        Use Safe Purchase to make a non bank card online purchase or buy at WebPicID Merchants. Individuals making a purchase at WebPicID are advised that the Merchant protects them from ID Theft Fraud Losses by having WebPicID verify their identity.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2><a href="<?php echo Yii::$app->urlManager->createUrl(['dashboard/create-safe-purchase']); ?>">Safe Purchase </a></h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                        Safe Purchase allows Members to have WebPicID make online purchases for them with out a bank card. Children age 5+ can use this service. Goods or services purchased by children are shipped to the Parent/Guardian.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Family Protection </h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       A family is defined ans at least 1 adult and one other person regardless of age. The Member requesting this service is the Administrator/Guardian/Parent, AGP for all members of the family. The AGP agrees to Act as the Agent for WebPicID in verifying the identity of all members of the family for one Agent fee.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Pre Register </h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       Individuals can Pre-Register to enhance their Identity Theft Fraud Reduction.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Secure Message </h2>
                    <div class="clearfix height">
                      <div class="col-common-5 border-right text-align">
                       Only Members can send Secure Messages.<br>

Secure Messages can be sent to anyone.<br>

The Sender needs and email address and name.<br>

For added security add a phone number.<br>

The message has a subject, body and optionally an attachment. (Only a picture or PDF).
                      </div>
                       <div class="col-common-5 text-align">
                       Only the Member and the Recipient can read the message. The Recipient must log on to WebPicID and verify their identity to read the message.<br>

The Sender is notified when the message s opened by the Recipient.
                      </div>
                    </div>
                  </div>
              </div>
              
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Payment Options </h2>
                    <div class="clearfix height">
                      <div class="col-common-5 border-right text-align">
                      Cash at banks in the USA and Canada.<br>

In the USA.<br>

Bank of America.<br>

TDBankr.<br>

Wells Fargo.
                      </div>
                       <div class="col-common-5 text-align">
                        In Canada.<br>

Bank of Montreal Cash and Bill payment.<br>

TD Canada Trust Cash.<br>

EMT’s from any bank.<br>

Wells Fargo.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Statement of Account</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       This shows all deposits, debits, credits, purchases, fees charged, transfers and the balance.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Refer an Organisation</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       Members can refer an organisation to sign up with WebPicID. They get 10% of the ID Theft Fraud Recovery Fee. The organisation must name the Member as the person who referred them.
                      </div>
                    </div>
                  </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Share an Organisation</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       Members can share any number of organizations with WebPicID.com daily for a draw into a pool of 10% of the ID Theft Fraud Reduction Revenue.
                      </div>
                    </div>
                  </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Merchant Sign Up</h2>
                    <div class="clearfix height">
                      <div class="col-common-5 border-right text-align">
                       Any individual in an organisation can sign up with WebPicID. The individual signing up is designated as the Administrator and must verify their identity.
                      </div>
                       <div class="col-common-5 text-align">
                           The benefits are:<br>

Identity Theft Loss Reduction<br>

Lower operating costs<br>

New Markets<br>
                           </div>
                    </div>
                  </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Merchant Services</h2>
                    <div class="clearfix height">
                      <div class="col-common-5 border-right text-align">
                       Identity Theft Fraud Loss Reduction<br>

Victim Contact Cost reduction<br>

Secure Message<br>

Fee Structure<br>
                      </div>
                       <div class="col-common-5 text-align">
                          Each service has a detailed explanation that can be reached by clicking the service and activating the link.
                           </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Member Services</h2>
                    <div class="clearfix height">
                      <div class="col-common-5 border-right text-align">
                       Identity Theft Fraud Loss Reduction<br>
Act as an Agent<br>

AGP Dashboard<br>

Display Deposit code<br>

Family Protection<br>

Identity Theft Fraud Loss Reduction<br>

Merchant sign Up<br>


                      </div>
                      <div class="col-common-5 text-align">
                          Refer an organisation<br>

Safe Purchase<br>

Secure Message<br>

Share an organisation<br>

Sign Up<br>

Statement of Account
                      </div>
                       
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>AGP Dashboard</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                       This allows an AGP to review all messages and transactions of Child Family Members.<br>

New family members can be added.
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Administrator Dashboard</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                      
                      </div>
                    </div>
                  </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Merchant Reports</h2>
                    <div class="clearfix height">
                      <div class="col-common-12 text-align">
                      Daily Activity Report<br>

Sales awaiting Authorization<br>

Frauds stopped<br>

Frauds reported<br>

Sales ignored<br>

Sales canceled<br>

Micro Payments
                      </div>
                    </div>
                  </div>
              </div>
             <!-- <a href="<?php //echo Yii::$app->urlManager->createUrl(['dashboard/membership']); ?>">
              <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                  <div class="product-box">
                    <h2>Invoice </h2>
                    <div class="clearfix height">
                      <div class="col-common-5 no-bg border-right">
                        <i class="fa fa-check" aria-hidden="true"></i>
                      
                      </div>

                      <div class="col-common-5 no-bg">
                        <span class="no-word">Utilities and opportunities <?php //echo count($total); ?></span>
                      </div>
                    </div>
                  </div>
              </div>
            </a>-->
              <!--<div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                <div class="product-box">
                  <h2>Family Protection</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>
                    </div>

                    <div class="col-common-5 no-bg">
                      <span class="no-word">Utilities and opportunities <?php //echo count($unpending); ?></span>
                    </div>
                  </div>
                </div>
              </div>-->

              <!--<div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                <div class="product-box">
                  <h2>Identity Theft Loss reduction</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>-->
                      <!-- <i class="fa fa-times" aria-hidden="true"></i> -->
                    <!--</div>-->

                    <!--<div class="col-common-5 no-bg">
                      <span class="no-word">Utilities and opportunities <?php //echo count($pending); ?></span>
                    </div>
                  </div>
                </div>
              </div>-->


              <!--<div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                <div class="product-box">
                  <h2>Merchant Sign Up</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>-->
                      <!-- <i class="fa fa-archive" aria-hidden="true"></i> -->
                   <!-- </div>
-->
                   <!-- <div class="col-common-5 no-bg">
                      <span class="no-word">Utilities and opportunities <?php //echo count($total); ?></span>
                    </div>
                  </div>
                </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                <div class="product-box">
                  <h2>Safe Purchase</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>-->
                      <!-- <i class="fa fa-archive" aria-hidden="true"></i> -->
                  <!--  </div>
-->
                   <!--div class="col-common-5 no-bg">
                      <span class="no-word">Utilities and opportunities <?php //echo count($total); ?></span>
                    </div>
                  </div>
                </div>
              </div>
               <div class="col-md-6 col-sm-6" style="margin-top: 22px;">
                <div class="product-box">
                  <h2>Secure Message</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-check" aria-hidden="true"></i>-->
                     <!--  <i class="fa fa-archive" aria-hidden="true"></i> -->
                   <!-- </div>

                    <div class="col-common-5 no-bg">
                      <span class="no-word">Utilities and opportunities <?php //echo count($total); ?></span>
                    </div>
                  </div>
                </div>-->
              </div>

              

              <!-- <div class="col-md-3 col-sm-3">
                <div class="product-box">
                  <h2>Pending Products</h2>
                  <div class="clearfix height">
                    <div class="col-common-5 border-right">
                      <i class="fa fa-adjust" aria-hidden="true"></i>
                    </div>
              
                    <div class="col-common-5 no-bg">
                      <span class="no-word">15</span>
                    </div>
                  </div>
                </div>
              </div> -->


            </div>
          </div>
         </section>


     <!--     <section class="product-block">
          <div>
            <div class="row">

              <div class="col-md-12 col-sm-12">
                <div class="product-box bg-big" style="height:auto;">
                  <h2><i class="fa fa-star" aria-hidden="true"></i> Recent Products</h2>
                            <div class="all-over">
                             <?php //$i=1; foreach ($total as $key => $value) {?>
                              
                              <div class="feed-element">                              
                                <span class="pull-left"><span class="snno"><?php //echo $i; ?></span></span>
                                <div class="media-body "><small class="pull-right"><?php //echo ago(strtotime($value['created_date']));  ?></small><span></span>
                                <span><?php //echo $value['item_name']; ?></span> <br>
                                <small class="text-muted"></small>
                                </div>
                              </div> 
                              <?php //$i++; if($i==5){break;} }?>
                              </div> 

                            <div class="view-all clearfix">
                              <a href="<?php //echo Yii::$app->urlManager->createUrl('/product'); ?>" class="btn-right right"><i class="fa fa-eye" aria-hidden="true"></i> View All</a>
                            </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12">
                <div class="product-box bg-big">
                  <h2><i class="fa fa-bar-chart" aria-hidden="true"></i> Products Monthly Graph</h2>
                  <div class="all-over">
                  <div id="chartContainer"></div>
                   
                  </div>
                </div>
              </div>

            </div>
          </div>
         </section> -->
<!--          <script type="text/javascript">
 
            $(function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "theme2",
                    animationEnabled: true,
                    title: {
                        text: ""
                    },
                    data: [
                    {
                        type: "column",                
                        dataPoints: <?php //echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }
                    ]
                });
                chart.render();
            });
        </script>-->