<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Payment options USA';
?>


<section class="product-block">
	<div class="container">
		<h2>Make a Payment USA</h2>
		<div class="row">
			<div class="col-sm-12">
		
		Bank of America</br>
Routing Number: 021000322 Account Number: 483078986375</br>
TDBank</br>
Routing number: 026013673 Account Number: 4352458412</br>
Wells Fargo</br>
Routing Number: 026012881 Account Number: 2180028074</br>

<!-- <section class="product-block">
	<div class="container">
		<h2>Payment options Canada</h2>
		<div class="row">
			<div class="col-sm-12">
<p>Bank of Montreal</br>
Transit code: 2063-9 Account Number: 1996-260</br>
TD Canada Trust</br>
Transit code: 8246-9 Account Number: 7200690</br>
Interac Email Money Transfer  EMT </br>
</p>-->

<h4>How to make a deposit:</h4><p>
Step 1	Go to any branch of one of the banks listed above.</br>
Step 2	Go to a side counter and find a deposit slip.</br>
Step 2a If there are no depost slips ask a bank empoloyee for one.</br>
Step 3	Fill out the deposit slip</br>
	Deposit to: Web Picture Identification Inc.</br>
	Signature: AA1  Signature</br>
	(AA1 is your pay_code print it before your signature.)</br>
	(WebPicID uses the pay_code to match the payment to you.)</br>
Step 4	Print the routing number and the account number	</br>
Step 5 Give the deposit slip and the cash to the teller.</br>
Step 6 Get a receipt. Print your pay_code on the receipt.<br>
Step 7 Report the payment to WebPicID.</br></p><p>
    

<a href="http://www.webpicid.com/webpicid/index.php?id=110"><span style="font-size: large;">Click here to see a Bank of America deposit slip</span></a>
&nbsp;<span style="font-size: large;">&nbsp;</span></a><p></p>

<a href="http://www.webpicid.com/webpicid/index.php?id=111"><span style="font-size: large;">Click here to see a TDBank deposit slip</span></a>
<span style="font-size: large;">&nbsp;</span></p>
<a href="http://www.webpicid.com/webpicid/index.php?id=112"><span style="font-size: large;">Click here to see a Wells Fargo deposit slip</span></a>
<p><span style="font-size: large;">&nbsp;</span>
</p>



              <td><a class="btn btn-info" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-deposit-bank-usa'); ?>">Report a Deposit USA</a></td>
              <p></p> 
              <p deposit any amount in paper currency at a teller.<br>
</p>
              <p></p> </br>
              <p></p>
              <p></p>
            </tr>
            <tr>	    
			    
			    
			    
			    <!--
<a>	
Bank of America</br>
Routing Number: 021000322 Account Number: 483078986375</br>
TDBank</br>
Routing number: 026013673 Account Number: 4352458412</br>
Wells Fargo</br>
Routing Number: 026012881 Account Number: 2180028074</br>
H
			    
			    <!--
			    	<h3>All deposits are made in paper cash, no coin.</h3>
				<h3>WebPicID deals with the following banks.</h3>
			
				<h3>Bank of America</h3>
				<p>Routing Number: 021000322 Account Number: 483078986375</p>

				<h3>TDBank</h3>

<p>Routing number: 026013673 Account Number: 4352458412</p>




<h3>Wells Fargo </h3>

<p>Routing Number: 026012881 Account Number: 2180028074</p>


<h3>How to make a deposit: </h3>


<p>Go to any branch of one of the banks listed above.<br>

Complete a deposit slip. (They are available at the bank.)<br>

The deposits are credited to the account of:<br>

Web Picture Identification Inc. o/a WebPicID.<br>

Give the funds and the deposit slip to the teller.<br>

Get a receipt.</p>
<h3>How to report a payment. </h3>


<p>Print your Deposit code on a blank spot on the receipt.<br>

Take a picture of the receipt.<br>

Log on to WWW.WebPicID.com<br>

Select Secure Message<br>

Create an email to USBank@WebPicID.com</p>


<h3>Enter the following information:</h3>

<p>In the subject line The amount The bank<br>

In the body Your Name<br>


Attach the picture of the receipt.</p>

<h3>Press Send </h3>
			</div>
			<!-- <div class="col-sm-12">
				<p> All are made in paper cash<br>
					Members can deposit any amount in paper currency at a teller.<br>
					The deposits are credited to the account of:<br>
					Web Picture Identification Inc. o/a WebPicID.<br>
				Deposits can be made at an branch of:</p>
				<h3>Bank of America</h3>
				Routing Number: 021000322
				Account Number: 483078986375
				<h3>TDBank</h3>
				Routing number: 026013673
				Account Number: 4352458412
				<h3>Wells Fargo</h3>
				Routing Number: 026012881
				Account Number: 2180028074
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
					A list of the routing and account number is below:<br>
					All deposites are made into the:<br>
				Web Picture Identification Inc. account.</p><br><br>
			</div> -->
		</div>
	</div>
</section>