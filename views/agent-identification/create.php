<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AgentIdentification */

$this->title = 'Identification and Agent Affirmation page';
$this->params['breadcrumbs'][] = ['label' => 'Agent Identifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
        'countries_list' => $countries_list
    ]) ?>


