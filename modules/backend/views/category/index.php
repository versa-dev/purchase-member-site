
<?php
use yii\web\View;
echo "<ul  id='navigation' class='treeview-black'><li><a href='#'>All Categories</a>".(new \app\components\CategoryTree)->drawTree(0,1)."</li></ul>";
$str  ='$("#navigation").treeview({		
                             collapsed: true,
                             animated: "fast",
		persist: "cookie",
		cookieId: "treeview-black"
	});

';
$this->registerCssFile(yii\helpers\BaseUrl::base().'/js/treeview/jquery.treeview.css');
$this->registerJsFile(yii\helpers\BaseUrl::base(). '/js/treeview/lib/jquery.cookie.js',['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(yii\helpers\BaseUrl::base(). '/js/treeview/jquery.treeview.js',['position' => $this::POS_HEAD, 'depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs($str, View::POS_END, uniqid());
