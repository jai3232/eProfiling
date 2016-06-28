<?php

namespace app\controllers;

use Yii;
use app\models\Agensi;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangDutiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidangDutiController implements the CRUD actions for BidangDuti model.
 */
class BidangDutiController extends Controller
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
     * Lists all BidangDuti models.
     * @return mixed
     */
    public function actionIndex($idbt, $idbi)
    {
        $searchModel = new BidangDutiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $bidangTier = BidangTier::findOne(['id_bidang_Tier' => $idbt]);
        $bidang = Bidang::findOne(['id_bidang' => $idbi]);
        //$agensi = Agensi::findOne(['id_agensi' => $bidang->id_agensi]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bidangTier' => $bidangTier,
            'bidang' => $bidang,
            //'agensi' => $agensi,
        ]);
    }

    /**
     * Displays a single BidangDuti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $bidangTier = BidangTier::findOne(['id_bidang_tier' => $model->id_bidang_tier]);
        $bidang = Bidang::findOne(['id_bidang' => $bidangTier->id_bidang]);

        return $this->render('view', [
            'model' => $model,
            'bidang' => $bidang,
        ]);
    }

    /**
     * Creates a new BidangDuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idbi, $idbt)
    {
        $model = new BidangDuti();

        $model->id_bidang_tier = $idbt;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id_bidang_duti]);
            return $this->redirect(['index', 'idbi' => $idbi, 'idbt' => $idbt, 'sort' => '-id_bidang_duti']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BidangDuti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bidangTier = BidangTier::findOne(['id_bidang_tier' => $model->id_bidang_tier]);
        $bidang = Bidang::findOne(['id_bidang' => $bidangTier->id_bidang]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_bidang_duti]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'bidang' => $bidang,
            ]);
        }
    }

    /**
     * Deletes an existing BidangDuti model.
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
     * Finds the BidangDuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BidangDuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BidangDuti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
