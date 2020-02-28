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
$name=$model->first_name;
$models = User::findOne(Yii::$app->user->id);
$user_code= $models['user_code'];
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
    
    .nav>li {
    position: relative;
    display: inline-block;
        text-decoration: none;
    background-color: #eee;

}
.navbar-default{
	background: none !important;
	border: none !important;
}
.nav>li {
    position: relative;
    display: inline-block;
    text-decoration: none;
    background:none;
}
.navbar-default .navbar-nav>li>a {
    color: #fff;
    font-size: 15px;
    font-weight: bold;
}
.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    color: #fff;
     background:none; 
}

</style>

<div>
  <header>
         <div class="container-fluid">
           <div class="row">
          <div class="clearfix">
              <div class="col-md-2">
               <div class="logo-left">
                 <a href="<?php echo Yii::$app->urlManager->createUrl('site'); ?>"><img src="<?php echo Yii::$app->request->baseUrl; ?>/themes/vuportal/files/images/logo.png" alt="" class="logo-position"></a>
               </div>
               </div> 
              </div>
    <div class="col-sm-8">
       <div class="header-text"> <h3>Web Picture Identification Inc.</h3>
       <!--  <ul  class="nav nav-pills" style="margin-left: 30%;">
    <li class="active">
      <a  href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/welcome'); ?>">Home</a>
    </li>
    <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/about-us'); ?>">About Us</a>
  </li>
  <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/how-it-works'); ?>">How It Works</a>
</li>
<li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/member-service'); ?>">Member Services</a>
</li>
<li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-service'); ?>">Merchant Services</a>
</li>
</ul> -->
<nav class="navbar navbar-default"  style="margin-left: 30%;">
  
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
   
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/welcome'); ?>">Home <span class="sr-only">(current)</span></a></li>
          <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/about-us'); ?>">About Us</a>
         <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/how-it-works'); ?>">How It Works</a>
</li>
<li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/member-service'); ?>">Member Services</a>
</li>
<li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-service'); ?>">Merchant Services</a>
</li>
      </ul>
    
      
    </div><!-- /.navbar-collapse -->
 
</nav>
    </div>
   <!--   <div class="dropdown" style="float: right;">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Dropdown Example
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a  href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/welcome'); ?>">Home</a></li>
    <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/about-us'); ?>">About Us</a></li>
    <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/how-it-works'); ?>">How It Works</a></li>
    <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/member-service'); ?>">Member Services</a></li>
    <li><a href="<?php echo Yii::$app->getUrlManager()->createUrl('dashboard/merchant-service'); ?>">Merchant Services</a></li>
  </ul>
</div>  -->
  </div>
   
              

            <div class="navbar-custom-menu">

              <ul class="nav navbar-na">
                  <li class="user-header">
                      <img  class="img-thumbnail" src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" alt="User Image" width="100px" height="50px">
                  </li>
                  <li class="user-header">
                       <a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/welcome'); ?>"><i class="fa fa-th-large"></i> Welcome</a> 
                    </li>
                    <li class="user-header">
                       <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>"><i class="fa fa-th-large"></i> Sign out</a>
                    </li>

              <!--   <li class="right-dropdown-user">
                  <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" class="" alt="User Image">
                    <span>Sign out </span>
                  </a>
                   <ul class="dropdown-menu with-arrow">
                     User image 
                    <li class="user-header">
                        <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a> 
                    </li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/account-statement'); ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Account Statement</a></li>
                    <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/create-safe-purchase'); ?>"><i class="fa fa-suitcase" aria-hidden="true"></i> Safe Purchase</a></li>

                  </ul>-->
               

              </ul>
            </div>
          </div>
          </div>
             </header>
           </div>
      
        

        <!--  <section class="top-menu">
           <div class="container-fluid">
              <div class="float-right-menu" style="float: left;">
               
               <span class="user-vendor-big">
                  <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/profile/<?php echo $pic_image;?>" alt="">
                  <span class="user-name-big">
                  <?php echo $name.' (Your deposit code is: ' .$user_code.')'; ?>
                 <a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/profile'); ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a> 
                  </span>
               </span>

               <span class="menu-right">
                  <nav class="navbar navbar-inverse" role="navigation">
                    <div class="menu-top">
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                      </div>
                      
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard'); ?>"><i class="fa fa-th-large"></i> Dashboard</a></li>
                           <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard'); ?>"><i class="fa fa-th-large"></i> Family Protection</a></li>
                           <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard'); ?>"><i class="fa fa-th-large"></i> Merchent Sign Up</a></li>
                           <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/account-statement'); ?>"><i class="fa fa-th-large"></i>  Account Statement</a></li>
                           <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/create-safe-purchase'); ?>"><i class="fa fa-th-large"></i>  Safe Purchase</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('message'); ?>"><i class="fa fa-envelope"></i>Secure Message</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/my-plan'); ?>" data-placement="bottom" data-toggle="tooltip" title=" My Services"><i class="fa fa-cog" aria-hidden="true"></i> My Services</a></li>
                         
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('product'); ?>" data-placement="bottom" data-toggle="tooltip" title="Manage product"><i class="fa fa-cog" aria-hidden="true"></i> Manage</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('product/create'); ?>" data-placement="bottom" data-toggle="tooltip" title="Create product"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</a></li>
                          <li><a href="<?php echo Yii::$app->urlManager->createUrl('dashboard/change-password'); ?>" data-placement="bottom" data-toggle="tooltip" title="Change password"><i class="fa fa-key" aria-hidden="true"></i> Password</a></li> 
                        </ul> 
                      </div>
                      
                    </div>
                    
                  </nav>
              </span>
             </div>
           </div> 
         </section>-->
</div>