<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


app\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
\app\components\bootbox\BootBoxAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$this->registerJsFile(yii\helpers\BaseUrl::base() . '/js/common.js', ['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
     <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/css/main.css">
</head>
<body class="hold-transition skin-blue sidebar-mini vu-theme">
<?php $this->beginBody() ?>
<div class="wrapper ">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <?php  if(!Yii::$app->user->isGuest) { ?>
        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>
    <?php } ?>

    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>

</div>
app.min.js
<script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/admin/files/js/app.min.js"></script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
