<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryController
 *
 * @author Deepak Singh Kushwah
 */

namespace app\modules\backend\controllers;

use app\models;
use yii;
use app\models\HelpCategorySearch;
 // whole controller author "santosh joshi"
class HelpController extends \yii\web\Controller {
    var $sam = '';
    public function actionIndex() {
        return $this->render('index');
    }
    public function actionManager($id='') {
        $searchModel = new HelpCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $query=$this->fetchChildCategories($id); #print_r($query); die;
        
        return $this->render('manager', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'breadcrumbs'=>$this->sam,
        ]);
    }
    public function fetchChildCategories($parent_id='') {

        $sql = "SELECT id,parent_id FROM help_category WHERE id='$parent_id'";
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
      public function actionSort($id='') {
            if(!empty($id)){
            $model=\app\models\HelpCategory::find()->where(['parent_id'=>$id])->orderBY('orders ASC')->all();
            }
            else{
              $model=\app\models\HelpCategory::find()->where(['parent_id'=>0])->orderBY('orders ASC')->all();  
            }
                    if(!empty($_POST['order_sort'])){
                    $formdata = explode(",", $_POST['order_sort']);
                    $i=1;
                    
                    foreach ($formdata as  $value) { 
                    $sql="update  help_category set orders = '".$i."' WHERE id='".$value."'";
                    Yii::$app->db->createCommand($sql)->execute();
                    $i++;}
                    
                  
                    Yii::$app->getSession()->setFlash('success','Sucessfully save');
                    return $this->redirect(['manager','id'=>$id]);
                   
                    }
            return $this->render('sort', [
            'model' => $model,
            
        ]);
    }


    public function actionCreate() {
        $model = new models\HelpCategory();
        /*print_r(Yii::$app->request->post());
        die;*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('Category Saved');
            return $this->redirect(['index']);
        } else {
            return $this->render('_form', ['model' => $model]);
        }
    }
   
    public function actionAdd($id='') {  
        $model = new models\HelpCategory();
        /*print_r(Yii::$app->request->post());
        die;*/
        if ($model->load(Yii::$app->request->post())) {
            if(!empty($id)){
                $model->parent_id=$id;
            }
            $model->published=$_POST['HelpCategory']['published'];
            if($model->save()){
            Yii::$app->session->setFlash('Category Saved');
            return $this->redirect(['manager','id'=>$id]);
            }
        } else {
            return $this->render('_addform', ['model' => $model]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $model->published=$_POST['HelpCategory']['published'];
            if($model->save()){
            Yii::$app->session->setFlash('Category Update');
            return $this->redirect(['manager','id'=>$model->parent_id]);
            }
        } else {
            return $this->render('_addform', ['model' => $model]);
        }
    }

    public function actionDelete($id) {
        $cats = (new \app\components\CategoryTree)->getChildCategories($id);
        $catu = models\HelpCategory::findOne($id);
        if(count($cats) > 0){
           $cat_str = $id.','.implode(',', $cats);
            $cat_str=rtrim($cat_str, ',');
            Yii::$app->db->createCommand("DELETE FROM help_category WHERE id in (".$cat_str.")")->execute();
            Yii::$app->session->setFlash('success', 'Catagory has been deleted successfully.');
           return $this->redirect(['manager','id'=>$catu['parent_id']]); 
       }        
    }

    protected function findModel($id) {
        if (($model = models\HelpCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionStatus($id){

        $cat = models\HelpCategory::findOne($id);
        
        if(empty($cat)){
            Yii::$app->getSession()->setFlash('danger', 'No such category exists!');
            return $this->redirect('manager');
        }
        if(empty($cat->published)){
            $cat->published = 1;
        }else{
           echo  $cat->published = 0;
        }
        if($cat->save()){ 
            $message  = "$cat->cat_name has been sucessfully ".(($cat->published==0)?'blocked':'unblocked');
            Yii::$app->getSession()->setFlash('success',$message);
            return $this->redirect(Yii::$app->urlManager->createAbsoluteUrl(['backend/category/manager','id'=>$cat['parent_id']]));     
            
            
        }
    }

    

    

}
