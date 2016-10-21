<?php

namespace app\controllers;

use Yii;
use app\models\AgensiInstitut;
use app\models\BidangInstitut;
//use app\models\Bidang;
use app\models\BidangInstitutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidangInstitutController implements the CRUD actions for BidangInstitut model.
 */
class BidangInstitutController extends Controller
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
     * Lists all BidangInstitut models.
     * @return mixed
     */
    public function actionIndex($idai)
    {
        $searchModel = new BidangInstitutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'agensiInstitut'=>$agensiInstitut,
        ]);
    }

    /**
     * Displays a single BidangInstitut model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$idai,$idag)
    {
      $model = $this->findModel($id);
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
        return $this->render('view', [
            'model' => $model,
            'agensiInstitut'=>$agensiInstitut,
        ]);
    }

    /**
     * Creates a new BidangInstitut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idai,$idag)
    {
        $model = new BidangInstitut();
        $model->id_agensi_institut = $idai;
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_bidang_institut,'idai' => $idai,'idag' => $idag]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'agensiInstitut'=>$agensiInstitut,
            ]);
        }
    }

    /**
     * Updates an existing BidangInstitut model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$idai,$idag)
    {
        $model = $this->findModel($id);
        $model->id_agensi_institut = $idai;
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id_bidang_institut,'idai' => $idai,'idag' => $idag]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'agensiInstitut'=>$agensiInstitut,
            ]);
        }
    }

    /**
     * Deletes an existing BidangInstitut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$idai,$idag)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index','idai' => $idai,'idag' => $idag]);
    }

    /**
     * Finds the BidangInstitut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BidangInstitut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BidangInstitut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
