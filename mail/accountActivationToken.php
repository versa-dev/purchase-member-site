<?php
 use yii\helpers\Html;

 /* @var $this yii\web\View */
 /* @var $user app\models\User */
 if(isset($key)){
     $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-account1',
         'token' => $account_activation_token,'key' => $key]);
 }else{
     $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate-account',
         'token' => $account_activation_token]);
 }

 $icon='https://idtflrco.mywhc.ca/demo_now/web/themes/vuportal/files/images/';
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
     .verify_email{
         border: 0 none;
         color: #ffffff;
         display: block;
         font-size: 18px;
         font-weight: bold;
         line-height: 44px;
         text-decoration: none;
         width: 100%;
     }
 </style>
 <body>
 <table align="center" border="0" cellpadding="0" cellspacing="0" width="630">
     <tbody>
     <tr style="background:#f0f0f0">
         <td align="center" width="100%">
             <a href="#"><img src="<?php echo $icon; ?>logo.png" alt="" /></a>
         </td>
     </tr>
     <tr>
         <td colspan="3" height="40"></td>
     </tr>
     <tr>
         <td colspan="3">
             <br><br>
             <p style="color:#1f2836;font:bold 18px / 27px 'helvetica' , 'arial' , sans-serif;margin-bottom:0 !important;margin-left:0 !important;margin-right:0 !important;margin-top:0 !important;padding-bottom:0 !important;padding-left:0 !important;padding-right:0 !important;padding-top:0 !important">Hello <?= Html::encode($name)?></p>
         </td>
     </tr>
     <tr>
         <td colspan="3" height="12"></td>
     </tr>
     <tr>
         <td colspan="3">
             <p style="color:#1f2836;font:18px / 27px 'helvetica' , 'arial' , sans-serif;margin-bottom:0 !important;margin-left:0 !important;margin-right:0 !important;margin-top:0 !important;padding-bottom:0 !important;padding-left:0 !important;padding-right:0 !important;padding-top:0 !important">
                 Welcome to Web Picture Identification Inc operating as WebPicID.
                 <br>
                 Thank you for Acting as an Agent for WebPicID.
                 Please click on the link below to verify you email address and take picture.
                 <br>
                 <a href="<?php echo $resetLink; ?>"> <?php echo substr($resetLink,0,-56); ?> </a>
                 <br>
                 We take a picture for security purposes.
                 You have a Message at WebPicID.com that will tell you how to get paid.
             </p>
         </td>
     </tr>
     <tr>
         <td colspan="3" height="40"></td>
     </tr>
     </tbody>
 </table>
 </body>
 </html>


