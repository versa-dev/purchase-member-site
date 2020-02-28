<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Notification';
?>


 <section class="product-block">
     <div class="container">
      <h2>Notification</h2>
      <div class="row">
        <div class="col-sm-12">
       <p> Individuals are sent a Notification every time that their identity is used at a WebPicID Merchant. <br>

The Merchant will not ship the goods or services until the Notification is Authorized.<br>

WebPicID sends Notifications 24/7 to individuals.<br>

To resolve the Notification; the individual must log on to WebPicID , verify their Identity, and respond to the Notification. </p>

 

<h3>There are only four possible responses to a Notification.</h3>
<h3>Authorized </h3>
<p>The individual verified their identity at WebPicID and Authorized the purchase.</p>

<h3>Declined </h3>
<p>The individual verified their identity at WebPicID and Declined the purchase.</p>


<h3>Ignored </h3>
<p>Ignoring the Notification leaves the payment and goods with the Merchant.</p>


<h3>Fraud </h3>
<p>The individual verified their identity and declared a Fraud.<br>
The sale is canceled. <br>
A Fraud Report is sent by WebPicID to the victim and the Merchant.<br>         

</p>
<h2>In all cases there is no fraud loss to either party.</h2>
  



        </div>
      </div>
 </div>
        
         </section>
