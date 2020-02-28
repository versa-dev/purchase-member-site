<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Manager';
//$this->params['breadcrumbs'][] = $this->title;
$pid=Yii::$app->getRequest()->getQueryParam('id');
if(!empty($id)){
    $id='add?id='.$pid;
}
else {
  $id='add';  
}
$str=rtrim($breadcrumbs, "|");
$str_data=explode("|",$str);

?>

<div class="user-index">

    <h1><?php //echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div>
    <div style="float: left;"><p>
        <?= Html::a('Create Category', [$id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['/backend/category/manager/'], ['class'=>'btn btn-danger']) ?>
        <?= Html::a('Sort', ['/backend/category/sort?id='.$pid], ['class'=>'btn btn-danger']) ?>  
    </p>
    <p><?php  foreach ($str_data as $key => $value) { 
         $getdata=\app\models\ProductCategory::find()->where(['id'=>$value])->select('cat_name')->one();
          
          ?>
        <a href="<?php echo Yii::$app->urlManager->createUrl(['/backend/category/manager','id'=>$value]) ?>"><?php echo $getdata['cat_name'];?></a>|
    <?php } ?></p>
    </div>
    
</div>
<div style="clear:both;"></div>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'cat_name',
            'description',
            //'email',
            // 'profile.name',
            /*'auth_key',
            'password_hash',
            'password_reset_token',*/
            // 'account_activation_token',
            // 'email:email',
            // 'usertype',
            // 'status',
            // 'created_at',
            // 'updated_at',
            
            /* 'profile.name'=>array(
        'label' => 'status',
            'attribute'=>'status',
       'value'=>function($data){
                echo  profile.name;   
                   } ,
            
        'filter' => html::textField($model, 'profile.name'),
      
    ),*/

           /* [
            'attribute'=>'name',
            'label'=>'Name',
            'format'=>'html',//raw, html
            'content'=>function($data){
            return $data->getParentName();
            }
            ],*/
            
           /* [ 
            'attribute'=>'status',
            'value'=>function($model){
            return ($model->status == 1)?'Active':'Inactive';
            },
            'filter' => Html::dropDownList('UserSearch[published]', $searchModel->published,array("1"=>"Active","0"=>"Inactive"), ['class' => 'form-control', 'prompt' => 'Select Any']),
            ],*/
            


         [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{update}{manager} {status}{delete}',
            'buttons' => [
                'status' =>  function ($url, $model) {
                    return $model->published == 0 ? Html::a('<span class="glyphicon glyphicon-ban-circle"></span>', $url, [
                        'title' => Yii::t('yii', 'Unblock Category'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to unblock this Category ?'),
                    ]) :
                    Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                        'title' => Yii::t('yii', 'Block Category'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to block this Category ?'),
                    ]);
                },

                /*'profile' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;
                },*/
                'update' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;},
                    'manager' =>  function ($url, $model) {
                    return  Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => Yii::t('yii', 'View'),
                    ]) ;},
                    'delete' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                         'data-confirm' => Yii::t('yii', 'Are you sure you want to unblock this user ?'),
                    ]) ;
                },
            ],
        ]
        ],
    ]); ?>

</div>
