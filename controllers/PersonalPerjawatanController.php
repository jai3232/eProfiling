<?php

namespace app\controllers;

use Yii;
use app\models\PersonalPerjawatan;
use app\models\PersonalPerjawatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AgensiInstitut;

/**
 * PersonalPerjawatanController implements the CRUD actions for PersonalPerjawatan model.
 */
class PersonalPerjawatanController extends Controller
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
     * Lists all PersonalPerjawatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonalPerjawatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonalPerjawatan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PersonalPerjawatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new PersonalPerjawatan();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_personal = $id;
            if($model->save())
            {
                echo 1;
            }
            //return $this->redirect(['view', 'id' => $model->id_personal_perjawatan]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PersonalPerjawatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo 2;
            //return $this->redirect(['view', 'id' => $model->id_personal_perjawatan]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionJawatanUpdateActive($id, $id_personal)
    {
        $perjawatans = PersonalPerjawatan::find()->where(['id_personal' => $id_personal])->all();

        foreach ($perjawatans as $perjawatan) {
            $perjawatan->is_aktif = 0;
            $perjawatan->save();
        }

        $model = $this->findModel($id);
        $model->is_aktif = 1;
        if(!$model->save())
            print_r($model->getErrors());
    }

    /**
     * Deletes an existing PersonalPerjawatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return 1;// $this->redirect(['index']);
    }

    public function actionList($id)
    {
        $instituts = AgensiInstitut::find()->where(['id_agensi' => $id])->orderBy('nama_institut')->all();
        if(count($instituts) > 0) {
            echo "<option value=\"\">Sila Pilih</option>";
            foreach($instituts as $institut){
                echo "<option value=\"".$institut->id_agensi_institut."\">".$institut->nama_institut."</option>";    
            }
        }
        else
            echo "<option> - </option>";
    }

    /**
     * Finds the PersonalPerjawatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonalPerjawatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonalPerjawatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
