<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Update Product: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-index product-block">
	<div class="product-box">
		<h2><i class="fa fa-archive" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h2>
		<div class="inner-bodyform">
    <?= $this->render('_updateform', [
        'model' => $model,
        //'cat'=>$cat,
        'vendor'=>$vendor,
        'cat_list'=>$cat_list,
		'status'=>$status,
		'modification_status'=>$modification_status,
		'se_directory'=>$se_directory,
    ]) ?>
</div>
</div>
</div>
