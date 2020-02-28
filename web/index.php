<?php


define('TABSPACE', '&nbsp;&nbsp;&nbsp;&nbsp;');
function print_object($obj, $tab_count = 0) {
    if (is_object($obj) || is_array($obj)) {
        if (is_object($obj))
            echo "Ojbect (";
        else
            echo "Array (";

        $is_ins_ret = false;
        foreach ($obj as $key => $member) {
            if (!$is_ins_ret) {
                echo "<br>";
                $is_ins_ret = true;
            }
            for ($i = 0; $i <= $tab_count; $i++)
                echo TABSPACE;
            echo $key." : ";    //print_r($member);
            print_object($member, $tab_count + 1);
            print_r("<br>");
        }

        for ($i = 0; $i < $tab_count; $i++)
            echo TABSPACE;
        echo ")";
    } else {
        print_r($obj);
    }
}

// comment out the following two lines when deployed to production

defined('YII_DEBUG') or define('YII_DEBUG', true);

defined('YII_ENV') or define('YII_ENV', 'dev');



require(__DIR__ . '/../vendor/autoload.php');

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');



$config = require(__DIR__ . '/../config/web.php');



(new yii\web\Application($config))->run();

