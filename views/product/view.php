<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SearchTermCategory;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
$this->title = 'Product Detail';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-index product-block">
    <div class="product-box">
        <h2><i class="fa fa-archive" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h2>
        <div class="inner-bodyform">
        <div class="restaurant-view">
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <?php $query=SearchTermCategory::find()->where(['product_id'=>$model['id']])->orderBy('add_tree asc')->all(); ?>

                    
                   <tr><th>Description_Sage</th><td><?php echo $model['item_name']; ?></td></tr>
                    <tr><th>Item code</th><td><?php echo $model['item_code']; ?></td></tr>
                    <tr><th>Description_Web</th><td><?php echo $model['description']; ?></td></tr>
                    <tr><th>SE_Directory</th><td><?php echo $model['sedirectory']['se_directory']; ?></td></tr>
                    <!-- <tr><th>Search word</th>
                    <td><?php foreach ($query as $add_tree) {
                    //echo $add_tree['add_tree']."<br>";
                    } ?></td>
                    </tr> -->
                    <tr><th>Product Status</th><td><?php if($model['published']==1){ echo "Approve";}else { echo "Unapprove";} ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>




<!-- <section class="content">
    
</section> -->