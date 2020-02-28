<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Welcome message';
$model = \app\models\UserProfile::findProfileByUserId(Yii::$app->user->id);
//gc 20200211
//$dateOfBirth = $model->date_of_birth;
$dateOfBirth = $model['date_of_birth'];
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$age=$diff->format('%y');
$name=$model->first_name;
$paycode=$model->pay_code;
if (Yii::$app->getSession()->hasFlash('warning'))
{
    ?>
    <script>
        alert("<?php echo Yii::$app->getSession()->getFlash('warning'); ?>")
    </script>
    <?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="container">
<!-- 	<ul  class="nav nav-pills">
		<li class="active">
			<a  href="#1a" data-toggle="tab">Home</a>
		</li>
		<li><a href="#2a" data-toggle="tab">About Us</a>
	</li>
	<li><a href="#3a" data-toggle="tab">How It Works</a>
</li>
<li><a href="#4a" data-toggle="tab">Member Services</a>
</li>
<li><a href="#5a" data-toggle="tab">Merchant Services</a>
</li>
</ul> -->
<div class="tab-content clearfix">
<div class="tab-pane active" id="1a">
<div class="row">
<div class="col-sm-12"><p>
	<b>Welcome <?php echo $name;?></b>
	<p></p>
    <b>Your pay_code is: <?php echo $paycode;?></b>

	<br><br>
	You have Secure Messages from WebPicID<br>
	<!-- We have sent you an email to verify your email address.<br><br>
	Please verify you email address<br><br>
	An invoice for the membership has been sent to your Secure Message INBOX.<br><br> -->
</p></div>
<!-- <div class="col-sm-6"><b>Member Services</b> </div>
<div class="col-sm-6"><b>Member Utilities</b></div>
<div class="col-sm-6">Act of Agency<br>Family Protection<br>Identity Theft Fraud Loss Reduction<br>Identity Theft Recovery Checklist<br>Merchant Sign Up<br>Safe Purchase<br>Secure Message
</div>
<div class="col-sm-6">Make a deposit<br>Pre Register<br>Refer a Merchant<br>Share a Merchant on Social Media</div> -->
<div class="col-sm-6">
	<h3>Services</h3>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('message'); ?>">Secure Message</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/create-safe-purchase'); ?>">Safe Purchase</a><br>

<!--<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-add'); ?>">Family Protection</a><br>-->
<!--    changed by GP-->

    <a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-add'); ?>">Family Protection</a><br>
    
    

<!--    Modal::begin([-->
<!--        'header' => '<h2>Warning!</h2>',-->
<!--        'toggleButton' => ['tag' => 'a', 'label' => 'Family Protection', ],-->
<!--    ]);-->
<!---->
<!--    echo 'You are not verified.';-->
<!---->
<!--    Modal::end();-->
<!--    ?>-->

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option'); ?>">Payment options</a><br>
<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/account-statement'); ?>">Account Statement</a><br>



<h3>Opportunities </h3>

<!-- Act as an Agent [link] -->
<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/act-of-agent'); ?>">Act as an Agent (18+ years of age)</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/refer-an-organization'); ?>">Refer an organization</a><br>


<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/share-an-organization'); ?>">Share WebPicID with an organization</a><br>

  <!--  <a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/verify-caller'); ?>">Verify Caller ID</a><br> -->
 <!--   <a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/report-payment'); ?>">Report A Payment</a><br>-->

    <h3>Utilities </h3>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/pre-registration'); ?>">Pre Registration</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-signup'); ?>">Merchant Sign Up</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/notification'); ?>">Notification</a><br>

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/profile'); ?>">Profile</a><br>

<br><br><br><br><br>

<!-- Statement of Account [link] -->
</div>
</div>

</div>
<!-- <div class="tab-pane" id="2a">
<div class="row">
<div class="col-sm-12">
	<div itemprop="articleBody">
		<h2><strong>About Us</strong></h2>
		<p>Web Picture Identification Inc. o/a WebPicID was incorporated in Alberta, Canada in February 2008.</p>
		<p>In July of 2007 the founder, Raymond Grace, met a woman who had been shopping at Macy's.&nbsp;</p>
		<p>Her friends noticed that she was bleeding from a deep cut in her arm.</p>
		<p>They went to the hospital and stitched her up.</p>
		<p>When it came time to pay she could not find her purse.</p>
		<p>It had been cut from her arm in the store.</p>
		<p>Her credit cards we maxed out.</p>
		<p>We do not pretend to be able to stop identity theft.</p>
		<p>We can reduce some of the losses.</p>
		<h2><strong>Mission Statement</strong></h2>
		<p>Reduce identity theft fraud losses by identifying possible frauds before a loss to either party.</p>
		<p>Make the internet an easier and safer place for individuals to use securely.</p>
		<p>Send email type messages that only the recipient can read.</p>
		<p>Protect children online.</p>
		<p>Individuals regardless of age can buy goods and services online with cash.&nbsp;</p>
		<p>Individuals are notified 24/7 when their identity is used at a WebPicID Merchant.</p>
		<p></p>
		<p></p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p></p>
		<p class="western" style="margin-top: 0.32cm; margin-bottom: 0.32cm; font-variant: normal; letter-spacing: normal; font-style: normal; font-weight: normal; line-height: 0.53cm; orphans: 2; widows: 2;">&nbsp;</p>	</div>
	</div>
</div>
<div class="row">
<div class="col-sm-12">

</div>
</div>
</div> -->
<div class="tab-pane" id="3a">
<div class="row">
	<div class="col-sm-12">
<!-- 		<div itemprop="articleBody">
			<h2>How does it Works 1</h2>
			<div></div>
			<h2>Act of Agency&nbsp;</h2>
			<div></div>
			<div>The Act of Agency is limited to the Agent:</div>
			<div>Providing their name and email address.</div>
			<div>Agreeing to the WebPicID Terms and Conditions and the Privacy Policy.</div>
			<div>Looking at the individual’s three pieces of identification and the information entered in the Identification Document and Agent Affirmation Page.</div>
			<div>Verifying a New Member's identity by pressing the I AFFIRM button.</div>
			<p>Closing the page without pressing the I AFFIRM button ends the Act of Agency incomplete.</p>
			<div>The pressing of the I AFFIRM button concludes the Act of Agency.</div>
			<div>&nbsp;&nbsp;</div>
			<div>Agents are sent an email asking them to verify their email address.</div>
			<div>The email advises the Agent to Log On to WebPicID to verify their identity.</div>
			<div>Agents are paid a fee for Acting as an Agent once they verify their identity.</div>
			<div>Anyone 13+ years old can act as an Agent for WebPicID.</div>
			<div>Individuals under 18 years old can only become a Member via the Family Protection service.</div>
			<div>An adult Member must activate the Family Protection and agree to act as the AGP for all family members.
				<p>The AGP Administrator/Parent/Guardian must select Family Protection and add the child as a Member.</p>
				<p><span style="color: inherit; font-family: inherit; font-size: 22px;">Administrator Guardian Parent herein AGP&nbsp;</span></p>
			</div>
			<div>Members using the Family Protection Section act as the Administrator Parent Guardian, APG, for the family.&nbsp;</div>
			<div>The AGP can add a second AGP.
				<p>Any AGP can authorise a spending limit for any child over age 5 by transferring funcs to the child's account.</p>
				<h2>Deposit Code&nbsp;</h2>
			</div>
			<div>Every Member is given a Deposit Code when they Sign Up.&nbsp;</div>
			<div>WebPicID only accepts cash deposits starting at a minimum of $30.00.
				<p>Payment are made in cash at any bank branch that WebPicID has an account.&nbsp;</p>
			</div>
			<div>Member use the Deposit Code to identify their deposits when they report them to&nbsp; WebPicID .&nbsp;</div>
			<h2>Family Protection&nbsp;</h2>
			<div>A family is defined as at least one adult and one other individual living at the same residence.&nbsp;</div>
			<div>Members can add everyone in the family regardless of their age from 1 day plus.&nbsp;</div>
			<p>AGP's can add an additional AGP.</p>
			<p>Children age 13+ can Act as Agents for WebPicID with APG approval.</p>
			<p>Children age 5+ can use Safe Purchase to ask WebPicID.</p>
			<p>All items purchased by a child via WebPicID are shipped to the AGP.</p>
			<div><span style="color: inherit; font-family: inherit; font-size: 22px;">How to make a deposit</span></div>
			<div>WebPicID has an account at the following bank branches</div>
			<div>&nbsp;</div>
			<div><span style="color: inherit; font-family: inherit; font-size: 18px;">United States of America</span></div>
			<div></div>
			<p>Bank of America&nbsp; &nbsp; &nbsp;Cash Only</p>
			<p>TDBank&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Cash Only</p>
			<div>Wells Fargo&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Cash Only</div>
			<p>&nbsp;</p>
			<h3>Canada</h3>
			<p>TD Canada Trust&nbsp; &nbsp; &nbsp;Cash Only</p>
			<p>Bank of Montreal&nbsp; &nbsp; Cash Only</p>
			<p>EMT</p>
			<p>From all Canadian Banks</p>
			<p>Bill Payment</p>
			<p>Bank of Montreal&nbsp;</p>
			<h2>Identity Theft Fraud Loss Reduction&nbsp;</h2>
			<div>Individuals are sent a Notification 24/7 by email from WebPicID every time their identity is used at a WebPicID Merchant.</div>
			<div>WebPicID Merchants advise individuals that they protect them from Identity Theft Fraud Losses by having WebPicID.com verify their identity.</div>
			<div>The individual is asked to log on to WebPicID, verify their identity, and respond to the the Notification.</div>
			<div></div>
			<div>The second way Members can protect against Identity theft fraud losses is to have WebPicID make online purchases for them using Safe Purchase.</div>
			<div></div>
			<p><span style="color: inherit; font-family: inherit; font-size: 22px;">Member Sign Up process</span></p>
			<p>Any individual regardless of age can become a Member and use the WebPicID services.</p>
			<p>Individuals sign up to become a Member and pay $25.00 annually to use the services.</p>
			<h3>Process</h3>
			<h3>Register Page</h3>
			<p>&nbsp; &nbsp; &nbsp;First name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Last name</p>
			<p>&nbsp; &nbsp; &nbsp;Email address&nbsp; &nbsp; &nbsp; &nbsp;Country</p>
			<p>&nbsp; &nbsp; &nbsp;Street address&nbsp; &nbsp; &nbsp;CIty</p>
			<p>&nbsp; &nbsp; &nbsp;State/Provicne&nbsp; &nbsp; &nbsp;ZIP/PostalCode&nbsp;</p>
			<p>&nbsp; &nbsp; &nbsp;Home Number&nbsp; &nbsp;&nbsp;Cell Phone Number</p>
			<p>&nbsp; &nbsp; &nbsp;Age&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sex</p>
			<p>&nbsp; &nbsp; &nbsp;_ I Agree to the WebPicID Terms and Conditions and Privacy Policy</p>
			<p>&nbsp; &nbsp; &nbsp;Please activate you Web Camera and Microphone</p>
			<h3>Picture Page</h3>
			<p>&nbsp; &nbsp; &nbsp;Take a picture</p>
			<h3>Identification Document and Agent Affirmation page</h3>
			<p>&nbsp; &nbsp; &nbsp;Individuals who want to become Members need to provide 4 things;&nbsp;</p>
			<p>&nbsp; &nbsp; &nbsp;Three piceces of identification</p>
			<p>&nbsp; &nbsp; &nbsp;1 Primary government issued Picture Idenitfication I.E. Drivers license, passport, or other picture ID.&nbsp;</p>
			<p>&nbsp; &nbsp; &nbsp;2 Secondary government issued Idenitfication I.E. Birth certificate or unused Primary ID</p>
			<p>&nbsp; &nbsp; &nbsp;3 Address Identification&nbsp; I.E any Utility bill or staement of account dates in the last 20 days.</p>
			<p>&nbsp; &nbsp; &nbsp;4 A&nbsp;witness who is at least 13 years old. The witness is paid a fee to Act as an Agent for WebPicID.</p>
			<h2 style="margin-bottom: 0cm; line-height: 100%;">Member Sign Up process</h2>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Any individual regardless of age can become a Member and use the WebPicID services.</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Individuals sign up to become a Member and pay $25.00 annually to use the services.</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;individuals who want to become Members need to provide 4 things;&nbsp; &nbsp; &nbsp; &nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Three pieces of identification</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;1 Primary government issued Picture Identification I.E. Drivers license, passport, or other.</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;2 Secondary government issued Identification I.E. Birth certificate or unused Primary ID</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;3 Address Identification&nbsp; I.E any Utility bill or statement of account dates in the last 20 days.</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;4 A&nbsp;witness who is at least 13 years old. The witness is paid a fee to Act as an Agent for WebPicID.</p>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Process</h3>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Register Page</h3>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp; First name&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Last name</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Email address&nbsp; &nbsp; &nbsp;Country</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Street address</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; City&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; State/Provicne ZIP/PostalCode</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Home Number&nbsp; &nbsp;Cell Phone Number</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp;Age&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sex</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">_</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">I Agree to the WebPicID Terms and Conditions and Privacy Policy</p>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">Please activate you Web Camera and Microphone</p>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Picture Page</h3>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Take a picture</p>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Identification Document and Agent Affirmation page</h3>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Primary Identification Document</h3>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Date Issued&nbsp; &nbsp; &nbsp; &nbsp;Date Expired</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Serial Number&nbsp; Type Type</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Issuing Body</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Secondary Identification Document</h3>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Unused Primary ID</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;or a Birth Certificate (Required for children)</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Date Issued&nbsp; &nbsp; &nbsp; &nbsp;Date Expired</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Serial Number Type</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Issuing Body</p>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Address Identification Document&nbsp; &nbsp; &nbsp;Utility bill or Statement of account dated in the last 30 days,</h3>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;Name of Issuing Body&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Serial/Account number</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Address of issuing body&nbsp; &nbsp; &nbsp; &nbsp;Phone number of issuing body</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; Name of Member Matches Address of Member matches</p>
			<p>&nbsp;</p>
			<h3 style="margin-bottom: 0cm; line-height: 100%;">Agent Section</h3>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp; Agent First Name&nbsp; &nbsp; &nbsp; Agent Last Name&nbsp; &nbsp; &nbsp; Agent Email address</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp; _ I Agree to the WebPicID Terms and Conditions and Privacy Policy</p>
			<p>&nbsp;</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;I, First Name Last Name, email address, hereby Affirm that</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;the information on the original identification documents</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;and the information entered into the Identification Document and Agent Affirmation page match,</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;I AFFIRM</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;This completes your Act of Agency.</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;An email has been sent to you to verify your email address</p>
			<p style="margin-bottom: 0cm; line-height: 100%;">&nbsp; &nbsp; &nbsp;and with instruction on how to continue.</p>
			<p>&nbsp;</p>
			<h2>Merchant Sign Up&nbsp;</h2>
			<div>Any authorized employee can sign up their organization by:
				<p>The employee agrees to Act as the Administrator and contact person for WebPicID.</p>
				<p>A&nbsp; &nbsp; &nbsp;Completing the Merchant Sign Up form</p>
				<p>B&nbsp; &nbsp; &nbsp;Signing Up with WebPicID</p>
				<p>C&nbsp; &nbsp; &nbsp;Verifying their identity</p>
				<p>Please review the Documents and Information required for most organizations.</p>
				<div>
					<p>The Board of Directors must ratify the&nbsp;Administrator's&nbsp;position and ability to act for the organization.</p>
					<p>The Board of Directors, Officers of the organizaton, and employees using WebPicID services must beceome MEM's.</p>
					<p>MEM's Sign Up and verify their identity The Administrator sets their access level.</p>
				</div>
			</div>
			<h2>Notification&nbsp;</h2>
			<div>A "Notification" is sent 24/7 to individuals when their identity has been used at a WebPicID Merchant for a sale or transaction.&nbsp;</div>
			<div></div>
			<div>The recipient of a Notification has four choices:&nbsp;</div>
			<div></div>
			<div>Authorize&nbsp; &nbsp; &nbsp;&nbsp;<span style="white-space: pre;"> </span>The individual verifies their identity with WebPicID and Authorizes the sale or Transaction.&nbsp;</div>
			<div><span style="white-space: pre;"></span></div>
			<div>Decline&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style="white-space: pre;"> </span>The individual verifies their identity with WebPicID and Declined the sale.&nbsp;</div>
			<div><span style="white-space: pre;"> </span>Ignore&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;The individual missed or ignored the Notification.&nbsp;</div>
			<div><span style="white-space: pre;"> </span>Fraud&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;The individual verifies their identity with WebPicID and declares a Fraud.&nbsp;</div>
			<div><span style="white-space: pre;"> </span>
			<div>
				<p>The goods, services, or transaction is not released by the Merchant until WebPicID sends the Authorise code to the Merchant.</p>
				<p>In all cases there is no fraud loss to either party.</p>
				<h2>Payment Options&nbsp;</h2>
			</div>
		</div>
		<div>Deposit cash only</div>
		<div>
			<p>The minimum deposit is $30.00 any of the bank branches that WebPicID deals with.</p>
		</div>
		<div>USA&nbsp; &nbsp; &nbsp;Bank of America&nbsp;</div>
		<div>USA&nbsp; &nbsp; &nbsp;TDBank&nbsp;</div>
		<div>USA&nbsp; &nbsp; &nbsp;Wells Fargo&nbsp;</div>
		<div>&nbsp;</div>
		<div>Canada&nbsp; Bank of Montreal</div>
		<div>Canada&nbsp; TD Canada Trust</div>
		<div>&nbsp;</div>
		<p>Canada&nbsp; EMT from any Canadian bank</p>
		<p>Canada&nbsp; Bank of Montreal Bill Payment</p>
		<h2>Pre-Register</h2>
		<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sign Up and provide everything including ID except a witness or payment.</div>
		<h2>Refer an organization</h2>
		<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Register and organization.</div>
		<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Sell them on WebPicID.</div>
		<div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Have them name you as their contact person.&nbsp; &nbsp;&nbsp;</div>
		<h2>Report a Deposit</h2>
		<div>Members need to report deposits as soon as they are made to ensure prompt credit.</div>
		<p>Once you have a Receipt of a Deposit from a bank.</p>
		<p>Take a picture with your phone</p>
		<p>Write your deposit code on the receipt in a blank spot.</p>
		<p>Take a picture of the receipt that shows the all of the details printed on the receipt.&nbsp;</p>
		<p>Log on to WebPicID va the phone</p>
		<p>Select Report a Payment</p>
		<p>Enter the amount&nbsp; &nbsp; &nbsp;Select the bank&nbsp; &nbsp; &nbsp;&nbsp;Attach the picture of the receipt file.</p>
		<p>Look at everything on the screen.&nbsp;</p>
		<p>If the picture is blurry, take another clear picture that is readable.</p>
		<p>Replace the blurry picture with the new Picture.</p>
		<p>Look at everything on the screen.</p>
		<p>If it is all clear press SUBMIT</p>
		<h2>Safe Purchase&nbsp;</h2>
		<p>This is a non bank card way to have WebPicID make online purchases for Members and their families</p>
		<p>Find an item or items that you want to buy.</p>
		<p>Take a screen shot of each item and save the pictures where you get them later.</p>
		<h4>TIP Use a new directory for each purchase</h4>
		<p>Go through the sale process to the shopping cart where the totals including tax and shipping are displayed.</p>
		<p>Take a screen shot of shopping card page.</p>
		<p>Go to the top of the page and copy the URL of the site selling the items.</p>
		<p>Paste the information into Site URL</p>
		<p>Paste each item into a box by pressing the + sign for another box until every item is listed.</p>
		<p>Enter the total amont of the sale. These funds must be on deposit before WebPicID can make the purchase.</p>
		<p>The APG can set an amount for a child to spend. WebPicID will make the purchase and debit the APG account.</p>
		<p>The Amount can by set to reoocur from time to time for each child.</p>
		<p>* AGP can look at suggested plans for allowance spending and amounts and frequency. Teach you children to save, donate ,and spend.</p>
		<p><span style="color: inherit; font-family: inherit; font-size: 22px;">Secure Message&nbsp;</span></p>
		<p>A Secure Message can be sent to anyone.</p>
		<p>Only a Member can send a Secure Message</p>
		<p>Secure message ae only sent to one Recipient.</p>
		<p>Only the Sender and the Recipient can read the Secure Message.</p>
		<p>The Process:</p>
		<p>Go to Secure Message</p>
		<p>Select create a Message</p>
		<p>Enter the name and email address of the Recipient.</p>
		<p>Then Subject, body, and attachment(s).</p>
		<p>Press send</p>
		<p>The message contents are sent to an In Box for the Recipient on the&nbsp;WebPicID&nbsp;site.</p>
		<p>They never leave the secure WebPicID Server.</p>
		<p>The onus is on the sender to notify the recipient that they have a Secure Message.</p>
		<p>Call, text, email, social media, let them know that they have a secure Message at www.WebPicID.com&nbsp;</p>
		<p>The Recipient must Log on to WebPicID and verify their identity before they can read the Secure Message.</p>
		<p>This universal service can be used by individuals and organizations.</p>
		<p><span style="color: inherit; font-family: inherit; font-size: 22px;">Share an organization&nbsp;</span></p>
		<p>We use social media to generate Merchant Members.</p>
		<p>Share the WebPicID service any number of organizations daily.</p>
		<p>Members receive one poll entry per day until the organization becomes a Merchant Member.&nbsp;</p>
		<p>The pool is closed, the members with pool entries receive a share of 10% of the ID Theft Fraud Loss Reduction Revenue for 5 years.</p>
	<h2>&nbsp;</h2>	</div> -->
</div>
</div>

</div>
<div class="tab-pane" id="4a">
<div class="row">
<div class="col-sm-12">
	<!-- <div itemprop="articleBody">
		<h2>Member Services</h2>
		<h3><br><a href="/webpicid/index.php/member-services?id=42">Act as an Agent&nbsp;</a>&nbsp;for WebPicID&nbsp; &nbsp;</h3>
		<p>Make money working for WebPicid as an Agent.<span style="white-space: pre;"> </span>&nbsp;</p>
		<h3><a href="/webpicid/index.php/member-services?id=83">Family Protection</a></h3>
		<p>Protect your children and family.<span style="white-space: pre;"> </span>&nbsp;Identity Theft Fraud Loss reduction<br>Let your children make online purchase with Safe Purchase.</p>
		<h3><a href="/webpicid/index.php/member-services?id=74">Organization sign Up as a WebPicID Merchant</a></h3>
		<p>Reduce Identity Theft Fraud losses and associated operating costs.</p>
		<h3><a href="/webpicid/index.php/member-services?id=82">Payment options and reporting</a></h3>
		<p>All payments are made at a bank in cash.&nbsp; &nbsp; &nbsp;</p>
		<p>&nbsp;Members are responsible for bank fees charged for deposits.</p>
		<h3><a href="/webpicid/index.php/member-services?id=74">Refer an organization&nbsp; </a>&nbsp; &nbsp; Make Money working for WebPicID</h3>
		<p>Any Member who refers an organization to sign up with WebPicID is paid a fee.<span style="white-space: pre;"> </span></p>
		<p>The Merchant must acknowledge the Member as the person that referred them to WebPicID.<span style="white-space: pre;"> </span>&nbsp;</p>
		<h3><a href="/webpicid/index.php/member-services?id=53">Safe Purchase</a></h3>
		<p>This is a non bank card way to make and online cash payment for goods and services.</p>
		<p>Members find something that they want to buy and ask WebPicID to make the purchase.</p>
		<p>Members who sign up their children as Members via Family PRotection can set speding amounts for all children5+ years of age.</p>
		<p>All items purchase via Safe Purchase for chidren are shipped to the Parent/Guardian.&nbsp;&nbsp;</p>
		<h3><a href="/webpicid/index.php/member-services?id=85">Secure Message</a></h3>
		<p>This service allows Members to send anyone a message that can only be read by the Sender and the Recipient.</p>
		<p>The Recipient must log on to WebPicid and verify their identity before they can read the Secure Message.</p>
		<h3><a href="/webpicid/index.php/member-services?id=86">Share WebPicID with an organization</a></h3>
		<p>Members can share WebPicID with any number of organization daily.</p>
		<p>Report the share in a Secure Message to WebPicID with a picture of the organization getting the share attached.</p>
		<p>Each share goes into a pool for 10% of the identity theft fraud loss reduction fees.</p>
		<p>Pool entries are closed once the organization signs up with WebPicID.</p>
		<p>Once revenue is generated from loss reduction fees there is a draw from the pool for winners of the pool at least annually.</p>
		<p>The bigger the revene pool in the more winners and the frequency of draws.</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<h3></h3>	</div> -->
</div>
</div>

</div>
<div class="tab-pane" id="5a">
<div class="row">
<div class="col-sm-12">
	<!-- <div itemprop="articleBody">
		<h2><strong>Merchant Services</strong></h2>
		<h3><br><strong>Identity Theft Fraud Loss Reduction</strong></h3>
		<h3><strong style="color: inherit; font-family: inherit; font-size: 22px;">How does it work?</strong></h3>
		<p>WebPicID estimates that it can&nbsp; stop at least 50% of your identity theft fraud losses.</p>
		<p>The Merchant:&nbsp;</p>
		<p>Makes a sale</p>
		<p>Takes the payment</p>
		<p>Gets the payment authorization code</p>
		<p>The Merchant advises the Buyer:</p>
		<p>“We protect you from identity theft fraud losses by having you verify your identity at Web Picture Identification Inc.”&nbsp;&nbsp;</p>
		<p>The goods or services are not shipped until WebPicID confirms your ID and Authorization.</p>
		<p>Please go to www.WebPicID.com, verify your identity, and Authorize the sale.</p>
		<p>There are only three responses to this request when the Buyer logs on an verifies theri identitiy.</p>
		<p><strong>1.<span style="white-space: pre;"> </span>Authorized<span style="white-space: pre;"> </span></strong></p>
		<p><strong>2.<span style="white-space: pre;"> </span>Declined</strong></p>
		<p><strong>3.<span style="white-space: pre;"> </span>Fraud</strong></p>
		<p>In these 3 cases there is no fraud loss to the Merchant or the Buyer.</p>
		<p>&nbsp;<strong>4. Ignored</strong></p>
		<p>In the last case the buyer ignores the request and does not verify their identitiy. The Merchant has the goods and the funds.</p>
		<p>Eventually the Buyer will log on to webpicd and verify their idetity or somone will claim a fraud.</p>
		<p><strong>There is still no fraud loss to either party.</strong></p>
		<p><strong>Fraud Victim Contact Cost Calculation</strong></p>
		<p>Fraud victims spend 300 hours to resolve a fraud.2% of that time is spent talking to the vendor 6 hours at $10.00/hour.</p>
		<p><strong>Other WebPicID benefits</strong></p>
		<p>New Consumer Markets&nbsp;</p>
		<p>New Vendor Markets<span style="white-space: pre;"> </span></p>
		<p><span style="white-space: pre;">S</span>ecure Message&nbsp; Messages can be sent that can only be read by the recipient. Both parties verify their identities.</p>
		<p>Micro Purchase</p>
		<p>PPR Permanent Paperless Receipts and automatic rewards card processing.</p>
		<p>&nbsp;</p>	</div> -->
	</div>
</div>

</div>
</div>
</div>

<?php

?>
