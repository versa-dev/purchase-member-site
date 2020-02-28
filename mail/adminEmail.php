<?php
use yii\helpers\Html;
$resetLink = 'http://ds08.projectstatus.co.uk/huntercollectornew/web/site/login';
?>
<div>
Hello ,

 <?= Html::encode($name) ?>,
 </div>
</br></br>
<div>
This is to inform you that you have been successfully added to Hunter Investor and own an account for your future proceedings.
Registration Details:
</div>
<div>
Username: <?= Html::encode($user->username) ?>
</div>
<div>
	

 Password: <?= Html::encode($password) ?>
 </div>
 <div>
<?=$resetLink ?>
</div>