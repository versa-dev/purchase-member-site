<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Payment options Canada 03092019';
?>


<section class="product-block">
	<div class="container">
		<h2>Make a Canada</h2>
		<div class="row">
			<div class="col-sm-12">
<p>Bank of Montreal</br>
Transit code: 2063-9 Account Number: 1996-260</br>
TD Canada Trust</br>
Transit code: 8246-9 Account Number: 7200690</br>
Interac Email Money Transfer  EMT </br>
</p>
<h4>How to make a deposit:</h4><p>
Step 1	Go to any branch of one of the banks listed above.</br>
Step 2	Go to a side counter and find a deposit slip.</br>
Step 2a If there are no depost slips ask a bank empoloyee for one.</br>
Step 3	Fill out the deposit slip</br>
	Deposit to: Web Picture Identification Inc.</br>
	Signature: AA1  Signature</br>
	(AA1 is your pay_code print it befor you signature.)</br>
	(WebPicID uses the pay_code to match the payment to you.)</br>
Step 4	Print the routing number and the account number	</br>
Step 5 Give the deposit slip and the cash to the teller.</br>
Step 6 Get a receipt. Print your pay code on the receipt.<br>
Step 7 Report the payment to WebPicID.</br></p><p>

<p>How to Make an EMT Payment to WebPicID</p>
Log on to your internet banking<br>
selet Interace 
Financial institution

<a href="http://www.webpicid.com/webpicid/index.php?id=109"><span style="font-size: large;">Click here to see a Bank of Montreal deposit slip</span></a>
&nbsp;<span style="font-size: large;">&nbsp;</span></a><p></p>

<a href="http://www.webpicid.com/webpicid/index.php?id=111"><span style="font-size: large;">Click here to see a TD Canada Trust deposit slip</span></a>
<p><span style="font-size: large;">&nbsp;</span>
</p>



              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-canada'); ?>">Report a Deposit Canada</a></td>
              <p></p> 
              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-emt'); ?>">Report an EMT Canada</a></td>
              <p></p> 
              <p deposit any amount in paper currency at a teller.<br>
</p>
              <p></p> </br>
              <p></p>
              <p></p>
            </tr>
            <tr>
<!--
<p>Members can deposit any amount in paper currency at a teller.<br>

<p><span style="font-size: large;"><span style="font-size: large;"><a href="http://www.webpicid.com/webpicid/index.php?id=111">Click here for a custom deposit slip</a></span></span></p>



<p><a href="http://www.webpicid.com/webpicid/index.php?id=19"><span style="font-size: large;">Click here for a custom deposit slip</span></a></p>
<p>&nbsp;<span style="font-size: large;">Wells Fargo Routing&nbsp;</span></p>

<p><a href="http://www.webpicid.com/webpicid/index.php?id=112"><span style="font-size: large;">Click here for a custom deposit slip</span></a></p>
<p><span style="font-size: large;">TDBank Routing&nbsp;</span></p>

<p><span style="font-size: large;"><span style="font-size: large;"><a href="http://www.webpicid.com/webpicid/index.php?id=111">Click here for a custom deposit slip</a></span></span></p>

</p>

 <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-usa'); ?>">Report a deposit USA</a></td>
Deposits can be made at an branch of:</p>


<h3>Bank of Montreal </h3>

<p>Transit Number: 2063

Account Number: 2063-8973512</p>


<h3>TD Canada Trust </h3>

<p>Transit number: 8246

Account Number: 8246-5012273</p>


<h3>How to make a deposit: </h3>


<p>Go to any branch of one of the banks listed above.<br>

Complete a deposit slip. (They are available in the bank.)<br>

The deposits are credited to the account of:<br>

Web Picture Identification Inc. o/a WebPicID.<br>

Give the funds and the deposit slip to the teller.<br>

Get a receipt.</p>

<h3>How to report a payment: </h3>

<a>https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-bank-canada</a>

<p>Print your Deposit code on a blank spot on the receipt.<br>

Take a picture of the receipt.</p>


<h3>Log on to www.webpicid.com </h3>


<h3>Select Secure Message </h3>


<p>Send a secure message to PaymentCAD@webpicid.com<br>


In the subject enter: The amount The bank name<br>

Upload the receipt<br>

Press continue.</p>


<h3>How to report an EMT </h3>

<a>https://idtflrco.mywhc.ca/demo_now/web/dashboard/report-deposit-emt</a>

<p>Select Secure Message<br>

Send the secure message to EMTCAN@webpicid.com<br>


In the subject line enter: Amount Answer EMT transaction number<br>

Press Send</p>
			</div>
			<!-- <div class="col-sm-12">
				<p> All deposits are made in paper cash<br>
					Members can deposit any amount in paper currency at a teller.<br>
					The deposits are credited to the account of:<br>
					Web Picture Identification Inc. o/a WebPicID.<br>
				Deposits can be made at an branch of:</p>
				<h3>Bank of Montreal </h3>
				Transit Number: 2063<br>
				Account Number: 2063-8973512
				<h3>TD Canada Trust</h3>
				Transit number: 8246<br>
				Account Number: 8246-5012273
				<h3>How to make a deposit:</h3>
				<p>
					Go to any branch of one of the banks listed above.<br>
					Complete a deposit slip. (They are available at the bank.)<br>
					Give the funds and the deposit slip to the teller.<br>
					Get a receipt.
				</p>
				<h3>How to report a payment.</h3>
				<p>
					Print your Deposit code on a blank spot on the receipt.<br>
					Take a picture of the receipt.<br>
					Log on to <a href="WW.WebPicID.com">  WWW.WebPicID.com</a><br>
					Select report a payment USA.<br>
					Enter the amount, the bank name, upload the receipt and press continue.<br><br>
				</p>
				<h3>How to report an EMT</h3>
				<p>
					Log on to WebPicID<br>
					Select Report an EMT<br>
					Enter the amount and the answer to the question.<br>
					Press continue.<br>
				</p>
				<br><br>
			</div> -->
		</div>
	</div>
</section>