<?php

namespace app\controllers;

use Yii;
use app\models\Agensi;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\BidangAbilitiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BidangAbilitiController implements the CRUD actions for BidangAbiliti model.
 */
class BidangAbilitiController extends Controller
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
     * Lists all BidangAbiliti models.
     * @return mixed
     */
    public function actionIndex($idbt, $idbi, $idbd)
    {
        $searchModel = new BidangAbilitiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $bidangDuti = BidangDuti::findOne(['id_bidang_duti' => $idbd]);
        $bidangTier = BidangTier::findOne(['id_bidang_Tier' => $idbt]);
        $bidang = Bidang::findOne(['id_bidang' => $idbi]);
        $agensi = Agensi::findOne(['id_agensi' => $bidang->id_agensi]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bidangDuti' => $bidangDuti,
            'bidangTier' => $bidangTier,
            'bidang' => $bidang,
            'agensi' => $agensi,
        ]);
    }

    /**
     * Displays a single BidangAbiliti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $bidangDuti = BidangDuti::findOne(['id_bidang_duti' => $model->id_bidang_duti]);
        $bidangTier = BidangTier::findOne(['id_bidang_tier' => $bidangDuti->id_bidang_tier]);
        $bidang = Bidang::findOne(['id_bidang' => $bidangTier->id_bidang]);

        return $this->render('view', [
            'model' => $model,
            'bidangDuti' => $bidangDuti,
            'bidangTier' => $bidangTier,
            'bidang' => $bidang,
        ]);
    }

    /**
     * Creates a new BidangAbiliti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idbd)
    {
        $model = new BidangAbiliti();

        $model->id_bidang_duti = $idbd;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_bidang_abiliti]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BidangAbiliti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bidangDuti = BidangDuti::findOne(['id_bidang_duti' => $model->id_bidang_duti]);
        $bidangTier = BidangTier::findOne(['id_bidang_tier' => $bidangDuti->id_bidang_tier]);
        $bidang = Bidang::findOne(['id_bidang' => $bidangTier->id_bidang]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_bidang_abiliti]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'bidangDuti' => $bidangDuti,
                'bidangTier' => $bidangTier,
                'bidang' => $bidang,
            ]);
        }
    }

    /**
     * Deletes an existing BidangAbiliti model.
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
     * Finds the BidangAbiliti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BidangAbiliti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BidangAbiliti::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
