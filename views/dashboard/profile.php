<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
$this->title = 'Press Here to EDIT PROFILE.';
$this->params['breadcrumbs'][] = $this->title;
$id=Yii::$app->getRequest()->getQueryParam('id');
if($model->image){
$pic_image=$model->image;
}
else {
$pic_image='avtar.jpg';
}
$ans =  \app\models\ProfileQuestionAnswerCustom::find()->where(['user_id'=>Yii::$app->user->id])->all();
$array=array();
if(!empty( $ans)){
    foreach($ans as $key=>$value){

        $array[$key]['q']=$value['question'];
        $array[$key]['a']=$value['answer']; 
    }
}else{
    $array['0']['q']='';
    $array['0']['a']='';
    $array['1']['q']='';
    $array['1']['a']='';
    $array['2']['q']='';
    $array['2']['a']='';
}

?>

 <h4>
    <a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/edit'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo Html::encode($this->title) ?></a></h4>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="product-block" style="margin-bottom: 100px;">
      <div class="product-box">
        <div class="profile-form clearfix category-zx-section">
            <h4><b>The information in this Profile is used to enhance your protection:</b></h4>

            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    
                    <tr>
                        <th>Username</th><td><?php echo $user['username']; ?></td>
                        <th>Email</th><td><a href="mailto:<?php echo $user['email']?>">
                        <?php echo $user['email']; ?></a></td>
                    </tr>
                    <tr>
                        <th>First Name</th><td><?php echo $model['first_name'] ?></td>
                        <th>Last Name</th><td><?php echo $model['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone No</th><td><?php echo $model['phone_no'] ?></td>
                        <th>Alternate Email</th><td><?php echo $model['alternate_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th><td><?php echo $model['address'] ?></td>
                        <th>City</th><td><?php echo $model['city'] ?></td>
                        
                    </tr>
                    <tr>
                        
                        <th>State/Province</th><td><?php echo $model['state'] ?></td>
                        <th>Country</th><td><?php //echo $model['country']; ?></td>
                    </tr>

                    
                </tbody>
            </table>
            <h2>Agent Identification detail</2></h2>
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr>
                        <th colspan="2">
                            <h3>Primary Identification:</h3></th>
                    </tr>

                    <tr>
                        <th>Identification Type</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['primary_identification_type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Issued</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['primary_date_issued']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Expiry</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['primary_date_expiry']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['primary_serial_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Body Location</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['primary_body_location']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>Secondary Identification:</h3></th>
                    </tr>
                    <tr>
                        <th>Identification Type</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['secondary_identification_type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Issued</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['secondary_date_issued']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Expiry</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['secondary_date_expiry']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['secondary_serial_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Body Location</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['secondary_body_location']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>For a Birth Certificate (Required for a Minor Member under 18 years of age):</h3></th>
                    </tr>
                    <tr>
                        <th>Identification Type</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Issued</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['date_issued']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date OF Birth</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['date_of_birth']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['serial_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Body Location</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['body_location']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Witness Name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['witness_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>Mother's:</h3></th>
                    </tr>
                    <tr>
                        <th>First name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_firstname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Middle name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_middlename']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Last name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_lastname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Maiden name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_maidenname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Of Birth</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_date_of_birth']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Witness Name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['mother_wetness_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>Father's:</h3></th>
                    </tr>
                    <tr>
                        <th>First name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_firstname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Middle name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_middlename']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Last name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_lastname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Maiden name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_maidenname']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Date Of Birth</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_date_of_birth']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Witness Name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['father_wetness_name']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>Address Identification:</h3></th>
                    </tr>
                    <tr>
                        <th>Address Identification Type</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_identification_type']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address Date Issued</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_date_issued']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address Serial Number</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_serial_number']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address Issuing Body Name</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_issuing_body_name']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address Street Address</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_street_address']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Address Phone Number</th>
                        <td>
                            <?php echo $user_detail['agentIdentification']['address_phone_number']; ?>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">
                            <h3>Question And Answer:</h3></th>
                    </tr>

                    <?php foreach($que_ans_custom as $key=>$value){ ?>
                        <tr>
                            <th>
                                <?= $value['question'] ?>
                            </th>
                            <td>
                                <?= $value['answer'] ?>
                            </td>
                        </tr>
                    <?php }?>

                    <?php foreach($que_ans as $key=>$value){ ?>
                        <tr>
                            <th>
                                <?php echo $value['question']['question'] ?>
                            </th>
                            <td>
                                <?php echo $value['answer'] ?>
                            </td>
                        </tr>
                    <?php }?>

                        <tr>
                            <th colspan="2">
                                <h3>Family Protection Member:</h3></th>
                        </tr>
                    <?php 
                    $family= \app\models\FamilyProtection::find()->where(['user_id'=>$user_detail['id']])->one();
                    $member= \app\models\FamilyProtectionMember::find()->where(['family_protection_id'=>$family['id']])->all();
                    //echo "<pre>"; print_r($member); die;
                    $i=1;foreach($member as $key=>$value){ ?>

                        <tr>
                            <th colspan="2">
                                <h2><?php echo $i; ?></h2> </th>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td>
                                <?php echo $value['first_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Middle Name</th>
                            <td>
                                <?php echo $value['middle_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>
                                <?php echo $value['last_name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Relation</th>
                            <td>
                                <?php echo $value['relation'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <?php echo $value['email'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>
                                <?php echo $value['age'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Cell Phone</th>
                            <td>
                                <?php echo $value['cell_phone'] ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Home phone</th>
                            <td>
                                <?php echo $value['home_phone'] ?>
                            </td>
                        </tr>

                    <?php $i++; }?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
 
</div>
