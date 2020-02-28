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
                        'label' => 'User Manager',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'User Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/user/index/'],],
                        ['label' => 'Create User', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/user/register/'],],
                        ],
                    ],
                    [
                        'label' => 'Member Services',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Member Services Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/member-service/index/'],],
                        
                        ],
                    ],
                    [
                        'label' => 'Account Statement',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Account Statement Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/account-statement/index/'],],
                        
                        ],
                    ],
                    [
                        'label' => 'Report Deposit',
                        'icon' => 'fa fa-user',
                        'url' => '/backend/category/manager',
                        'items' => [
                            ['label' => 'Payment in Canada', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/report-deposit/index/'],],
                            ['label' => 'Payment in USA', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/report-deposit-usa/index/'],],
                            ['label' => 'Payment in Emt', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/report-deposit-emt/index/'],],
                        ],
                    ],
                    [
                        'label' => 'Safe Purchase',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Safe Purchase Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/safe-purchase/index/'],],
                        ['label' => 'Vendor name', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/safe-purchase/vendor'],]
                        ],
                    ],
                     [
                        'label' => 'Merchant Sign Up',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Merchant Sign Up', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/merchant-signup/index/'],],
                        
                        ],
                    ],
                     [
                        'label' => 'Message',
                        'icon' => 'fa fa-user',
                        'url' => '#',
                        'items' => [
                        ['label' => 'Message Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/message/index/'],],
                        ['label' => 'Compose Message', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/message/compose/'],],
                        ['label' => 'All Send Messages', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/message/all-send-message/'],],
                        
                        ],
                    ],
                    
                    /* [
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
                    [
                        'label' => 'Status Manager',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/status/index/',
                        'items' => [
                        ['label' => 'Status Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/status/index/'],'active' => $url == '/backend/status/index'  | $url == '/backend/status/update' ? true : false],
                        ['label' => 'Create Status', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/status/create/'],],
                        

                        ],
                    ],

                    [
                        'label' => 'Modification Status Manager',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/modification-status/index/',
                        'items' => [
                        ['label' => 'Modification Status Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/modification-status/index/'],'active' => $url == '/backend/modification-status/index'  | $url == '/backend/modification-status/update' ? true : false],
                        ['label' => 'Create modification-status', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/modification-status/create/'],],
                        

                        ],
                    ], 
                    [
                        'label' => 'Se-directory Manager',
                        'icon' => 'fa fa-bars',
                        'url' => '/backend/se-directory/index/',
                        'items' => [
                        ['label' => 'Se-directory Manager', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/se-directory/index/'],'active' => $url == '/backend/se-directory/index'  | $url == '/backend/se-directory/update' ? true : false],
                        ['label' => 'Create se-directory', 'icon' => 'fa fa-angle-double-right', 'url' => ['/backend/se-directory/create/'],],
                        

                        ],
                    ],   
                    */
                          
                ],
            ]
        ) ?>

    </section>

</aside>
