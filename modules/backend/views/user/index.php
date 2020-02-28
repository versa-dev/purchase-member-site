<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage User';
$this->params['breadcrumbs'][] = $this->title;

if (Yii::$app->getSession()->hasFlash('warning'))
{
    ?>
    <script>
        alert("<?php echo Yii::$app->getSession()->getFlash('warning'); ?>")
    </script>
    <?php
}
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
       <?php Html::a('Reset', ['/backend/user/'], ['class'=>'btn red-btn-box']) ?>
    </div>
    <div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',

//            [
//                'attribute'=>'id',
//                'label'=>'User_Id',
//                'format'=>'html',//raw, html
//                'content'=>function($data){
//                    return $data->id;
//                }
//            ],
            //'email',
            /*'auth_key',
            'password_hash',
            'password_reset_token',*/
            // 'account_activation_token',
            // 'email:email',
            // 'usertype',
             //'status',
            // 'created_at',
            // 'updated_at',
//
//             'profile.name'=>array(
//        'label' => 'status',
//            'attribute'=>'status',
//       'value'=>function($data){
//                echo  profile.name;
//                   } ,
//
//        'filter' => html::textField($model, 'profile.name'),
//
//    ),

            /*[
            'attribute'=>'name',
            'label'=>'Name',
            'format'=>'html',//raw, html
            'content'=>function($data){
            return $data->getParentName();
            }
            ],*/
            [
            'attribute'=>'email',
            'label'=>'Email',
            'format'=>'html',//raw, html
            'content'=>function($data){
            return $data->email;
            }
            ],

            [
            'attribute'=>'family_code',
            'label'=>'Family code',
            'format'=>'html',//raw, html
            'content'=>function($data){
            return $data->familyProtection['id'];            
            }
            ],
            [
            //'attribute'=>'name',
            'label'=>'Age',
            'format'=>'html',//raw, html
            'content'=>function($data){

                //changed by GP;
                // I think there is not need no longer.
                return $data->profile['age'];
//            	//$age= \app\models\FamilyProtectionMember::find()->where(['email'=>$data->email])->select('age')->one();
//            $dateOfBirth = $data->profile->date_of_birth;
//            $today = date("Y-m-d");
//            $diff = date_diff(date_create($dateOfBirth), date_create($today));
//            $age=$diff->format('%y');
//            return $age;
            }
            ],
            [
            //'attribute'=>'name',
            'label'=>'Type',
            'format'=>'html',//raw, html
            'content'=>function($data){
            	//$age= \app\models\FamilyProtectionMember::find()->where(['email'=>$data->email])->select('age')->one(); 
        //chanaged by GP
//                $dateOfBirth = $data['profile']['date_of_birth'];
//            $today = date("Y-m-d");
//            $diff = date_diff(date_create($dateOfBirth), date_create($today));
//            $age=$diff->format('%y');
//            	if($age>=5 && $age<=12){
//            		$called='D';
//            	}
//                if($age>=0 && $age<=4){
//                    $called='D';
//                }
//            	if($age>=13 && $age<=18){
//            		$called='D';
//            	}
//            	if($age>18){
//            // 		$called='A';
//            		$called='G';
//            	}
//            	if($age>40){
//            	    $called='P';
//                }
            return $data->profile['mtype'];
            }
            ],
           /* [
            //'attribute'=>'name',
            'label'=>'Family Code',
            'format'=>'html',//raw, html
            'content'=>function($data){
            	$id= \app\models\FamilyProtection::find()->where(['user_id'=>$data->id])->select('id')->one(); 
            	if($id['id']){
            		$code=str_pad($id['id'],3,"0",STR_PAD_LEFT);
            	}
            	else{
            		$code='Not Set';
            	}
            return $code;
            }
            ],*/
           /* [
            'label' => 'Country',
            'attribute'=>'nicename',
             //'filter'=>app\models\ProductCategory::getAllCategories(),
            'format'=>'raw',//raw, html
            'value'=>'country.nicename'
            ],*/

            [
            'attribute'=>'status',
            //'filter'=>array("10"=>"Active","0"=>"Inactive"),
            'value'=>function($model){
            return ($model->status == 10)?'Active':'Inactive';
            },
            'filter' => Html::dropDownList('UserSearch[status]', $searchModel->status,array("10"=>"Active","0"=>"Inactive"), ['class' => 'form-control', 'prompt' => 'Select Any']),
            ],
            [
                'attribute'=>'date_membership',
                'label'=>'Date of Membership',
                'format'=>'html',//raw, html
                'content'=>function($data){
                //changed by GP
//                   I think this is not date of membership
//                    return $data->profile['date_of_birth'];

                    return $data->profile['date_of_membership'];
                }
            ],
            /*[ 
            'attribute'=>'usertype',
            'filter'=>array("Supplier"=>"Supplier","Client"=>"Client"),
            'value'=>function($model){
                return  $model->usertype;
           // return ($model->usertype == 'Admin')?'Active':'Inactive';
            },

            ],*/


         [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
             'headerOptions' => ['style' => 'width:10%'],
            'template' => '{profile} {block-user} {view} {delete}',
            'buttons' => [
                'block-user' =>  function ($url, $model) {
                    return $model->status == 0 ? Html::a('<span class="glyphicon glyphicon-ban-circle icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Unblock Vendor'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to unblock this vendor ?'),
                    ]) :
                    Html::a('<span class="glyphicon glyphicon-ok icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Block Vendor'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to block this vendor ?'),
                    ]);
                },

                /*'profile' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;
                },*/
                'profile' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-pencil icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Edit'),
                    ]) ;},
                    'delete' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-trash icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                         'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user ?'),
                    ]) ;
                },
                 'view' =>  function ($url, $model) {
                    return  Html::a('<span class="glyphicon glyphicon-eye-open icon-oval"></span>', $url, [
                        'title' => Yii::t('yii', 'View detail'),
                    ]) ;},
            ],
        ]
        ],
    ]); ?>

</div>
</div>
