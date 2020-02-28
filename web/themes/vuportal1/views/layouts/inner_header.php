<?php
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\models\User;
use app\models\UserProfile;
$model = UserProfile::findProfileByUserId(Yii::$app->user->id);
if($model->image){
  $pic_image=$model->image;
}
else {
  $pic_image='avtar.jpg';
}
$name=$model->first_name." ".$model->last_name;
?>
<div>
  <header>
         <div class="container-fluid">
          <div class="clearfix">
               
               <div class="logo-left">
                 <a href="<?php echo Yii::$app->urlManager->createUrl('site'); ?>"><img src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/images/logo.png"" alt="" class="logo-position"></a>
               </div>

            <div class="navbar-custom-menu">

              <ul class="nav navbar-nav user-dropdown">

                <li class="dropdown right-dropdown-user">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" class="" alt="User Image">
                    <span>Welcome <?php echo $name; ?></span>
                  </a>
                  <ul class="dropdown-menu with-arrow">
                    <!-- User image -->
                    <li class="user-header">
                        <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> 
                    </li>

                  </ul>
                </li>

              </ul>
            </div>
          </div>
          </div>
         </header>


         <section class="top-menu">
           <div class="container-fluid">
              <div class="float-right-menu">
               
               <span class="user-vendor-big">
                  <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" alt="">
                  <span class="user-name-big">
                  <?php echo $name; ?>
                  <a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/profile'); ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </span>
               </span>

               <span class="menu-right">
                  <nav class="navbar navbar-inverse" role="navigation">
                    <div class="menu-top">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                      </div>
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard'); ?>"><i class="fa fa-th-large"></i> Dashboard</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/profile'); ?>" data-placement="bottom" data-toggle="tooltip" title="Edit profile"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('product'); ?>" data-placement="bottom" data-toggle="tooltip" title="Manage product"><i class="fa fa-cog" aria-hidden="true"></i> Manage</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('product/create'); ?>" data-placement="bottom" data-toggle="tooltip" title="Create product"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/change-password'); ?>" data-placement="bottom" data-toggle="tooltip" title="Change password"><i class="fa fa-key" aria-hidden="true"></i> Password</a></li>
                        </ul>
                      </div>
                      <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                  </nav>
              </span>
             </div>
           </div> 
         </section>
</div>