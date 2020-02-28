<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'User Detail';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// echo "<pre>"; print_r($user_detail); die;
?>
<div class="user-index admin-garph-block">

    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="category-zx-section">   
<div class="vendorbtn-box">
    <div style="float: left;"><p>
        <?php //echo Html::a('Create Vendor', ['register'], ['class' => 'btn  yellow-btn-box']) ?>
       
    </p>
    </div>
    <div style="float:right;">
       <?php Html::a('Back', ['/backend/user/'], ['class'=>'btn  red-btn-box']) ?>  
       <?php //echo  Html::a('Import csv file', ['index?UserSearch[report_search]=10'], ['class' => 'btn btn-primary btn-uniform']);  ?>
    </div>
    <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<h2>Registration Detail</2></h2>
<table class="table table-striped table-bordered detail-view"><tbody>


<tr><th>Email</th><td><a href="mailto:ariseit2018@gmail.com">
    <?php echo $user_detail['email']; ?></a></td></tr>
<tr><th>Username</th><td><?php echo $user_detail['username']; ?></td></tr>
<tr><th>First Name</th><td><?php echo $user_detail['profile']['first_name'] ?></td></tr>
<tr><th>Last Name</th><td><?php echo $user_detail['profile']['last_name']; ?></td></tr>
<tr><th>Status</th><td>
<?php echo $user_detail['status']==1 ?'Active':'Inactive'; ?></td></tr>
<tr><th>Snapshot</th><td><?php if(!empty($user_detail['profile']['image'])){ }else{echo "--";} ?></td></tr>
</tbody></table>


<h2>Agent Identification detail</2></h2>
<table class="table table-striped table-bordered detail-view"><tbody>
    <tr><th colspan="2"><h3>Primary Identification:</h3></th></tr>

<tr><th>Identification Type</th><td>
<?php echo $user_detail['agentIdentification']['primary_identification_type']; ?></td></tr>
<tr><th>Date Issued</th><td><?php echo $user_detail['agentIdentification']['primary_date_issued']; ?></td></tr>
<tr><th>Date Expiry</th><td><?php echo $user_detail['agentIdentification']['primary_date_expiry']; ?></td></tr>
<tr><th>Serial Number</th><td><?php echo $user_detail['agentIdentification']['primary_serial_number']; ?></td></tr>
<tr><th>Body Location</th><td>
<?php echo $user_detail['agentIdentification']['primary_body_location']; ?></td></tr>

<tr><th colspan="2"><h3>Secondary Identification:</h3></th></tr>
<tr><th>Identification Type</th><td>
<?php echo $user_detail['agentIdentification']['secondary_identification_type']; ?></td></tr>
<tr><th>Date Issued</th><td><?php echo $user_detail['agentIdentification']['secondary_date_issued']; ?></td></tr>
<tr><th>Date Expiry</th><td><?php echo $user_detail['agentIdentification']['secondary_date_expiry']; ?></td></tr>
<tr><th>Serial Number</th><td><?php echo $user_detail['agentIdentification']['secondary_serial_number']; ?></td></tr>
<tr><th>Body Location</th><td>
<?php echo $user_detail['agentIdentification']['secondary_body_location']; ?></td></tr>

<tr><th colspan="2"><h3>For a Birth Certificate (Required for a Minor Member under 18 years of age):</h3></th></tr>
<tr><th>Identification Type</th><td>
<?php echo $user_detail['agentIdentification']['type']; ?></td></tr>
<tr><th>Date Issued</th><td><?php echo $user_detail['agentIdentification']['date_issued']; ?></td></tr>
<tr><th>Date OF Birth</th><td><?php echo $user_detail['agentIdentification']['date_of_birth']; ?></td></tr>
<tr><th>Serial Number</th><td><?php echo $user_detail['agentIdentification']['serial_number']; ?></td></tr>
<tr><th>Body Location</th><td>
<?php echo $user_detail['agentIdentification']['body_location']; ?></td></tr>
<tr><th>Witness Name</th><td>
<?php echo $user_detail['agentIdentification']['witness_name']; ?></td></tr>


<tr><th colspan="2"><h3>Mother's:</h3></th></tr>
<tr><th>First name</th><td>
<?php echo $user_detail['agentIdentification']['mother_firstname']; ?></td></tr>
<tr><th>Middle name</th><td><?php echo $user_detail['agentIdentification']['mother_middlename']; ?></td></tr>
<tr><th>Last name</th><td><?php echo $user_detail['agentIdentification']['mother_lastname']; ?></td></tr>
<tr><th>Maiden name</th><td><?php echo $user_detail['agentIdentification']['mother_maidenname']; ?></td></tr>
<tr><th>Date Of Birth</th><td>
<?php echo $user_detail['agentIdentification']['mother_date_of_birth']; ?></td></tr>
<tr><th>Witness Name</th><td>
<?php echo $user_detail['agentIdentification']['mother_wetness_name']; ?></td></tr>


<tr><th colspan="2"><h3>Father's:</h3></th></tr>
<tr><th>First name</th><td>
<?php echo $user_detail['agentIdentification']['father_firstname']; ?></td></tr>
<tr><th>Middle name</th><td><?php echo $user_detail['agentIdentification']['father_middlename']; ?></td></tr>
<tr><th>Last name</th><td><?php echo $user_detail['agentIdentification']['father_lastname']; ?></td></tr>
<tr><th>Maiden name</th><td><?php echo $user_detail['agentIdentification']['father_maidenname']; ?></td></tr>
<tr><th>Date Of Birth</th><td>
<?php echo $user_detail['agentIdentification']['father_date_of_birth']; ?></td></tr>
<tr><th>Witness Name</th><td>
<?php echo $user_detail['agentIdentification']['father_wetness_name']; ?></td></tr>

<tr><th colspan="2"><h3>Address Identification:</h3></th></tr>
<tr><th>Address Identification Type</th><td>
<?php echo $user_detail['agentIdentification']['address_identification_type']; ?></td></tr>
<tr><th>Address Date Issued</th><td><?php echo $user_detail['agentIdentification']['address_date_issued']; ?></td></tr>
<tr><th>Address Serial Number</th><td><?php echo $user_detail['agentIdentification']['address_serial_number']; ?></td></tr>
<tr><th>Address Issuing Body Name</th><td><?php echo $user_detail['agentIdentification']['address_issuing_body_name']; ?></td></tr>
<tr><th>Address Street Address</th><td>
<?php echo $user_detail['agentIdentification']['address_street_address']; ?></td></tr>
<tr><th>Address Phone Number</th><td>
<?php echo $user_detail['agentIdentification']['address_phone_number']; ?></td></tr>




<tr><th colspan="2"><h3>Question And Answer:</h3></th></tr>
<?php foreach($que_ans_custom as $key=>$value){ ?>
        <tr><th><?= $value['question'] ?></th><td><?= $value['answer'] ?></td></tr>
 <?php }?>

<?php foreach($que_ans as $key=>$value){ ?>
<tr><th><?php echo $value['question']['question'] ?></th><td><?php echo $value['answer'] ?></td></tr>
<?php }?>

<tr><th colspan="2"><h3>Family Protection Member:</h3></th></tr>
<?php 
$family= \app\models\FamilyProtection::find()->where(['user_id'=>$user_detail['id']])->one();
$member= \app\models\FamilyProtectionMember::find()->where(['family_protection_id'=>$family['id']])->all();
//echo "<pre>"; print_r($member); die;
$i=1;foreach($member as $key=>$value){ ?>
    
   <tr><th colspan="2"><h2><?php echo $i; ?></h2> </th></tr>
<tr><th>First Name</th><td><?php echo $value['first_name'] ?></td></tr>
<tr><th>Middle Name</th><td><?php echo $value['middle_name'] ?></td></tr>
<tr><th>Last Name</th><td><?php echo $value['last_name'] ?></td></tr>
<tr><th>Relation</th><td><?php echo $value['relation'] ?></td></tr>
<tr><th>Email</th><td><?php echo $value['email'] ?></td></tr>
<tr><th>Age</th><td><?php echo $value['age'] ?></td></tr>
<tr><th>Cell Phone</th><td><?php echo $value['cell_phone'] ?></td></tr>
<tr><th>Home phone</th><td><?php echo $value['home_phone'] ?></td></tr>

<?php $i++; }?>

</tbody></table>

</div
</div>