<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
$this->title = 'Back To View Profile';
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
  <style> 
      table{ 
     
             border-spacing: 0 15px; 
             width: 96%;
             margin: 0px 15pc 30px 15px;
             border-collapse: separate;
      } 
    
      th,td{ 
      padding: 5px; 
      } 
    </style>

 <h4>
    <a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/profile'); ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo Html::encode($this->title) ?></a></h4>
<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="product-block">
      <div class="product-box">
        <div class="profile-form clearfix category-zx-section">

          <?php $form = ActiveForm::begin(['id' => 'profile-form','options'=>['enctype' => 'multipart/form-data']]); ?>
                    
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="row-fluid">
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'first_name')->textInput(['maxlength' => 200]) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'last_name')->textInput(['maxlength' => 200]) ?>
                </div>
              </div>
              <div class="row-fluid">
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($user, 'username')->textInput(['maxlength' => 200,'readonly' => true]) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($user, 'email')->textInput(['maxlength' => 200,'readonly' => true]) ?>
                </div>
                
              </div>
              
             
              <div class="row-fluid">

                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'phone_no')->textInput(['maxlength' => 200]) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'notificatoins_phone_no')->textInput(['maxlength' => 200]) ?>
                </div>

              </div>
               <div class="row-fluid">
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'alternate_email')->textInput(['maxlength' => 200]) ?>
                </div>
                 <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'city')->textInput(['maxlength' => 200]) ?>
                </div>
              </div>

              <div class="row-fluid">
                <div class="col-md-12 col-sm-12">
                  <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
                </div>
              </div>
              <div class="row-fluid">
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'state')->textInput(['maxlength' => 200]) ?>
                </div>
                <div class="col-md-6 col-sm-6">
                  <?= $form->field($model, 'country_id')->dropDownList($countries_list,['prompt'=>'Select your country']) ?>
                </div>
              </div>
     
                <h2>Custom Questions</h2>
                <br>
                <table>
                    <tbody>
                        <tr>
                            <td ><input type="text" class="form-control" name="answers[0][q]" placeholder="Question" value="<?php echo $array['0']['q'] ?>"></td>
                            <td><input type="text" class="form-control" name="answers[0][a]" placeholder="Answer"   value="<?php echo $array['0']['a'] ?>"></td>
                        </tr>

                        <tr>
                            <td class="td"><input type="text" class="form-control" name="answers[1][q]" placeholder="Question" value="<?php echo $array['1']['q'] ?>"></td>
                            <td><input type="text" class="form-control" name="answers[1][a]" placeholder="Answer"   value="<?php echo $array['1']['a'] ?>"></td>
                        </tr>

                        <tr class="td">
                            <td><input type="text" class="form-control" name="answers[2][q]" placeholder="Question" value="<?php echo $array['2']['q'] ?>"></td>
                            <td><input type="text" class="form-control" name="answers[2][a]" placeholder="Answer"   value="<?php echo $array['2']['a'] ?>"></td>
                        </tr>

                    </tbody>
                </table>
            </div>
             <div class="desktop-show"> 
              <div class="row-fluid">
                <div class="col-md-12 col-sm-12 ">
                  <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                  <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-primary']) ?>
                </div>
              </div>
              </div> 

            </div>


            <div class="col-md-6 col-sm-6 img-file">
             <!-- <div class="row-fluid width-center">
                <div class="col-md-12 col-sm-12">
                  <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" alt="profile picture">
                </div>
                <div class="col-md-12 col-sm-12 text-center">
                  <?= $form->field($model, 'image')->fileInput(['maxlength' => 200]) ?>
                </div>
              </div>-->
            
            <div class="mobile-show"> 
             <div class="row-fluid text-center">
               <div class="col-md-12 col-sm-12 ">
                 <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                 <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-primary']) ?>
               </div>
             </div>
            </div>


            </div>


          </div>
          
          <div class="nor-space"></div>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
  </div>
 
</div>
