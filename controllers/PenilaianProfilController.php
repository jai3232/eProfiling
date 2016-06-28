<?php

namespace app\controllers;

use Yii;
use app\models\PenilaianProfil;
use app\models\PenilaianProfilSearch;
use app\models\PenilaianMarkah;
use app\models\PersonalBidang;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use yii\data\ActiveDataProvider;

/**
 * PenilaianProfilController implements the CRUD actions for PenilaianProfil model.
 */
class PenilaianProfilController extends Controller
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
     * Lists all PenilaianProfil models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenilaianProfilSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenilaianProfil model.
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
     * Creates a new PenilaianProfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = 0, $op = '')
    {   
        if($op == 'new' && $this->findAbility() == 0) { // if ability is not available
            return $this->redirect(['index', 'ability' => 0]);
        }

        $id_personal = Yii::$app->user->identity->id_personal;
        $personal_bidang = PersonalBidang::findOne(['id_personal' => $id_personal, 
                                                       'is_aktif' => 1
                                                  ]);
        if(count($personal_bidang) == 0)
            $personal_bidang = PersonalBidang::find()->where(['id_personal' => $id_personal])
                                                     ->orderBy(['id_personal_bidang' => SORT_DESC])->one();

        $id_personal_bidang = $personal_bidang->attributes['id_personal_bidang'];
        $id_bidang = $personal_bidang->attributes['id_bidang'];

        $bidang_abilitis = $this->findAbilities($id_bidang);

        $dataProvider = new ActiveDataProvider([
            'query' => $bidang_abilitis,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);



        if($op == 'new' && $this->findAbility() > 0 && Yii::$app->request->post()) {
            $model = new PenilaianProfil();
            
            $model->id_personal_bidang = $id_personal_bidang;

            if(!$model->save())
                return print_r($model->getErrors());

            $penilai_profil = PenilaianProfil::find()->where(['id_personal_bidang' => $id_personal_bidang])
                                                     ->orderBy(['id_penilaian_profil' => SORT_DESC])->one();
            
            $id_penilaian_profil = $penilai_profil->attributes['id_penilaian_profil'];

            //return $this->redirect(['evaluation', 'id_penilaian_profil' => $id_penilaian_profil, 'id_bidang' => $id_bidang]);
            return $this->render('evaluation', [
                'id_penilaian_profil' => $id, 
                'id_bidang' => $id_bidang,
                'dataProvider' => $dataProvider
            ]);
        }

        $penilai_profil = PenilaianProfil::findOne(['id_penilaian_profil' => $id]);//->where();
        $id_personal_bidang = $penilai_profil->attributes['id_personal_bidang'];
        $personal_bidang = PersonalBidang::findOne(['id_personal_bidang' => $id_personal_bidang]);
        $id_bidang = $personal_bidang->attributes['id_bidang'];

        $bidang_abilitis = $this->findAbilities($id_bidang);

        $dataProvider = new ActiveDataProvider([
            'query' => $bidang_abilitis,
            'pagination' => false,
            // 'pagination' => [
            //     'pageSize' => 10,
            // ]
        ]);

        return $this->render('evaluation', [
            'id_penilaian_profil' => $id, 
            'id_bidang' => $id_bidang,
            'dataProvider' => $dataProvider
        ]);

        //print_r($id_personal_bidang->attributes['id_personal_bidang']);
        //$id = $model->getIdPersonalBidang()->link['id_personal_bidang'];
        //print_r($id);

        //var_dump(Yii::$app->user->identity->id_personal);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id_penilaian_profil]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    public function actionEvaluation()
    {
        $scores = Yii::$app->request->post();
        if($scores) {
            $id_penilaian_profil = $scores['id_penilaian_profil'];
           
            foreach ($scores as $key => $value) {
                if(is_numeric($key)) {
                    $ada_penilaian = PenilaianMarkah::findAll(['id_penilaian_profil' => $id_penilaian_profil,
                                                               'id_bidang_abiliti' => $key,
                    ]);
                    if(count($ada_penilaian) > 0) {
                        $penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil,
                                                               'id_bidang_abiliti' => $key,
                        ]);
                        $penilaian_markah->markah = $value;
                        if(!$penilaian_markah->save())
                            return print_r($penilaian_markah->getErrors());
                    }
                    else { 
                        $penilaian_markah = new PenilaianMarkah();
                        $penilaian_markah->id_penilaian_profil = $id_penilaian_profil;
                        $penilaian_markah->id_bidang_abiliti = $key;
                        $penilaian_markah->markah = $value;
                        if(!$penilaian_markah->save())
                            return print_r($penilaian_markah->getErrors());
                    }
                }
            }
        }
    }

    /**
     * Updates an existing PenilaianProfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_penilaian_profil]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PenilaianProfil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteProfile($id)
    {
        if($penilaian_markah = PenilaianMarkah::deleteAll(['id_penilaian_profil' => $id]))
            $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenilaianProfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenilaianProfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenilaianProfil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // Function to get total ability in a Bidang
    protected function findAbility()
    {

        $id_personal = Yii::$app->user->identity->id_personal;
        $personal_bidang = PersonalBidang::findOne(['id_personal' => $id_personal, 
                                                       'is_aktif' => 1
                                                  ]);
        if(count($personal_bidang) == 0)
            $personal_bidang = PersonalBidang::find()->where(['id_personal' => $id_personal])
                                                     ->orderBy(['id_personal_bidang' => SORT_DESC])->one();

        if(count($personal_bidang) == 0)
            return 0;//$this->render('message', ['msg' => 'Tiada Bidang Dimasukkan']);

        $id_personal_bidang = $personal_bidang->attributes['id_personal_bidang'];
        $id_bidang = $personal_bidang->attributes['id_bidang'];
        $bidang_tiers = BidangTier::findAll(['id_bidang' => $id_bidang]);

        if(count($bidang_tiers) > 0) {
            $i = 0;
            foreach ($bidang_tiers as $bidang_tier) {
                $id_bidang_tier_array[$i] = $bidang_tier->attributes['id_bidang_tier'];
                $i++;
            }

            $bidang_dutis = BidangDuti::find()->where(['id_bidang_tier' => $id_bidang_tier_array])->all();

            if(count($bidang_dutis) > 0) {
                $i = 0;
                foreach ($bidang_dutis as $bidang_duti) {
                    $id_bidang_duti_array[$i] = $bidang_duti->attributes['id_bidang_duti'];
                    $i++;
                }


                $bidang_abilitis = BidangAbiliti::find();//->where(['id_bidang_abiliti' => $id_bidang_duti_array]);
                return count($bidang_abilitis);
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }
        
    }

    protected function findAbilities($id_bidang)
    {
        $bidang_tiers = BidangTier::findAll(['id_bidang' => $id_bidang]);

        if(count($bidang_tiers) > 0) {
            $i = 0;
            foreach ($bidang_tiers as $bidang_tier) {
                $id_bidang_tier_array[$i] = $bidang_tier->attributes['id_bidang_tier'];
                $i++;
            }

            $bidang_dutis = BidangDuti::find()->where(['id_bidang_tier' => $id_bidang_tier_array])->all();

            if(count($bidang_dutis) > 0) {
                $i = 0;
                foreach ($bidang_dutis as $bidang_duti) {
                    $id_bidang_duti_array[$i] = $bidang_duti->attributes['id_bidang_duti'];
                    $i++;
                }

                $bidang_abilitis = BidangAbiliti::find()->where(['id_bidang_duti' => $id_bidang_duti_array]);
            }
        }

        if(!isset($bidang_abilitis))
            $bidang_abilitis = BidangAbiliti::find()->where(['id_bidang_duti' => -1]);

        return $bidang_abilitis;
    }
}