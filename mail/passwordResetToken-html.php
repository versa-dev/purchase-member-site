    <?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$icon='http://ds08.projectstatus.co.uk/vuportal/web/themes/vuportal/files/images/';
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Vuportal Newsletter  ::</title>
</head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
  margin: 0;
  padding: 0;
}
</style>
<body>
<table width="640" align="center" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td><a href="#"><img src="<?php echo $icon; ?>logo-news.jpg" alt="" style="width:100%" /></a></td>
    </tr>

    
    <tr>
     <td>
       <table bgcolor="f8f8f8" width="100%" align="center"  style="font-family: Arial, sans-serif; border:solid 1px #d5d5d5; color:#282828;" cellpadding="10" cellspacing="0">
       
         <tr style="font-size:20px;">
           <td>Dear <?= Html::encode($user->username) ?>,<br /></td>
         </tr>
         
         <tr>
           <td>Greetings and have a great day ahead!!<br /></td>
         </tr>
         
         <tr style="line-height:20px;">
           <td>
             Follow the link below to reset your password:
            </td>
         </tr>
         
         
         <tr>
           <td width="300"><a style="word-wrap:break-word;" target='_blank' class='link1' href="<?= $resetLink ?>"><?= Html::a(Html::encode($resetLink), $resetLink) ?></a><br /></td>
         </tr>
         <tr>
           <td>
             <b>Thanks and Regards</b><br />
             4statetruck.com
           </td>
         </tr>
         

       </table>
     </td>
    </tr>
    
    <tr>
     <td height="10"></td>
    </tr>
    
    <tr>
     <td>
       <table bgcolor="1b1b1c" width="100%" align="center"  style="font-family: Arial, sans-serif;color:#fff;" cellpadding="10" cellspacing="0">
           <tr align="center">
              <td>Copyright © 2016-17 4 State Trucks. All Rights Reserved.</td>
           </tr>
       </table>
       </td>
       </tr>

    
  </tbody>
</table>
</body>
</html>


