<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MerchantSignup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Merchant Signups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-signup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'company_name',
            'company_type',
            'telephone',
            'street_address',
            'city',
            'state',
            'country',
            'postal_code',
            'website_url:url',
            'first_name',
            'last_name',
            'job_title',
            'current_contact_number',
            'email_address:email',
            'time_zone_for_contact',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
