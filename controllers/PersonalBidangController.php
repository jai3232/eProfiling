<?php

namespace app\controllers;

use Yii;
use app\models\PersonalBidang;
use app\models\PersonalBidangSearch;
use app\models\PersonalPerjawatan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonalBidangController implements the CRUD actions for PersonalBidang model.
 */
class PersonalBidangController extends Controller
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
     * Lists all PersonalBidang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonalBidangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonalBidang model.
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
     * Creates a new PersonalBidang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new PersonalBidang();
        $perjawatan = PersonalPerjawatan::find()->where(['id_personal' => $id, 'is_aktif' => 1])->one();

        if ($model->load(Yii::$app->request->post())) {
            //print_r($perjawatan->attributes['id_personal_perjawatan']);
            $model->id_personal = $id;
            $model->id_personal_perjawatan = $perjawatan->attributes['id_personal_perjawatan'];
            if($model->save())
            {
                echo 1;
            }
            //return $this->redirect(['view', 'id' => $model->id_personal_bidang]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PersonalBidang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id_personal_bidang]);
            echo 2;
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionBidangUpdateActive($id, $id_personal) 
    {
        $bidangs = PersonalBidang::find()->where(['id_personal' => $id_personal])->all();

        foreach ($bidangs as $bidang) {
            $bidang->is_aktif = 0;
            $bidang->save();
        }

        $model = $this->findModel($id);
        $model->is_aktif = 1;
        $model->save();
    }

    /**
     * Deletes an existing PersonalBidang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return 1;//$this->redirect(['index']);
    }

    /**
     * Finds the PersonalBidang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonalBidang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonalBidang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
