<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FamilyProtectionMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="family-protection-member-form">

    

   <table class="table order-list table-bordered">
     <h2>Family Protection member</h2>
    <thead>
      <tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Relationship</th>
        <th>Email</th>
        <th>Age</th>
        <th>Cell Phone</th>
        <th>Apg(Yes/No)</th>
        <th>Home Phone</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($model as $key => $value) {?>      
      <tr>  
      <td><?= $value['first_name']  ?></td>
       <td><?= $value['middle_name']  ?></td>
       <td><?= $value['last_name']  ?></td>
       <td><?= $value['relation']  ?></td>
       <td><?= $value['email']  ?></td>
       <td><?= $value['age']  ?></td>
       <td><?= $value['cell_phone']  ?></td>
       <td><?= $value['apg']  ?></td>
       <td><?= $value['home_phone']  ?></td>
</tr>
<?php } ?>
    </tbody>
  </table>

    

    

    
