<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Safe Purchase';
/* @var $this yii\web\View */
/* @var $model app\models\SafePurchase */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><a href="javascript:void(0);" class="remove_button"><img src="http://demos.codexworld.com/add-remove-input-fields-dynamically-using-jquery/remove-icon.png" style="display: inline-block;"/></a><input type="file" name="SafePurchase[image][]" value="" class="form-control" style="width:46%;display: inline-block;"/><input type="text" name="SafePurchase[more_items][]" value="" class="form-control" style="width:46%;display: inline-block;"/></div><br>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<section class="product-block">
     <div class="container">
         
         
         <h2>Safe Purchase</h2>
This is a non bank card online cash payment service.</p><p>
Members can find items that they want to buy online and ask WebPicID to pay for them.</p><p>
<h3>How does it work?</h3>
A Member finds an item(s) that they want to purchase online.</p><p>
The Member goes through the process including completing the shopping cart.</p><p>
The Member does not pay for the items.</p><p>
<h3>The Member logs off the merchant website logs on to WebPicID.</p><p></h3>
The Member selects Safe Purchase and reports the Safe Purchase.</p><p>
The form asks for:</p><p>
Vendor name</p><p>
Vendor URL</p><p>
Total amount of the Safe Purchase</p><p>
Vendor shopping Cart User ID</p><p>
Vendor shopping Cart Password</p><p>
Press, “Send”, to submit the Safe Purchase.</p><p>
<h3>What Happens now?</h3>
WebPicID checks to see if you have enough funds in your WebPicID Member Account.</p><p>
If funds are not available, a secure message is sent advising the Member to make a payment.</p><p>
WebPicID will check for the funds for 3 days before canceling the Safe Purchase.</p><p>
If the funds are available and if the Member is a Dependent WebPicID will ship the goods to the Parent.</p><p>
WebPicID will now log on to the vendor site and pay for the Safe Purchase,
The Vendor will send the Member or Parent the delivery and tracking details.</p><p>
WebPicID logs off the Vendor site.</p><p>
A secure message is sent to the Member (and Parent if necessary) confirming the sale.</p><p>
A Debit invoice will be sent to tn e Member’s account debiting their WebPicID account.</p><p>
         
      
    </p>
    </div>
</div>
</section>

 <section class="product-block">
     <div class="container">
          <h2>Safe Purchase</h2>
<div class="safe-purchase-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    
    
    <?= $form->field($model, 'vendor_name')->textInput() ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'total_amount')->textInput() ?>
    <?= $form->field($model, 'cart_user_id')->textInput() ?>
    <?= $form->field($model, 'cart_password')->textInput() ?>
    

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</section> 