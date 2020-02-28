<?php

namespace app\components\bootbox;

use yii\web\AssetBundle;

class BootBoxAsset extends AssetBundle
{
    public $sourcePath = '@app/components/bootbox';

    public $js = [
        'js/bootbox.min.js', 'js/main.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
