<?php

namespace app\controllers;

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
    {   $this->layout='inner';
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->frontendsearch(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels();
        return $this->render('index', [
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
        $dataProvider = $searchModel->frontendsearch(Yii::$app->request->queryParams);
        $model=$dataProvider->getModels();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        return $this->render('index', [
                    'model' => $searchModel,
                    'searchModel'=>$model,
                  ]);*/
     
    }
    public function actionManager()
    {  $this->layout='inner';
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->unsearch(Yii::$app->request->queryParams);
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
    {  $this->layout='inner';
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
    {  $this->layout='inner';
        $model = new Product();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        $vendor  = ArrayHelper::map(User::find()->where(['usertype'=>'Vendor'])->all(), 'id', 'username');
        if ($model->load(Yii::$app->request->post())) {
            //$last_cat=end($_POST['Product']['category_id']);
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
    {  $this->layout='inner';
        $model = $this->findModel($id);
        //print_r($_POST); die;
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
       /* $cat= ProductCat::find()->Where(['product_id'=>$id])->one();
        $query=$this->fetchChildCategories($cat['category_id']);
        $str=rtrim($this->sam, "|");
        $str_data=explode("|",$str);
        if($str_data>0){ 
         
         } */
       if ($model->load(Yii::$app->request->post())) {
           if($model->save()){
             \app\components\EmailCenter::sendNewProductMail();
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
            $data=SearchTermCategory::find()->where(['category_id'=>$value,'product_id'=>$_POST['Product']['id']])->one();
             if(empty($data)){
                 $model= new SearchTermCategory();
                 $model->product_id=$_POST['Product']['id'];
                 $model->category_id=$value;
                 if($model->save()){

                 }
            }
        $j++;}
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
    public function actionSubcat($id='')
    {
        
        $result=array();
        if($id>0){
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$id])->all(), 'id', 'cat_name');
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
       return '<label style="padding:7px;float:left; font-size:12px;">No Record Found !</label>';
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
    {  $this->layout='inner';
        $model = $this->findModel($id);
        $vendor  = ArrayHelper::map(User::find()->where(['usertype'=>'Vendor'])->all(), 'id', 'username');
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        $cat= ProductCat::find()->Where(['product_id'=>$id])->one();
        $query=$this->fetchChildCategories($cat['category_id']);
        $str=rtrim($this->sam, "|");
        $str_data=explode("|",$str);
        if($str_data>0){ 
           // $str_data[]=$cat['category_id'];
         } 
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
                'cat'=>$str_data,
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
        if(empty($model->status)){
            $model->status = 1;
        }else{
             $model->status = 0;
        }
        
       
        if($model->save()){ 
           $message  = "$model->item_code been sucessfully ".(($model->status==0)?'blocked':'unblocked');
            Yii::$app->getSession()->setFlash('success',$message);
            if($model->status=='1'){
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['product/index']));}
            else{
               return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['product/manager'])); 
            }   
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
   

}
