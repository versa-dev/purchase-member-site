<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AgentIdentification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Agent Identifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-identification-view">

    <h1><?= Html::encode($this->title) ?></h1>
<!-- 
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'primary_identification_type',
            'primary_date_issued',
            'primary_date_expiry',
            'primary_serial_number',
            'primary_body_location',
            'secondary_identification_type',
            'secondary_date_issued',
            'secondary_date_expiry',
            'secondary_serial_number',
            'secondary_body_location',
            'type',
            'date_issued',
            'date_of_birth',
            'serial_number',
            'body_location',
            'witness_name',
            'mother_firstname',
            'mother_middlename',
            'mother_lastname',
            'mother_maidenname',
            'mother_date_of_birth',
            'mother_wetness_name',
            'father_firstname',
            'father_middlename',
            'father_lastname',
            'father_maidenname',
            'father_date_of_birth',
            'father_wetness_name',
            'address_identification_type',
            'address_date_issued',
            'address_serial_number',
            'address_issuing_body_name',
            'address_street_address',
            'address_phone_number',
            'status',
            'created',
            'updated',
        ],
    ]) ?>

</div>
