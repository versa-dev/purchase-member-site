<?php

namespace app\modules\backend\controllers;

use Yii;
use app\models\MemberService;
use app\models\MemberServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberServiceController implements the CRUD actions for MemberService model.
 */
class MemberServiceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MemberService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MemberService model.
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
     * Creates a new MemberService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MemberService();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MemberService model.
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
     * Deletes an existing MemberService model.
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
     * Finds the MemberService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MemberService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemberService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionDownload($id)
    {   $model= \app\models\UploadInvoice::find()->where(['id'=>$id])->one();
        $path = Yii::getAlias("images/invoice/". $model->invoice_receipt);

          

           $filename = "$path";

             ob_clean();

            header("Cache-Control: no-store");

            header("Expires: 0");

            header("Content-Type: application/octet-stream");

            header("Content-disposition: attachment; filename=\"".basename($filename)."\"");

            header("Content-Transfer-Encoding: binary");

            header('Content-Length: '. filesize($filename));

            readfile($filename);

            die;
    }
    public function actionChangeStatus($id)
    {   
        $model = $this->findModel($id);
        $model->status=$_POST['MemberService']['status'];
        if($model->save()){
            Yii::$app->getSession()->setFlash('success', 'You have successfully change the status.');
            return $this->redirect(['index']);
        }
        
    }
}
