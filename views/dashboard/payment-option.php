<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Payment Options';


if (Yii::$app->getSession()->hasFlash('warning'))
{
    ?>
    <script>
        alert("<?php echo Yii::$app->getSession()->getFlash('warning'); ?>")
    </script>
    <?php
}
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
<div class="container">
  <div class="row">
    <div class="col-sm-12">
<h3>Payment Options </h3>

<p>
The only payment option is to make a cash deposit at one of the bank branches below.</p>
In the USA:</br></br>
Bank of America</br>
TDBank</br>
Wells Fargo</br>
</br>
In Canada:</br></br>
Bank of Montreal</br>
TD Canada Trust</br>
Interact EMT</br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-usa'); ?>">Make a payment USA</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-canada'); ?>">Make a payment Canada</a><br>

<!--
<a href="Bank of America deposit slip.">https://idtflrco.mywhc.ca/demo_now/web/dashboard/payment-option-usaz</a><p></p></a><br><"<Make a payment in the USA>
    
Bank of America Routing Number:.021000322 Account Number: 483078986375<br>
TDBank Routing number:...............026013673 Account Number: 4352458412<br>
Wells Fargo Routing Number:........026012881 Account Number: 2180028074<br>
In Canada,
</p>

Membership and Family Protection are 25.00 + $20.00  a year plus tax of 5% = 1.25 and $1.00.</br>
The bank deposit fee is $1.75.</br>
We suggest that your first payment be $50.00 plus any Safe Purchase amounts that you want to make.</br>
</p>
<p>
Safe Purchase is a non bank card online payment option. </br>
Members prepay for their purchases by making a payment at a WebPicID bank branch.</br>
Dependent Member can use Safe Purchase with the permission of the Parent.</br>
A Parent gives WebPicID authorization to allow a dependent Member use Safe Purchase</br>
when they transfer funds to the WebPicID account of a Dependent Member.</br>
All items purchased for the Dependent Member are shipped to the Parent.</br>
</p>

<h3>United States of America</h3>
<p></p>WebPicID deals with the following banks.</br>
All deposits are made in paper cash, no coin.</p>

<!-- <a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/act-of-agent'); ?>e)</a><br><">Act as an Agent (18+ years of ag>




            http://webpicid.com/index.php?id=110
            <p>
              <a href="payment-option-usa">https://idtflrco.mywhc.ca/demo_now/web/dashboard/payment-option-usa</a><p>
            http://webpicid.com/index.php?id=110
        </p>
<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('message'); ?>">Secure Message</a><br>
            
        </p>

<p><b></b>
<p>
<h3>Canada</h3>
Bank of Montreal Transit Number: 2063 Account Number: 2063-8973512<br>

TD Canada Trust Transit number: 8246 Account Number: 8246-5012273<br>

EMT Email Money Transfer From any Canadian bank<br>

</p>

<!--<a href="https://idtflrco.mywhc.ca/demo_now/web/dashboard/payment-option-canada">https://idtflrco.mywhc.ca/demo_now/web/dashboard/payment-option-canada</a>
      
        
<h3>How to make a deposit:</h3>



<p>
Go to any branch of one of the banks listed above.</br>
Deposit slips can be found at a counter.</br>
Complete the Depost Slip (Print all information)</br>

Deposit Slip for Name of Bank</br></p>
<p>Date:       Todays Date</br>
Deposit to: Web Picture identification Inc.</br>
Siganture:  pay_code and sign the slip</br>
</b></b>
<br>Routing #                 Account #</br>
_______________               ______________ </br>
<br>(Print these numbers from the the picture on your phone.)</br><p>

Enter the total amount of the deposit on the right side.</br>
Give the deposit slip to the teller with the cash.</br></br>
You will be asked to provide picture identification.</br>
Save the receipt.</br>

Report the payment.</br>

<br>How to report a deposit


</p>

<!-- <p>
Go to any branch of one of the banks listed above.<br>
Complete a deposit slip. (They are available at the bank.)<br>
The deposits are credited to the account of:<br>
Web Picture Identification Inc. o/a WebPicID.<br>
Give the funds and the deposit slip to the teller.<br>
Get a receipt.<br>
</p>

<h3>How to report a deposit</h3>

<p><br>Canada</p> 
<!--        changed by GP
<p><br>Canada</p> 
<a href="report-deposit-bank-canada">https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-bank-canada</a>

<p><br>USA</p>
<a href="https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-bank-usa">https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-bank-usa</a>

<!--
<p>
Print your Deposit code on a blank spot on the receipt<br>
Take a picture of the receipt (if possible at the bank)<br>
Log on to WWW.WebPicID.com<br>
Select Secure Message<br>
Create an email to cash@Wpid.ca<br>
</p>
<p>
Enter the following information:<br>

In the subject:   Bank Deposit code Amount<br>
In the body:       Your Name<br>
Attach the picture of the receipt<br>

Press Send<br>

</p>
<h3>How to make an EMT Email Money Transfer:</h3>


<p>Log on to your internet banking<br>

Select EMT<br>
The recipient name is WebPicID<br>
The email address is EMT@WebPidID.com<br>

Enter a security question and an answer</p>


<h3>How to report an EMT (Canada only)</h3>
<a href="report-deposit-emt">https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-emt</a>

<!-- <h3>Select Secure Message</h3>

<p>
Send a Secure Message to EMTCAN@webpicid.com<br>

On the form</br>
Answer to the security question. Change it every time.</br>
Date Paid (The default "Today").</br>
Time (The default is "NOW")</br>
Amount</br>
<!-- Example<br>

  <div class="col-sm-6"><b>Email Address </b> </div><div class="col-sm-3"> <b>First name</b></div> <div class="col-sm-3"> <b>Last name</b></div>

<div class="col-sm-6">EMT@WebPicID.com</div><div class="col-sm-3">  emt   </div> <div class="col-sm-3">  w </div>  <br>

<b>Subject</b><br>

Amount        Deposit code      Answer to the question    <br> -->         

<Body>


</p><br><br><br><br>
</div>
<!-- <table class="table table-bordered" style="text-align: left;font-size: 18px;height:auto;width:30%;margin-left: 35%;">
  
  <tbody>
    
        <tr>
            <td></td>
              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-usa'); ?>">Payment Options USA</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-canada'); ?>">Payment Options Canada</a></td>
            </tr>
          
            
           
             
            </tr>
        
        </tbody>
</table>
 -->


            <!-- <tr>
            <td></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-usa'); ?>">How to Make a Deposit USA</a></td>
            <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option-canada'); ?>">How to Make a Deposit Canada</a></td>
            </tr>
            <tr>
            <td></td>
             <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-usa'); ?>">Report a deposit USA</a></td>
              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-canada'); ?>">Report a Deposit Canada</a></td>
            </tr>
            <tr>
              <td></td> <td></td><td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-emt'); ?>">Report an EMT Canada</a></td>
           </tr> -->
