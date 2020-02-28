<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'About us';
$model = \app\models\UserProfile::findProfileByUserId(Yii::$app->user->id);
$name=$model->first_name." ".$model->last_name;
?>
<div class="container">
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
</div>
		</div>
	</div>
</div>