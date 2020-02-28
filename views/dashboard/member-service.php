
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Member Services ';
$model = \app\models\UserProfile::findProfileByUserId(Yii::$app->user->id);
$name=$model->first_name." ".$model->last_name;

            if (Yii::$app->getSession()->hasFlash('warning'))
            {
                ?>
                <script>
                    alert("<?php echo Yii::$app->getSession()->getFlash('warning'); ?>")
                </script>
                <?php
            }
?>
<div class="container">
	<div class="row">
		<div itemprop="articleBody">
		<h2>Member Services</h2>
		<h3><br><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/act-of-agent'); ?>">Act as an Agent&nbsp;</a>&nbsp;for WebPicID&nbsp; &nbsp;</h3>
		<p>Make money working for WebPicid as an Agent.<span style="white-space: pre;"> </span>&nbsp;</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-add'); ?>">Family Protection</a></h3>
		
		<p>Protect your depedents and family members.<span style="white-space: pre;"> 
		<p>Transfer funds to your dependents by sending A Secure Message to ACT@Wpid.ca.</br>
		<br> Please name the dependent and advise the amount to be transfderred to the dependent andif it was to repeated regularly.</p>
		</span>&nbsp;Identity Theft Fraud Loss reduction<br>Let your dependents make online purchase with Safe Purchase.</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-signup'); ?>">Organization sign Up as a WebPicID Merchant</a></h3>
		<p>Reduce Identity Theft Fraud losses and associated operating costs.</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/payment-option'); ?>">Payment options and reporting</a></h3>
		<p>All payments are made at a bank in cash.&nbsp; &nbsp; &nbsp;</p>
		<p>&nbsp;Members are responsible for bank fees charged for deposits.</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/refer-an-organization'); ?>">Refer an organization&nbsp; </a>&nbsp; &nbsp; Make Money working for WebPicID</h3>
		<p>Any Member who refers an organization to sign up with WebPicID is paid a fee.<span style="white-space: pre;"> </span></p>
		<p>The Merchant must acknowledge the Member as the person that referred them to WebPicID.<span style="white-space: pre;"> </span>&nbsp;</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/create-safe-purchase'); ?>">Safe Purchase</a></h3>
		<p>This is a non bank card way to make and online cash payment for goods and services.</p>
		<p>Members find something that they want to buy and ask WebPicID to make the purchase.</p>
		<p>Members who sign up their children as Members via Family PRotection can set speding amounts for all children5+ years of age.</p>
		<p>All items purchase via Safe Purchase for chidren are shipped to the Parent/Guardian.&nbsp;&nbsp;</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('message'); ?>">Secure Message</a></h3>
		<p>This service allows Members to send anyone a message that can only be read by the Sender and the Recipient.</p>
		<p>The Recipient must log on to WebPicid and verify their identity before they can read the Secure Message.</p>
		<h3><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/share-an-organization'); ?>">Share WebPicID with an organization</a></h3>
		<p>Members can share WebPicID with any number of organization daily.</p>
		<p>Report the share in a Secure Message to WebPicID with a picture of the organization getting the share attached.</p>
		<p>Each share goes into a pool for 10% of the identity theft fraud loss reduction fees.</p>
		<p>Pool entries are closed once the organization signs up with WebPicID.</p>
		<p>Once revenue is generated from loss reduction fees there is a draw from the pool for winners of the pool at least annually.</p>
		<p>The bigger the revene pool in the more winners and the frequency of draws.</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	<h3></h3>	</div>
		</div>
</div>
