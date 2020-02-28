<?php

namespace app\modules\backend\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ProductCategory;
use app\models\ProductCatSearch;
use app\models\User;
use app\models\ProductCat;
use app\models\SearchTermCategory;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    var $sam = '';
    var $sam_cat = '';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                  // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    { //echo date('Y-m-d'); die; 
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels(); //echo "<pre>"; print_r($model); die;
        if(isset($_GET['ProductSearch']['report']) && $_GET['ProductSearch']['report']==10){
        $this->export($model);
       }
       if(isset($_GET['ProductSearch']['report_search']) && $_GET['ProductSearch']['report_search']==10){
        $model_search=SearchTermCategory::find()->all();
         $this->exportsearch($model_search);
       }
       $user  = ArrayHelper::map(User::find()->where(['usertype'=>'Vendor'])->all(), 'id', 'username');
        return $this->render('index', [
            'searchModel'=>$model,
            'model' => $searchModel,
            'user'=>$user,
        ]);
        /*$searchModel = new ProductCatSearch();
        $cat =Yii::$app->request->queryParams;
        if(!empty($cat['ProductCatSearch']['category_id'])){
        $sub_cat_list=$cat['ProductCatSearch']['category_id'];
        $searchModel->category_id=end($cat['ProductCatSearch']['category_id']);
        }
        else{
            $sub_cat_list=array();
        }
        $dataProvider = $searchModel->frontendsearch(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        return $this->render('index', [
                    'model' => $searchModel,
                    'searchModel'=>$model,
                  ]);*/
     
    }
    public function export($model=''){
      require_once  str_replace('/',DIRECTORY_SEPARATOR,Yii::getAlias('@app/components/phpExcel/Classes/PHPExcel.php'));
        require_once  str_replace('/',DIRECTORY_SEPARATOR,Yii::getAlias('@app/components/phpExcel/Classes/PHPExcel/IOFactory.php'));
   
        $objPHPExcel = new \PHPExcel();        
        $styleArray = array(
        'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 14,
        'name'  => 'Verdana'
        ));
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
      
        // for font bold
          $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray);
          
        //   
        $objPHPExcel->getActiveSheet()->setTitle('Items Report')
         ->setCellValue('A1', 'Item Code')
         ->setCellValue('B1', 'Description_Sage')   
         ->setCellValue('C1', 'Description_Web')
         ->setCellValue('D1', 'Status')
         ->setCellValue('E1', 'ModificationStatus')
         ->setCellValue('F1', 'ProductCategory')
         ->setCellValue('G1', 'SE_Directory')
         ->setCellValue('H1', 'ID')
         ->setCellValue('I1', 'Modified');
        $row=2;
        $grand_total=0;
        if(!empty($model))
        {
            foreach ($model as $key => $value) {
            //$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$row-1); 
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$value['item_code']); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,ucwords($value['item_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,ucwords($value['description']));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,ucwords($value['status']));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$value['modification_status']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$value['product_category']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$value['se_directory']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$value['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$value['modified_date']);
            
                $row++ ;
           }
          
        }

        header('Content-Type: application/vnd.ms-excel');
        $filename = "Report.xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $objWriter->save('report/'.$filename);
        exit;
    }
    public function exportsearch($model=''){
      require_once  str_replace('/',DIRECTORY_SEPARATOR,Yii::getAlias('@app/components/phpExcel/Classes/PHPExcel.php'));
        require_once  str_replace('/',DIRECTORY_SEPARATOR,Yii::getAlias('@app/components/phpExcel/Classes/PHPExcel/IOFactory.php'));
   
        $objPHPExcel = new \PHPExcel();        
        $styleArray = array(
        'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 14,
        'name'  => 'Verdana'
        ));
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
      
        // for font bold
          $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray);
          $objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray);
          
        //   
        $objPHPExcel->getActiveSheet()->setTitle('Search Terms')
         ->setCellValue('A1', 'Item')
         ->setCellValue('B1', 'Parent')   
         ->setCellValue('C1', 'Child1')
         ->setCellValue('D1', 'Child2')
         ->setCellValue('E1', 'Child3')
         ->setCellValue('F1', 'Child4')
         ->setCellValue('G1', 'Child5')
         ->setCellValue('H1', 'Child6')
         ->setCellValue('I1', 'ID')
         ->setCellValue('J1', 'Modified');
        $row=2;
        $grand_total=0;
        if(!empty($model))
        {
            foreach ($model as $key => $value) {
              if(isset($value['parent_id'])){
                $parent_id=ProductCategory::find()->where(['id'=>$value['parent_id']])->one();
              }
              else{
               $parent_id['cat_name']=''; 
              }
              if(isset($value['child1'])){
                $child1=ProductCategory::find()->where(['id'=>$value['child1']])->one();
              }
              else{
                $child1['cat_name']='';
              }
              if(isset($value['child2'])){
                $child2=ProductCategory::find()->where(['id'=>$value['child2']])->one();
              }
              else{
                $child2['cat_name']='';
              }
              if(isset($value['child3'])){
                $child3=ProductCategory::find()->where(['id'=>$value['child3']])->one();
              }
              else{
                $child3['cat_name']='';
              }
              if(isset($value['child4'])){
                $child4=ProductCategory::find()->where(['id'=>$value['child4']])->one();
              }
              else{
                $child4['cat_name']='';
              }
              if(isset($value['child5'])){
                $child5=ProductCategory::find()->where(['id'=>$value['child5']])->one();
              }
              else{
                $child5['cat_name']='';
              }
              if(isset($value['child6'])){
                $child6=ProductCategory::find()->where(['id'=>$value['child6']])->one();
              }
              else{
                $child6['cat_name']='';
              }
            
            //$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$row-1); 
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$value['product_id']); 
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,ucwords($parent_id['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,ucwords($child1['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,ucwords($child2['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,ucwords($child3['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,ucwords($child4['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row,ucwords($child5['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$row,ucwords($child6['cat_name']));
            $objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$value['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$value['modified_date']);
            
                $row++ ;
           }
          
        }

        header('Content-Type: application/vnd.ms-excel');
        $filename = "Report.xls";
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        // $objWriter->save('report/'.$filename);
        exit;
    }
    public function actionManager()
    {  
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->unsearch(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels();
        return $this->render('manager', [
            'searchModel'=>$model,
            'model' => $searchModel,
        ]);
        /*$searchModel = new ProductCatSearch();
        $cat =Yii::$app->request->queryParams;
        if(!empty($cat['ProductCatSearch']['category_id'])){
        $sub_cat_list=$cat['ProductCatSearch']['category_id'];
        $searchModel->category_id=end($cat['ProductCatSearch']['category_id']);
        }
        else{
            $sub_cat_list=array();
        }
        $dataProvider = $searchModel->unapprovesearch(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        return $this->render('manager', [
                    'model' => $searchModel,
                    'cat_list'=>$cat_list,
                    'searchModel'=>$model,
                    'sub_cat_list'=>$sub_cat_list,
                   ]);*/
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {  
        /*$data= ProductCatSearch::find()->joinwith('product')->joinwith('category')->joinwith('user')->where(['product.id'=>$id])->one();*/
        $data= Product::find()->where(['product.id'=>$id])->one();
        //echo "<pre>"; print_r($data); die;
        return $this->render('view', [
            'model' => $data,
        ]);
    }
   
    

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {  
        $model = new Product();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        $vendor  = ArrayHelper::map(User::find()->where(['usertype'=>'Vendor'])->all(), 'id', 'username');
        if ($model->load(Yii::$app->request->post())) {
          $model->created_date=date('Y-m-d h:i:s');
            //$last_cat=end($_POST['Product']['category_id']);
            $model->published=1;
            $model->se_directory=$_POST['Product']['se_directory'];
            $model->status=$_POST['Product']['status'];
            $model->modification_status=$_POST['Product']['modification_status'];
            if($model->save()){
                /*$product_cat= new ProductCat();
                $product_cat->product_id=$model->id;
                $product_cat->category_id=$last_cat;
                $product_cat->save();*/
                
                //Yii::$app->getSession()->setFlash('success','successful added your product');
                return $this->redirect(['add-search-terms','id'=>$model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'cat_list'=>$cat_list,
                'vendor'=>$vendor,
            ]);
        }
    }
     public function actionAddSearchTerms($id)
    {  $model = $this->findModel($id);
        //print_r($_POST); die;
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0','published'=>1])->all(), 'id', 'cat_name');
       /* $cat= ProductCat::find()->Where(['product_id'=>$id])->one();
        $query=$this->fetchChildCategories($cat['category_id']);
        $str=rtrim($this->sam, "|");
        $str_data=explode("|",$str);
        if($str_data>0){ 
         
         } */
       if ($model->load(Yii::$app->request->post())) {
           if($model->save()){
            // \app\components\EmailCenter::sendNewProductMail();
            Yii::$app->getSession()->setFlash('success','successful updated');
            return $this->redirect(['index']);
           }
        } else {
            return $this->render('add-search-terms', [
                'model' => $model,
                'cat_list'=>$cat_list,

            ]);
        }
    }
    public function actionSearchterms()
    {
       if ($_POST) { 
        $j=0; 
       foreach ($_POST['Product']['category_id'] as $key => $value) {
             //fetchChildCategorieschild
        if($value>=1){
            $data=SearchTermCategory::find()->where(['category_id'=>$value,'product_id'=>$_POST['Product']['id']])->one();
             if(empty($data)){
                 $model= new SearchTermCategory();
                 $model->product_id=$_POST['Product']['id'];
                 $model->category_id=$value;
                 if($model->save()){

                 }
            }
        $j++;}}
        $query=SearchTermCategory::find()->where(['product_id'=>$_POST['Product']['id']])->all();
        $result = array();
        $strs='';
        foreach ($query as $key => $value) {
               $querys=$this->fetchChildCategoriesmain($value['category_id']);
               $str=rtrim($this->sam, "|"); 
               $str_data=explode("|",$str); 
               $queryses=array_reverse($str_data);
               $this->sam='';
               foreach ($queryses as  $values) { 
                $sql=ProductCategory::find()->where(['id'=>$values])->one();
                $strs .=$sql['cat_name'].'_';
               }
              
               $que = SearchTermCategory::findOne($value['id']);
               $que->category_id=end($queryses);
               $this->getChildr($queryses,$que);
               $que->add_tree=substr($strs,0,-1); 
               $strs='';
               if($que->save()){}
                  //unset($this->sam);
               
            
        }

         $query_cat=SearchTermCategory::find()->where(['product_id'=>$_POST['Product']['id']])->orderBy('add_tree asc')->all();
       foreach ($query_cat as $key => $cats) {
            //$sqls=ProductCategory::find()->where(['id'=>$cats['category_id']])->one();
            $result[]=$cats['add_tree'];          
       }
        //return $result;
        return json_encode($result);
     //  echo "<pre>"; print_r($result);
        die;
        
       }
        //
    }
    public function getChildr($cat='',$que='')
    { 
        if(count($cat)==1){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
            }
        }
            if(count($cat)==2){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
               $que->child1=$cat[1];
            }
        }
            if(count($cat)==3){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
               $que->child1=$cat[1];
               $que->child2=$cat[2];
            }
        }
            if(count($cat)==4){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
               $que->child1=$cat[1];
               $que->child2=$cat[2];
               $que->child3=$cat[3];
               
            }
        }
         if(count($cat)==5){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
               $que->child1=$cat[1];
               $que->child2=$cat[2];
               $que->child3=$cat[3];
               $que->child4=$cat[4];
               
               
            }
        }
         if(count($cat)==6){
            foreach ($cat as $key => $value) {
               $que->parent_id=$cat[0];
               $que->child1=$cat[1];
               $que->child2=$cat[2];
               $que->child3=$cat[3];
               $que->child4=$cat[4];
               $que->child5=$cat[5];
               $que->child6=$cat[6];
               
            }
        }
         
         
    }
    public function actionBulkSearchTerms()
    {
     $model= new SearchTermCategory();
     $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
     $product_list  = ArrayHelper::map(Product::find()->all(), 'id', 'item_code');
     if ($model->load(Yii::$app->request->post())) {
        $cat_search=$_POST['Product']['category_id'];
        $product_id=$_POST['SearchTermCategory']['product_id'];
        if(empty($product_id)){
        $model->addError('product_id', 'Please choose items');
        return $this->render('bulk-search-terms', [
        'model' => $model,
        'cat_list'=>$cat_list,
        'product_list'=>$product_list
         ]);
        }
        else{
            $last_cat=end($cat_search);
            $strss='';
            foreach ($product_id as $key => $value) {
               foreach ($cat_search as $cat_id) {
                if($cat_id>0){
                
               $data=SearchTermCategory::find()->where(['category_id'=>$cat_id,'product_id'=>$value])->one();
              
               $querys=$this->fetchChildCategoriesmain($cat_id);
               $str=rtrim($this->sam, "|"); 
               $str_data=explode("|",$str); 
               $queryses=array_reverse($str_data); 
               $this->sam='';
               foreach ($queryses as  $values) { 
                $sql=ProductCategory::find()->where(['id'=>$values])->one();
                $strss .=$sql['cat_name'].'_';
               }
               if(empty($data)){
                   $model= new SearchTermCategory(); 
                   $model->add_tree=substr($strss,0,-1);
                   $model->category_id=end($queryses);  
                   $this->getChildrbulk($queryses,$model,$value);
                   $strss='';
                   if($model->save()){} 
               }
               }
            }
            /*$data_pro=SearchTermCategory::find()->where(['product_id'=>$value])->all();
            $sam_str='';
            foreach ($data_pro as $data_pros) {
                $sam_str .=$data_pros['add_tree']."\r\n";
            }
            $search_wo=nl2br($sam_str);
             $sql="update  product set search_word = '".nl2br($search_wo)."' WHERE id='".$value."'";
            Yii::$app->db->createCommand($sql)->execute();
            $sam_str='';*/
            } 
      }
     Yii::$app->getSession()->setFlash('success','successful created search terms  ');
            return $this->redirect(['index']);
        
     }
    else {
        return $this->render('bulk-search-terms', [
        'model' => $model,
        'cat_list'=>$cat_list,
        'product_list'=>$product_list
         ]);
    }
    }
    public function getChildrbulk($cat='',$model='',$product_id)
    { 
        if(count($cat)==1){
            
               $model->parent_id=$cat[0];
               $model->product_id=$product_id;
        }
            if(count($cat)==2){
           
               $model->parent_id=$cat[0];
               $model->child1=$cat[1];
               $model->product_id=$product_id;
        }
            if(count($cat)==3){ 
              $model->parent_id=$cat[0];
              $model->child1=$cat[1];
              $model->child2=$cat[2];
              $model->product_id=$product_id;
        }
            if(count($cat)==4){
            
               $model->parent_id=$cat[0];
               $model->child1=$cat[1];
               $model->child2=$cat[2];
               $model->child3=$cat[3];
               $model->product_id=$product_id;
        }
         if(count($cat)==5){
          
               $model->parent_id=$cat[0];
               $model->child1=$cat[1];
               $model->child2=$cat[2];
               $model->child3=$cat[3];
               $model->child4=$cat[4];
               $model->product_id=$product_id;
       }
         if(count($cat)==6){
           
               $model->parent_id=$cat[0];
               $model->child1=$cat[1];
               $model->child2=$cat[2];
               $model->child3=$cat[3];
               $model->child4=$cat[4];
               $model->child5=$cat[5];
               $model->child6=$cat[6];
               $model->product_id=$product_id;
        }
         
         
    }
    public function actionProcat()
    { 
        
        $result=array();
        if(!empty($_POST['id'])){
        $cat_list  = ArrayHelper::map(Product::find()->where(['id'=>$_POST['id']])->all(), 'id', 'id');
        }
        else{
         $cat_list  = ArrayHelper::map(Product::find()->all(), 'id', 'id');   
        }
        $result = "<option value=''>Choose Items</option>";
        foreach ($cat_list as $key => $value) {
        $result .= "<option value=".$key.">".$value."</option>";
        }
        return $result;
       
    }
    public function actionSubcat($id='')
    {
        
        $result=array();
        if($id>0){
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$id,'published'=>1])->all(), 'id', 'cat_name');
         }
        
        if(!empty($cat_list)){
        $result="<select name='Product[category_id][]' class='form-control parent'>";
        $result .= "<option value=''>Please choose sub category</option>";
        foreach ($cat_list as $key => $value) {
        $result .= "<option value=".$key.">".$value."</option>";
        }
        $result .="</select>";
        return $result;
       }
       else{
       return '<label style="padding:7px;float:left; font-size:12px;"></label>';
       }
        //echo "<pre>"; print_r($result); die;
       //return $sub_cat= json_encode(array('data'=>$result));
        //echo "<pre>"; print_r($sub_cat); 
        //die;
        //sub_class_".$id."
      
    }
    public function actionSubcates($id='')
    {
        
        $result=array();
        if($id>0){
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$id])->all(), 'id', 'cat_name');
         }
        
        if(!empty($cat_list)){
        $result="<select name='ProductCatSearch[category_id][]' class='form-control parent'>";
        $result .= "<option value=''>Please choose sub category</option>";
        foreach ($cat_list as $key => $value) {
        $result .= "<option value=".$key.">".$value."</option>";
        }
        $result .="</select>";
        return $result;
       }
       else{
       return '<label style="padding:7px;float:left; font-size:12px;">No Record Found !</label>';
       }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {  
        $model = $this->findModel($id);
        $vendor  = ArrayHelper::map(User::find()->where(['usertype'=>'Vendor'])->all(), 'id', 'username');
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        //$cat= ProductCat::find()->Where(['product_id'=>$id])->one();
        //$query=$this->fetchChildCategories($cat['category_id']);
        //$str=rtrim($this->sam, "|");
        //$str_data=explode("|",$str);
        //if($str_data>0){ 
           // $str_data[]=$cat['category_id'];
        // } 
       // print_r($str_data); die;
        if ($model->load(Yii::$app->request->post())) {
            //$last_cat=end($_POST['Product']['category_id']); 
           if($model->save()){
             //$sql="update  product_cat set category_id = '".$last_cat ."' WHERE product_id='".$model->id."'";
             //Yii::$app->db->createCommand($sql)->execute();
                /*$product_cat= new ProductCat();
                $product_cat->product_id=$model->id;
                $product_cat->category_id=$last_cat;
                $product_cat->save();*/
            //Yii::$app->getSession()->setFlash('success','successful updated');
            return $this->redirect(['add-search-terms','id'=>$id]);
           }
        } else {
            return $this->render('update', [
                'model' => $model,
               // 'cat'=>$str_data,
                'vendor'=>$vendor,
                'cat_list'=>$cat_list,

            ]);
        }
    }
   
     public function fetchChildCategories($parent_id='') {

        $sql = "SELECT id,parent_id FROM product_category WHERE id='$parent_id'";
        $published_only=1;
        if ($published_only) {
            $sql.=" AND published='1' ";
        }
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $ids_array=array();
        if ($result && count($result) > 0) {
            $this->sam.= $result['id'] . "|";
                $this->fetchChildCategories($result['parent_id']);
        } else {
            
        }

       //return $ids_array;
    }
    public function fetchChildCategoriesmain($parent_id='') {

        $sql = "SELECT id,parent_id FROM product_category WHERE id='$parent_id'";
        $published_only=1;
        if ($published_only) {
            $sql.=" AND published='1' ";
        }
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $ids_array=array();
        if ($result && count($result) > 0) {
            $this->sam.= $result['id'] . "|";
            $this->fetchChildCategoriesmain($result['parent_id']);
        } else {
            
        }

       //return $ids_array;
    }
    public function fetchChildCategorieschild($parent_id='') {

        $sql = "SELECT id,parent_id FROM product_category WHERE id='$parent_id'";
        $published_only=1;
        if ($published_only) {
            $sql.=" AND published='1' ";
        }
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $ids_array=array();
        if ($result && count($result) > 0) {
            $this->sam_cat.= $result['id'] . "|";
            $this->fetchChildCategorieschild($result['parent_id']);
        } else {
            
        }

       //return $ids_array;
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('success','successful deleted');
        return $this->redirect(Yii::$app->request->referrer);
        //return $this->redirect(['index']);
    }
    public function actionDeletesearchkey($product_id)
    { 
        //SearchTermCategory::findOne($id)->delete();
        /*$data_pro=SearchTermCategory::find()->where(['product_id'=>$product_id])->orderBy('add_tree asc')->all();*/
        SearchTermCategory::deleteAll('product_id = :product_id', [':product_id' =>$product_id]);
        //Yii::$app->getSession()->setFlash('success','successful deleted');
        return $this->redirect(Yii::$app->request->referrer);
        
        
        //return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
      public function actionStatus($id){

        $model = $this->findModel($id); 
        $model->category_id="hello";
       if(empty($model)){
            Yii::$app->getSession()->setFlash('danger', 'No such category exists!');
            return $this->redirect('index');
        }
        if(empty($model->published)){ 
            $model->published = 1;
        }else{ 
             $model->published = 0;
        }
        
       
        if($model->save()){ 
           $message  = "$model->item_code been sucessfully ".(($model->published==0)?'blocked':'unblocked');
            Yii::$app->getSession()->setFlash('success',$message);
             return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['backend/product/index']));
           /* if($model->published=='1'){
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['backend/product/index']));}
            else{
               return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['backend/product/manager'])); 
            } */  
        }
    }
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionHello(){
     return $this->render('hello');
    }
   

}
