<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Terms and Conditions';
$model = \app\models\UserProfile::findProfileByUserId(Yii::$app->user->id);
$name=$model->first_name." ".$model->last_name;
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
	

<h2>Act as an Agent for WebPicID</h2>


Any one 18+ years old can Act as an Agent for WebPicID.<br>

The Agent views the Identification Document and Agent Affirmation page.<br>

The Agent views the original Identification Documents.<br>

The Agent provides their Name and Email address.<br>

The Agent agrees to the WebPicID Terms and Conditions and Privacy Policy.<br>

The Agent affirms that the information on the Identification Document and Agent Affirmation page matches the original identification documents.<br>

This concludes the Act of Agency.<br>

The Agent is sent an email to verify their email addess.<br>

Agent WebPicID accounts are credited with the Agency fee.<br>

Agents under 18 can only become Members via Family Protection.<br>
		</div>
	</div>
</div>