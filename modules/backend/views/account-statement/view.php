<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountStatement */

$this->title = 'View';
$this->params['breadcrumbs'][] = ['label' => 'Account Statements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-statement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('back', ['index'], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a('Delete', ['delete', 'id' => $model->id], [
           // 'class' => 'btn btn-danger',
            //'data' => [
           ///     'confirm' => 'Are you sure you want to delete this item?',
            //    'method' => 'post',
            //],
       // ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
           // 'user_id',
           
        [   'label'=>'User name',
             'format' => 'raw',
            'attribute' => 'user_id',
            'value' => function ($model) {
                $name=\app\models\UserProfile::find()->where(['user_id'=>$model->user_id])->one();
                return $name['first_name'].' '.$name['last_name'];
            },
            'visible' => \Yii::$app->user->can('account-statement.user_id.view'),
        ],
       
            'date',
            'time',
            'balance_forward',
            'credit',
            'debit',
            'description:ntext',
            'detail_link',
            'current_balance',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
