<?php 
$controller = Yii::$app->controller->id;
$action =  Yii::$app->controller->action->id;
$url = '/backend/'.$controller."/".$action;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Administrator</p>

                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>

        <!-- search form -->
       <!--  <form action="#" method="get" class="sidebar-form">
           <div class="input-group">
               <input type="text" name="q" class="form-control" placeholder="Search..."/>
             <span class="input-group-btn">
               <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
               </button>
             </span>
           </div>
       </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    
                    
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => ''],
                    ['label' => 'Dashboard', 'icon' => 'fa fa-dashboard', 'url' => ['/backend/']],
                   /* [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                    [
                        'label' => 'Vendor Manager',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Vendor Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/user/index/'],],
                        ['label' => 'Create Vendor', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/user/register/'],],
                        ],
                    ],
                     [
                        'label' => 'Category Manager',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/category/manager',
                        'items' => [
                        ['label' => 'Category Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/category/manager/'],'active' => $url == '/backend/category/manager'  | $url == '/backend/category/update' ? true : false | $url == '/backend/category/sort' ? true : false],
                        ['label' => 'Create Category', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/category/add/'],],

                        ],
                    ],
                    [
                        'label' => 'Product Manager',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/product/index/',
                        'items' => [
                        ['label' => 'Product Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/product/index/'],'active' => $url == '/backend/product/index'  | $url == '/backend/product/update' ? true : false | $url == '/backend/product/add-search-terms' ? true : false],
                        ['label' => 'Create Product', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/product/create/'],],

                        ],
                    ],
                     /*[
                        'label' => 'Unapproved Product',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/product/manager/',
                        'items' => [
                        ['label' => 'Unapproved Product Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/product/manager/'],'active' => $url == '/backend/product/manager'  | $url == '/backend/product/update1' ? true : false],
                        

                        ],
                    ], */   
                    
                          
                ],
            ]
        ) ?>

    </section>

</aside>
