<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPages */
/* @var $form yii\widgets\ActiveForm */

app\assets\AppAsset::register($this);



$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/common.js', ['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);
?>

<?php 

$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/ckeditor/ckeditor.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/ckfinder/ckfinder.js', ['position' => $this::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs("CKEDITOR.replace('StaticPages[description]', {"
        . "filebrowserImageBrowseUrl: '" . \yii\helpers\Url::to(['/js/ckfinder/ckfinder.html?type=Images'], true) . "',"
        . "filebrowserImageUploadUrl: '" . \yii\helpers\Url::to(['/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'], true) . "',"
        . "})");
$this->registerJs("CKFinder.setupCKEditor();");
?>

<div class="static-pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
