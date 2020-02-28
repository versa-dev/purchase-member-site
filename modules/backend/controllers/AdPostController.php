<?php

namespace app\modules\backend\controllers;

use Yii;
use app\models\Country;
use app\models\ProductCategory;
use yii\helpers\ArrayHelper;
use app\models\AdPost;
use app\models\AdPostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdPostController implements the CRUD actions for AdPost model.
 */
class AdPostController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AdPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdPost model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdPost();
        $countries_list  = ArrayHelper::map(Country::find()->all(), 'id', 'nicename');
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>'0'])->all(), 'id', 'cat_name');
        //echo "<pre>"; print_r($cat_list); die;
        if ($model->load(Yii::$app->request->post())) {
        echo "<pre>";    print_r(Yii::$app->request->post());
        if(empty($_POST['AdPost']['sub_cat_id'])){
          $model->cat_id=$_POST['AdPost']['parent_cat_id'];
        }
        else{
            $model->cat_id=$_POST['AdPost']['sub_cat_id'];
        }
       if($model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        } else {
            return $this->render('create', [
                'model' => $model,
                'countries_list' =>$countries_list,
                'cat_list' => $cat_list,
            ]);
        }
    }
    public function actionSubcat($id)
    {
        
        $result=array();
        $cat_list  = ArrayHelper::map(ProductCategory::find()->where(['parent_id'=>$id])->all(), 'id', 'cat_name');
        $result[]= "<option value=''>Please choose sub category</option>";
        foreach ($cat_list as $key => $value) {
        $result[] .= "<option value=".$key.">".$value."</option>";
        }
       return $sub_cat= json_encode($result);
        //echo "<pre>"; print_r($sub_cat); 
        //die;
      
    }

    /**
     * Updates an existing AdPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdPost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
