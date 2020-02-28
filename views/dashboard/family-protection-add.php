<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FamilyProtectionMember */
/* @var $form yii\widgets\ActiveForm */


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () { 
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[first_name][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[middle_name][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[last_name][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[relation][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[email][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[date_of_birth][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[cell_phone][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[username][]"></td>';
        cols += '<td><input type="text"  class="form-control" name="FamilyProtectionMember[password][]"></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
    
    $('#familyprotectionmember-email').change(function(){
        var email = $('#familyprotectionmember-email').val();
        $('#familyprotectionmember-password').val(email);
    })
    
    function setuser(){
        var fname =  $('#familyprotectionmember-first_name').val(); 
        var lname =  $('#familyprotectionmember-last_name').val();
        if(fname!='' && lname!=''){
            var fnamechar = fname.substring(0, 2);
            var lnamechar = lname.substring(0, 2); 
            $.ajax({
               url: '<?php echo Yii::$app->request->baseUrl. '/dashboard/check-username' ?>',
               type: 'post',
               data: {fname: fname, lname: lname},
               success: function (data) {
                  $('#familyprotectionmember-username').val(data.search);
               }
          });
        }
    }
    
    $('#familyprotectionmember-first_name').change(function(){
        setuser();
    })
    
     $('#familyprotectionmember-last_name').change(function(){
        setuser();
    })


});



function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
</script>
<div class="family-protection-member-form">

    <?php $form = ActiveForm::begin(); ?>

   <table class="table order-list table-bordered">
    <h2>Family Protection Table  The AGP adds individual members of the family </h2>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Relation</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Cell Phone</th>
        <th>Username</th>
        <th>Password</th>

      </tr>
    </thead>
    <tbody>
       <tr><td><?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'middle_name')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'relation')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'date_of_birth')->textInput()->label(false) ?></td>
       <td><?= $form->field($model, 'cell_phone')->textInput(['maxlength' => true])->label(false) ?></td>
       <td><?= $form->field($model, 'username')->textInput()->label(false) ?></td>
       <td><?= $form->field($model, 'password')->textInput()->label(false) ?></td>
</tr>
    </tbody>
  </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
       <!-- <input type="button" class="btn btn-info " id="addrow" value="Add More Member" /> -->
        
    </div>
   <!--  <div class="form-group">
        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add More Member" />
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
<section class="product-block">
     <div class="container">
      <h2>Family Protection Service</h2>
      <div class="row">
        <div class="col-sm-12">
         
         <p><h3>Family Protection process</h3>

Please enter all of the family Members regardless of age.<br><br>
Each family member must go through the Sign Up process t o become a Member.<br>
Each family Member must have a unique email address.<br>
The Parent Acts as the Agent to verify the identity for each family member.<br>
Dependents under the age of 5 can have a Parent do the sign up.<br><br>
Dependents who can log on by them self can use the services.<br>

<a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/family-protection-service'); ?>">Family Protection Service additional information</a>  </p>
        </div>
      </div>
 </div>
        
         </section>
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
   var j = jQuery.noConflict();
  j( function() {
    j("#familyprotectionmember-date_of_birth").datepicker({
            changeMonth: true,
            changeYear: true,
           yearRange: '1920:' + '2025',
           dateFormat: 'yy-mm-d'
        });
        
        
        
  } );
  </script>
  <script>
  var j = jQuery.noConflict();
  j( function() {
    j("#familyprotectionmember-time").timepicker({
            'value' => '11:24 AM',
        });
        
        
        
  } );
  </script>
