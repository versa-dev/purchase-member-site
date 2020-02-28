<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
     <link href="<?php echo Yii::$app->request->baseUrl; ?>/files/css/main.css" rel="stylesheet">
     <link href="<?php echo Yii::$app->request->baseUrl; ?>/files/css/bootstrap.css" rel="stylesheet">

   <link href="<?php echo Yii::$app->request->baseUrl; ?>/files/css/font-awesome.min.css" rel="stylesheet">
   <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
    <p><img src="<?php echo Yii::$app->request->baseUrl; ?>/files/images/logo-1.jpg" alt=""></p>
        <?php
       /* print_r(Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id)); 
        if (array_key_exists('admin', Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))) {
            echo  "asas";
            }
            die;*/

            NavBar::begin([
                 'brandLabel' => Html::img(Yii::$app->request->baseUrl.'/files/images/logo-1.jpg', ['alt'=>Yii::$app->name]),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Dashboard',  'url' => ['/dashboard'],'visible' =>  isset(Yii::$app->user->id),
                                      'options'=>['class'=>''],
                                      'template' => '<a href="{url}" class="has-submenu">{label}<span class="caret"></span></a>',

                                    ],
                    //['label' => 'Home', 'url' => ['/site/index']],
                 //  ['label' => 'Dashboard', 'url' => ['/dashboard'], 'visible' => key_exists("Client", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))],
                   // ['label' => 'Dashboard', 'url' => ['/dashboard'], 'visible' => key_exists("Supplier", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))],
                    //['label' => 'About', 'url' => ['/site/about']],
                    
                  Yii::$app->user->isGuest ?['label' => 'Login', 'url' => ['/site/login']] :
                                    ['label' => ucfirst(Yii::$app->user->identity->username), 'url' => ['#'],
                                    'options' => ['class' => ' has-submenu   last_shift'],
                                     'items' => [['label' => 'Backend', 'url' => ['/backend'], 'visible' => key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))],
                                         ['label' => 'User Manager', 'url' => ['/backend/user'], 'visible' => key_exists("admin", Yii::$app->getAuthManager()->getRolesByUser(Yii::$app->user->identity->id))],
                                         //  ['label' => 'Change password', 'url' => ['/site/change-password'], 'visible' => Yii::$app->user->id],
                                           ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],

                                        ],
                                            ],
                                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
           <!--  <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?> -->
              <?php 
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Dotsquares <?= date('Y') ?></p>
             <p class="pull-right">Develop by Dotsquares </p> 
        </div>
    </footer>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/files/js/bootstrap.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
