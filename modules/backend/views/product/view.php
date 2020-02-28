<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SearchTermCategory;
use app\models\UserProfile;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
$this->title = 'Product Detail';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-garph-block">
    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <div class="category-zx-section">
        <div class="restaurant-view">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <?php $query=SearchTermCategory::find()->where(['product_id'=>$model['id']])->orderBy('add_tree asc')->all();
                    $user_profile=UserProfile::find()->where(['user_id'=>$model['user_id']])->one(); ?>
                    <tr><th>Company Name</th><td><?php echo $user_profile['company_name']; ?></td></tr>
                    <tr><th>First Name</th><td><?php echo $user_profile['first_name']; ?></td></tr>
                    <tr><th>Last Name</th><td><?php echo $user_profile['last_name']; ?></td></tr>
                    <tr><th>Description_Sage</th><td><?php echo $model['item_name']; ?></td></tr>
                    <tr><th>Item code</th><td><?php echo $model['item_code']; ?></td></tr>
                    <tr><th>Description_Web</th><td><?php echo $model['description']; ?></td></tr>
                    <tr><th>SE_Directory</th><td><?php echo $model['sedirectory']['se_directory']; ?></td></tr>
                     <!-- <tr><th>Search word</th>
                                         <td><?php foreach ($query as $add_tree) {
                                      //   echo $add_tree['add_tree']."<br>";
                                         } ?></td>
                                         </tr> -->
                    <tr><th>Product Status</th><td><?php if($model['published']==1){ echo "Approve";}else { echo "Unapprove";} ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>




<!-- <section class="content">
    
</section> -->