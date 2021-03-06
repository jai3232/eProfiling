<?php

namespace app\controllers;

use Yii;
use app\models\RefJenisKompetensi;
use app\models\Agensi;
use app\models\Bidang;
use app\models\BidangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BidangController implements the CRUD actions for Bidang model.
 */
class BidangController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Bidang models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->identity->accessLevel([0, 1, 2, 3]))
            return $this->redirect(['site/unauthorized']);
        $searchModel = new BidangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$model = Bidang::findOne(['id_agensi' => $idag]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bidang model.
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
     * Creates a new Bidang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bidang();
        $jenisKompetensi = new RefJenisKompetensi();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id_bidang]);
            return $this->redirect(['index', 'sort' => '-id_bidang'] );
        } else {
            return $this->render('create', [
                'model' => $model,
                'jenisKompetensi' => $jenisKompetensi,
            ]);
        }
    }

    /**
     * Updates an existing Bidang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $jenisKompetensi = new RefJenisKompetensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_bidang]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'jenisKompetensi' => $jenisKompetensi,
            ]);
        }
    }

    /**
     * Deletes an existing Bidang model.
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
     * Finds the Bidang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bidang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bidang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
