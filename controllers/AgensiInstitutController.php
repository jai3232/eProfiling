<?php

namespace app\controllers;

use Yii;
use app\models\AgensiInstitut;
use app\models\AgensiInstitutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AgensiInstitutController implements the CRUD actions for AgensiInstitut model.
 */
class AgensiInstitutController extends Controller
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
     * Lists all AgensiInstitut models.
     * @return mixed
     */
    public function actionIndex($idag = 0)
    {

        $searchModel = new AgensiInstitutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider = $searchModel->search(['id_agensi' => $idag]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionList($idag= 0)
    {
        $searchModel = new AgensiInstitutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider = $searchModel->search(['id_agensi' => $idag]);
        //print_r(Yii::$app->request->queryParams);
        //exit;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AgensiInstitut model.
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
     * Creates a new AgensiInstitut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idag)
    {
        $model = new AgensiInstitut();

        $model->id_agensi = $idag;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idag' => $model->id_agensi_institut]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'error' => $model->getErrors()
            ]);
        }
    }

    /**
     * Updates an existing AgensiInstitut model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idag' => $model->id_agensi_institut]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AgensiInstitut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['list', 'idag' =>  $model->id_agensi]);
    }

    /**
     * Finds the AgensiInstitut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AgensiInstitut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AgensiInstitut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
