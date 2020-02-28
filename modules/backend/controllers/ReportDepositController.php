<?php

namespace app\modules\backend\controllers;

use Yii;
use app\models\ReportDepositCanada;
use app\models\ReportDepositCanadaSearch;
use app\models\User;
use app\models\ReportDepositUsa;
use app\models\ReportDepositUsaSearch;
use app\models\ReportDepositEmt;
use app\models\ReportDepositEmtSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SafePurchaseController implements the CRUD actions for SafePurchase model.
 */
class ReportDepositController extends Controller
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
     * Lists all SafePurchase models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ReportDepositCanadaSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Displays a single SafePurchase model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    { //echo "Our Engineers are working"; die;
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new SafePurchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReportDepositCanada();
        $model->user_id=Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing SafePurchase model.
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
     * Deletes an existing SafePurchase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionVendor()
    {
        $searchModel = new ReportDepositCanada();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('vendor', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    /**
     * Finds the SafePurchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SafePurchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportDepositCanada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionImportcsv()
    {
        $model = new ReportDepositCanada();

        if ($model->load(Yii::$app->request->post())) {
            $date=date('Y-m-d h:i:s');
            $model->importfile = UploadedFile::getInstance($model, 'importfile');
            if(empty($model->importfile)){
                $model->addError('importfile', 'Please upload the file');
                return $this->render('importproduct', [
                    'model' => $model
                ]);
            }
            if($model->importfile->extension !='csv')
            {
                $model->addError('importfile', 'File formate should be csv');
                return $this->render('importproduct', [
                    'model' => $model
                ]);
            }
            $time = time();
            $model->importfile->saveAs('csv/' .$time. '.' . $model->importfile->extension);
            $importfile = 'csv/' .$time. '.' . $model->importfile->extension;
            $file_handle = fopen($importfile, 'r');
            while (!feof($file_handle) ) {
                $line_of_text[] = fgetcsv($file_handle, 1000, ",");
            }
            fclose($file_handle);
            $i=1; foreach ($line_of_text as $key => $value) {
                if($i!=1 && !empty($value)){
                    $sql = "INSERT INTO report_deposit_canada(user_id,amount,bank_name, payment_date_time,created_at,updated_at) VALUES ('$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$value[5]')";
                    $query = Yii::$app->db->createCommand($sql)->execute();
                }
            $i++;}
            Yii::$app->getSession()->setFlash('success','sucessfully import your file');
            return $this->redirect(['index']);
        } else {
            return $this->render('importproduct', [
                'model' => $model
            ]);
        }
    }

}
