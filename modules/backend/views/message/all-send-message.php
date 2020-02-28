<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Send Message';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/files/css/jquery.dataTables.css">
<script type="text/javascript" language="javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/files/js/jquery.dataTables.js"></script>

<div class="user-index admin-garph-block">

    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 <div class="category-zx-section">   

<div style="clear:both;"></div>    

    <table class="table table-striped table-bordered" id="example"><thead>
<tr>
    <th>Sender</th>
    <th>First name</th>
    <th>Last name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Date</th>
     <th>View</th>
</tr>
 <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

<!--     <tr><td></td>
    <td><input type="text" class="form-control" name="first_name"></td>

    <?php //echo $form->field($model, 'invoice_no') ?>

    
    <td><input type="text" class="form-control" name="send_date" placeholder="Fill date like 2019-02-05"></td>

   <td>  <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('Reset', ['all-send-message'], ['class' => 'btn btn-success']) ?></td>
<td></td><td></td>
   
</tr> -->
 <?php ActiveForm::end(); ?>
</thead>
<tbody>
<?php $i=1;foreach ($model as $value) {?>
   <tr data-key="<?php echo $value['id']; ?>">
    <td><?php
            $id=$value['from_user'];
        $user=\app\models\User::find()->where(['id'=>$id])->one();
       //var_dump($user['username']);
       echo $user['username'];?></td>
    <td><?php echo $value['first_name']; ?></td>
    <td><?php echo $value['last_name']; ?></td>
    <td><?php echo $value['email']; ?></td>
    <td><?php echo $value['subject']; ?></td>
    <td><?php echo date("Y-m-d",strtotime($value['send_date'])); ?></td>
    
    <td>
      <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['backend/message/all-view', 'id' => $value['id']]) ?>" title="View detail"><span class="glyphicon glyphicon-eye-open icon-oval"></span></a> 
  </td>
</tr>
<?php $i++; } ?>
</tbody>
</table>

</div>
</div>
<script>
    $(document).ready(function () {
        $('#example').dataTable( {

        } );
        $('#example_length').css('width','40%');
        $('#example_length').css('float','left');
        $('#example_filter').css('float','right');
    });
</script>
