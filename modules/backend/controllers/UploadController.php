<?php

namespace app\modules\backend\controllers;

use Yii;
use app\models\Upload;
use app\models\UploadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UploadController implements the CRUD actions for Upload model.
 */
class UploadController extends Controller
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
     * Lists all Upload models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UploadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Upload model.
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
     * Creates a new Upload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Upload();
       // $model->scenario='create';
        $model->user_id=yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
             $model->image = UploadedFile::getInstance($model, 'image'); 
           
            if($model->save()){
                $model->image->saveAs('upload_data/' . $model->image->baseName . '.' . $model->image->extension);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    
    }

    /**
     * Updates an existing Upload model.
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
     * Deletes an existing Upload model.
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
     * Finds the Upload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Upload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Upload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


     /*public function actionCreate()
    {
        $model = new Upload();
        $model->user_id=yii::$app->user->id;
     $destination_img=realpath(dirname(__FILE__).'/../../../').'/web/upload_data/'.$_FILES['Upload']['name']['image'];
         $d = $this->compress($_FILES['Upload']['tmp_name']['image'], $destination_img, 90);
    
            return $this->render('create', [
                'model' => $model,
            ]);
       
    
    }

    
   public function compress($source, $destination, $quality) { 
    $info = getimagesize($source); if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source); 
    elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source); 
    elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source); 
    imagejpeg($image, $destination, $quality); return $destination;
     }*/
}
