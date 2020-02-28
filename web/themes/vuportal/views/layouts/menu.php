<?php
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\models\User;
?>
<header>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="logo">
          <a href="<?php echo Yii::$app->urlManager->createUrl(['/site']); ?>"><span class="logo-name">webpicid.com</span>
            <!-- <img src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/images/logo.png" alt=""> -->
          </a>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 text-right">
       <!--  <div class="social-icon">
          <ul>
            <li>
              <i class="fa fa-phone"></i>
              888.875.7787 | 855.220.8608
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="fa fa-facebook"></i>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="fa fa-instagram"></i>
              </a>
            </li>
            <li>
              <a href="javascript:void(0)">
                <i class="fa fa-youtube"></i>
              </a>
            </li>
          </ul>
        </div> -->
        <div class="linkset_user">
          <ul class="">

              <li>
              <?php if(yii::$app->user->id==1 && !empty(yii::$app->user->id)){ ?>
              <a href="<?php echo Yii::$app->urlManager->createUrl(['/backend/']); ?>">
                <i class="fa fa-user"></i>
                Dashboard
              </a>
              <?php } elseif(yii::$app->user->id!=1 && !empty(yii::$app->user->id)){?>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/dashboard/index']); ?>">
                <i class="fa fa-user"></i>
                Dashboard
              </a>
              
              <?php }else{?>
                
              <?php }?>
              </li>

            <li>
              <?php if(!empty(yii::$app->user->id)){ ?>
              <a href="<?php echo Yii::$app->urlManager->createUrl(['/site/logout']); ?>">
                <i class="fa fa-user"></i>
                Sign out
              </a>
              <?php } else{
                if(Yii::$app->controller->action->id=='request-password-reset'){?>
                  <a href="#login-box" class="linkset_user_login">
                <i class="fa fa-user"></i>
                Forgot Password
              </a>
              <?php }else{?>
              <a href="<?php echo Yii::$app->urlManager->createUrl(['/site']); ?>">
                <i class="fa fa-user"></i>
                Sign In
              </a>
              <?php }} ?>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- <?php
$controllerl = Yii::$app->controller;
$front_page = $controllerl->id.'/'.$controllerl->action->id;
$isHome = $front_page == 'site/index' ? true : false;
$isForgot= $front_page == 'site/request-password-reset' ? true : false;
$isReset= $front_page == 'site/reset-password' ? true : false;

if($isHome || $isForgot || $isReset) { ?>
  <div class="slider-part">
  <img src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/images/2.jpg" alt="..." class="img-responsive">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p>America's largest <a href="#0">aftermarket semi truck parts</a> super store</p>
        </div>
      </div>
    </div> 
  </div>
<?php } ?> -->