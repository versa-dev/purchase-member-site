<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//header("Refresh: 60;url='".$_SERVER['REQUEST_URI']."'");
/* @var $this yii\web\View */
////echo $this->render('_slider',['data'=>$data]);
$this->title = 'Refer an organization';
?>


 <section class="product-block">
     <div class="container">
      <h2>Refer an organization</h2>
      <div class="row">
        <div class="col-sm-12">


Provides the name and contact person at the Merchant organization.<br>
When the organization signs up the need to name the person who refered them to WebPicID.com<br>
The Member can ask WebPicID to contact the merchant directly.<br>
<p>
    OR
</p>

The Member can walk the Merchant contact through the Sign Up and Log on by the contact person.<br>

The Merchant must provide the Members’ name and email address as the referring person.<br>

WebPicID will pay the referring Member 10% of the ID Theft Loss Reduction Revenue.
</p>

Option 1   Ask the Merchant to sign up here.

<a class="btn btn-info1" href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-signup'); ?>">Merchant Sign Up</a><br>

Option 2

Refer the Organization to WebPicID.

Send a Secure Message to REFER@WPID.ca with some or all of this information.
Company Name *<br>
Company Type (ltd or proprietorship) *<br>
Years in business<br>
Annual sales<br>
Average sale amount<br>
Street Address *<br>
City *<br>
State/Province *<br>
Country *<br>
Postal/ZIP code *<br>
Telephone *<br>
Website URL*<br>
<br>
Request WebPicID makes contact.<br>
Contact Person Name*<br>
Title *<br>
Direct line and extension*<br>
Best time to call*<br>
Time zone<br>
Time<br>
        </div>
      </div>
 </div>
        
         </section>
