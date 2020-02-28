<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\debug\Toolbar;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta name="format-detection" content="telephone=no">
        <?= Html::csrfMetaTags() ?>
        <title><?php echo Html::encode($this->title); ?></title>
        <meta property='og:site_name' content='<?php echo Html::encode($this->title); ?>' />
        <meta property='og:title' content='<?php echo Html::encode($this->title); ?>' />
        <meta property='og:description' content='<?php echo Html::encode($this->title); ?>' />
        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/images/favicon-32x32.png" type="image/x-icon" />
        <?php $this->head(); ?>
        <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/css/stylesheet.css">
        <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/css/main.css">
        <link rel="stylesheet" href="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <!--[if lt IE 9]>
        <script src="dist/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php include(dirname(__FILE__) . '/menu.php'); ?>
        <?php //$container_home = 'site/index' ? 'main-container' : 'inner-container';
              //$container_forgot =  'site/request-password-reset' ? 'main-container' : 'inner-container';
        $isHome = $front_page == 'site/index' ? true : false;
        $isForgot= $front_page == 'site/request-password-reset' ? true : false;
        $isReset= $front_page == 'site/reset-password' ? true : false;

          if($isHome || $isForgot || $isReset) { $class_spec='main-container';}else { $class_spec='inner-container'; }    ?>
        <div class="<?php echo $class_spec;  ?>">
            <div class="container">
            <div class="alert-down">
                <?php 
                foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                }
                ?>
                <?php echo $content; ?>
            </div>
            </div>
        </div>
        <?php include(dirname(__FILE__) . '/footer.php'); ?>

        <script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/js/bootstrap.js"></script>
        <script src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/js/bootstrap.min.js"></script>
        <script>
        // very simple to use!
        $(document).ready(function() {
            $(function(){
                $(".dropdown").hover(
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                        $(this).toggleClass('open');
                        $('b', this).toggleClass("caret caret-up");
                    },
                    function() {
                        $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                            $(this).toggleClass('open');
                            $('b', this).toggleClass("caret caret-up");
                        });
                    }
                );
        });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage(); ?>