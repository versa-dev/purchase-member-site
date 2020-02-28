
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Merchant Services';
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
		<h1><strong>Merchant Services</strong></h1><br>
		<h2><strong>Identity Theft Fraud Loss Reduction</strong></h2>
		<p></p>
<p>We only offer one service to Merchants.</p>
We can reduce your identity theft fraud losses and related costs by 50 to 90 %.</p><p>
<p>Identity Theft Fraud Loss Reduction</p>
<p>We only offer one service to Merchants.</p>
<p>We can reduce your identity theft fraud losses and related costs by 50 to 90 %.<p></p>
<p></p>
<h3>How do we do it?</h3>
<p></p>
We test for a fraud in the time between taking the payment and shipping the goods.</p><p>
The Merchant sends the Buyer a message on their screen:
"Our organization protects you from identity theft fraud losses.</p><p>
by having WebPicID.com verify your identity.</p><p>"
"The goods an services will not be shipped until you verify your identity and authorize the sale.</p><p>"
The Merchant sends WebPicID the sale details.</p><p>
The sale details are the sale number, the amount, the buyer name, address, and email address.</p><p>
WebPicID sends the Buyer a Notification.</p><p>
“Your identity has been used at a WebPicID Merchant.</p><p>”
“Log on to WebPicID, verify your identity, and Authorize the sale.</p><p>”
There are only 4 possible responses to a Notification.</p><p>
Authorized:	The Buyer verified their identity and authorized the sale.</p><p> The goods are shipped.</p><p>
Declined: 	The Buyer verified their identity and declined the sale.</p><p> The payment is canceled.</p><p>
Fraud:		The Buyer verified their identity and Fraud-ed the sale.</p><p> The payment is canceled.</p><p>
Ignored:	The Buyer ignored the Notification.</p><p> The Merchant has  the money and the goods.</p><p>
	    	There is no fraud loss for either party regardless of the response.</p><p>
Fraud 		WebPicID send the Member and the Merchant a Fraud Report.</p><p>
Ignored	    The Merchant can send an email to the Buyer asking for a response.</p><p>
		    If no response after 3 days, cancel the sale, advise Buyer, and the Financial institution.</p><p>
<p></p>
<h3>How does WebPicID calculate identity theft fraud losses and cost reductions?</h3><p></p>
<h4>Assumptions</h4>
<p>Fraud rate 2% of sales, Average sale $50.00, 400 frauds per million dollars in sales.</p>
<p>Two percent of 1 million is $20,000.00 in fraud losses.</p>
<p>FVCC Fraud Victim contact costs are $90.00 a fraud for $36,000.00.</p>
<p>Your total fraud losses are $56,000.00 per million for a fraud cost rate is 5.6%.</p>
<p></p>
<h3>FVCC Fraud victim contact costs</h3>
<p></p>
<p>In 2018, 12 million Americans reported and ID Theft Fraud loss.</p>
<p>Six million victims lost an average of $6,000.00.</p>
<p>the victims spend an average of 300 hours trying to fix the fraud.</p>
<p></p>
<p>Two percent of 300 is 6 hours of CSR time at $15.00 an hour.</p>
<p>FVCC Fraud Victim Contact Costs for a Vendor is $90.00 a fraud. 400 frauds costs $36,000.00</p>
<p></p>
<p>WebPicID can reduce FVCC operating costs by $18,000.00</p>
<P></P>
<h5>NOI increase is $25,000.00 per million in sales.</h5>

<h3>Identity Theft Fraud Loss Reduction process for a Merchant</h3>
<p></p>
<h4>Process the sale including taking payment.</h4><p> 
<p></p>
<h5>Tell the Buyer:</h5>
<p></p><p>
"We use WebPicID to verify your identity to protect you from ID Theft Losses.</p><p>
"Please to go to WebPicID.com and verify your identity.</p><p>
"The goods or services are not until WebPicID Authorizes the sale."</p><p>

Authorized   The Buyer verified their identity and Authorized the sale.</p><p>
Declined      The Buyer verified their identity and Declined the sale.</p><p>
Fraud           The Buyer verified their identity and authorized the sale.</p><p>
                     The sale is canceled.</p><p>
                     WebPicID sends a Fraud Report to the Buyer and the Merchant.</p><p>
Ignored       Nothing happens until the buyer verifies their identity.</p>

<h4>There is no fraud loss to either party regardless of the response.</h4>
<h3>New markets</h3>

<p>The 50 million dependents between age 5 and 18</p>
<p>The 50 Million individuals who are afraid to use a Bank card on line.</p>
<p>New vendors selling Micro cost items or virtual items starting at $0.01</p> 
<p>Save $0.23 on online purchases under $5.00.</p>
<p></p>
<p>Additional services available to Members</p>
<p></p>
<h3>Secure Message</h3>
<p></p>
This is an internet message service that only the sender and recipient can read the message and attachments.</p><p>  
Employees can communicate to anyone and know that their identity has been verified by WebPicID.</p><p></p>
<h3>Verified Caller ID VCID</h3>
<p></p>
Merchant employee send a potential contact a VCID via Secure Message before calling.</p><p>
Once they are speaking to the person, they can verify their identity using WebPicID.</p><p>
The VCID has a handshake process.</p><p>
The VCID has a challenge word that the caller can give to the person calling them.</p><p>
They enter it onto the challenge word verification form for it to say Verified.</p><p>
It sends the other party a counter challenge word to enter at WebPicID and get it verified.</p><p>


			</div><br><br><br>
		</div>
	</div>
</div>