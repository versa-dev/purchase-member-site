<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgentIdentificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agent Identifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-identification-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Agent Identification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'primary_identification_type',
            'primary_date_issued',
            'primary_date_expiry',
            // 'primary_serial_number',
            // 'primary_body_location',
            // 'secondary_identification_type',
            // 'secondary_date_issued',
            // 'secondary_date_expiry',
            // 'secondary_serial_number',
            // 'secondary_body_location',
            // 'type',
            // 'date_issued',
            // 'date_of_birth',
            // 'serial_number',
            // 'body_location',
            // 'witness_name',
            // 'mother_firstname',
            // 'mother_middlename',
            // 'mother_lastname',
            // 'mother_maidenname',
            // 'mother_date_of_birth',
            // 'mother_wetness_name',
            // 'father_firstname',
            // 'father_middlename',
            // 'father_lastname',
            // 'father_maidenname',
            // 'father_date_of_birth',
            // 'father_wetness_name',
            // 'address_identification_type',
            // 'address_date_issued',
            // 'address_serial_number',
            // 'address_issuing_body_name',
            // 'address_street_address',
            // 'address_phone_number',
            // 'status',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
