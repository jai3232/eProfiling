<?php

namespace app\controllers;

use Yii;
use app\models\AgensiInstitut;
use app\models\Bidang;
use app\models\BidangInstitut;
use app\models\BidangInstitutSearch;
use app\models\PersonalPerjawatan;
use app\models\PersonalBidang;
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
        } 
        else {
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

    public function actionBidangList($id)
    { 
        //$instituts = BidangInstitut::find()->where(['id_agensi_institut' => $id])->orderBy('nama_institut')->all();
        $bidangs = Bidang::find()->joinWith('bidangInstituts')->where(['bidang_institut.id_agensi_institut' => $id])->orderBy('nama_bidang')->all();
        if(count($bidangs) > 0) {
            echo "<option value=\"\">- Sila Pilih -</option>";
            foreach($bidangs as $bidang){
                echo "<option value=\"".$bidang->id_bidang."\">".$bidang->nama_bidang."</option>";    
            }
        }
        else
            echo "<option> - </option>";
    }

    public function actionAbilitiMapInstitut($id,$idai,$idag)
    {
        $model = $this->findModel($id);//bidang institut
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
        return $this->render('abiliti_map_institut', [
                'model' => $model,//bidang institut
                'agensiInstitut'=>$agensiInstitut,
        ]);
    }

    public function actionAbilitiMapInstitutBulanTahun($id,$idai,$idag)
    {
        $model = $this->findModel($id);//bidang institut
        $agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
        
        if (Yii::$app->request->post()) {
            $request = Yii::$app->request;
            $bulan_tahun = $request->post('bulan_tahun');
            $bulan_tahun2 = $request->post('bulan_tahun2');
            return $this->render('abiliti_map_institut_bulan_tahun', [
                    'model' => $model,//bidang institut
                    'agensiInstitut'=>$agensiInstitut,
                    'bulan_tahun' => $bulan_tahun,
                    'bulan_tahun2' => $bulan_tahun2,
            ]);
        } 
        else {
            return $this->render('_form_bidang_institut_bulan_tahun', [
                    'model' => $model,
                    'agensiInstitut'=>$agensiInstitut,
            ]);
        }
        
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
