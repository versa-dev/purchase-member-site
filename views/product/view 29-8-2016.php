<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model app\models\Product */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="restaurant-view">
        <table class="table table-striped table-bordered detail-view">
            <tbody>
                <tr><th>Vendor name</th><td><?php echo $model['user']['username']; ?></td></tr>
                <tr><th>Item name</th><td><?php echo $model['category']['cat_name']; ?></td></tr>
                <tr><th>Item code</th><td><?php echo $model['product']['item_name']; ?></td></tr>
                <tr><th>Description</th><td><?php echo $model['product']['description']; ?></td></tr>
                <tr><th>Se directory</th><td><?php echo $model['product']['se_directory']; ?></td></tr>
                <tr><th>Search word</th><td><?php echo $model['product']['search_word']; ?></td></tr>
                <tr><th>Status</th><td><?php echo $model['product']['status']; ?></td></tr>
            </tbody>
        </table>
    </div>
</section>