<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create admin-garph-block">

    <h1><i class="fa fa-bars" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>

    <div class="category-zx-section">
    <?= $this->render('_form', [
        'model' => $model,
        'cat_list'=>$cat_list,
        'vendor'=>$vendor,
        'status'=>$status,
		'modification_status'=>$modification_status,
		'se_directory'=>$se_directory,
    ]) ?>
   </div>
</div>
