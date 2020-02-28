<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Welcome message';
$model = \app\models\AgentIdentification::findOne(Yii::$app->params['id']);
$name=$model->first_name_agent." ".$model->last_name_agent;
header( "refresh:5;url=http://ariseit.com/demo/web/dashboard/welcome" );
?>
<div class="row">
<div class="col-sm-12"><p>
After I affirm




<b>Thank you <?php echo $name;?>. Your Act of Agency is complete"</b>


Please read the email we sent you and confirm your email address and logon to WebPicID.com

</div>
</div> 