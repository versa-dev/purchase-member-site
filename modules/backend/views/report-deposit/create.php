<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountStatement */

$this->title = 'Create Report Deposit';
$this->params['breadcrumbs'][] = ['label' => 'Payment account', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Report-Deposit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(isset($data)){?>
        <?=$this->render('_form', [
            'model' => $model,
            'data' =>$data
        ])?>
    <?php }else{ ?>
        <?=$this->render('_form', [
            'model' => $model,
        ])?>
    <?php }?>

</div>
