<?php

namespace app\controllers;

use Yii;
use app\models\Personal;
use app\models\PersonalSearch;
use app\models\Agensi;
use app\models\AgensiInstitut;
use app\models\PersonalPerjawatan;
use app\models\PersonalKelulusan;
use app\models\PersonalBidang;
use app\models\PenilaianProfil;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii2mod\editable\EditableAction;

/**
 * PersonalController implements the CRUD actions for Personal model.
 */
class PersonalController extends Controller
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
     * Lists all Personal models.
     * @return mixed
     */

     public function actions()
    {
        return [
            'change-id-personal' => [
            'class' => EditableAction::className(),
            'modelClass' => Personal::className(),
            'forceCreate' => false
            ]
        ];
    }

    public function actionIndex()
    {
        // $personal_bidangs = PersonalBidang::findAll(['id_personal' => 45]);
        // if(count($personal_bidangs) > 0) {
        //     $i = 0;
        //     foreach ($personal_bidangs as $personal_bidang) {
        //         $id_personal_bidang_array[$i] = $personal_bidang->attributes['id_personal_bidang'];
        //         $i++;
        //     }
        //     $penilaian_profils = PenilaianProfil::find()->all();

        //     if(count($penilaian_profils)) {
        //         foreach ($penilaian_profils as $penilaian_profil) {
        //             $id_penilaian_profil_array[$i] = $penilaian_profil->attributes['id_penilaian_profil'];
        //             $i++;   
        //         }
        //     }
        //     else
        //         $id_penilaian_profil_array = -1;
        // }
        // else
        //     $id_penilaian_profil_array = -1;
        // return print_r($id_penilaian_profil_array);

        
        if(!Yii::$app->user->identity->accessLevel([0, 1, 2, 3]))
            return $this->redirect(['site/unauthorized']);
        $searchModel = new PersonalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Personal model.
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
     * Creates a new Personal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        return $this->redirect(['index', 'sort' => '-id_personal']);
        $model = new Personal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_personal]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Personal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if($model->image_file) {
                $model->image_file->saveAs('uploads/'.$model->no_kp.'.'.$model->image_file->extension);
                $model->gambar_personal = $model->no_kp.'.'.$model->image_file->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_personal]);
        } else {
            print_r($model->getErrors());
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate2($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->image_file = UploadedFile::getInstance($model, 'image_file');
            if($model->image_file) {
                $model->image_file->saveAs('uploads/'.$model->no_kp.'.'.$model->image_file->extension);
                $model->gambar_personal = $model->no_kp.'.'.$model->image_file->extension;
            }
            $model->save();
            return $this->redirect(['info', 'id' => $model->id_personal]);
        } else {
            print_r($model->getErrors());
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateActive($id, $checked)
    {
        $model = $this->findModel($id);
        if($checked == '0')
            $model->aktif = 1;
        else
            $model->aktif = 0;
        $model->save();
    }

    public function actionUpdateAccess($id)
    {
        $model = $this->findModel($id);
        $val = Yii::$app->request->post('val');

        $model->tahap_akses = $val;
        if($model->save())
            return 1;
        else {
            return print_r($model->getErrors());
        }
    }

    public function actionUpdateSupervisor($id, $value='')
    {
        //$id = Yii::$app->request->get('id');
        //$value = Yii::$app->request->get('value');
        //return $id;
        $model = $this->findModel($id);
        $model->id_personal_penyelia = $value;

        if($model->save())
            return 1;
        else {
            return print_r($model->getErrors());
        }
    }

    // public function actionUpdateStatus($id)
    // {
    //     $model = $this->findModel($id);
    //     //$model->tahap_akses = $val;
    //     //$model->save();
    //     return $val;
    // }

    /**
     * Deletes an existing Personal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheck()
    {
        
        $model = new Personal();
        if(Yii::$app->request->post()) {
            $no_kp = Yii::$app->request->post()['Personal']['no_kp'];
            $result = $model->findOne(['no_kp' => $no_kp]);
            
            if(count($result) == 0) {
                return $this->redirect(['personal/register', 'no_kp' => $no_kp, 'model' => $model]);
                //return $this->render('register', ['no_kp' => $no_kp, 'model' => $model]);
            }
            else
                return $this->render('registered', ['model' => $result, 'no_kp' => $no_kp]);  
        }
        else
            return $this->render('check', ['model' => $model]);
    }

    public function actionRegister()
    {
        //$x = new \yii\captcha\CaptchaAction($this->id, 'personal', []);
        //return $x->getVerifyCode();
        $model = new Personal();
        $agensi = new Agensi();
        $perjawatan = new PersonalPerjawatan();
        if(Yii::$app->request->post()) {
            $no_kp = Yii::$app->request->post()['Personal']['no_kp'];
            $result = $model->findOne(['no_kp' => $no_kp]);
            if(count($result) > 0)
                return $this->render('registered', ['model' => $model]);
            
            if(isset(Yii::$app->request->post()['Personal']['emel'])) {
                $personal_email = Yii::$app->request->post()['Personal']['emel'];
                $password = substr(md5(time()), 26);
                // if($model->load(Yii::$app->request->post()) && $model->save()) {
                //     $id_personal = $model->findOne(['no_kp' => Yii::$app->request->post()['Personal']['no_kp']])->id_personal;
                //     $perjawatan->id_personal = $id_personal;
                //     $perjawatan->id_agensi_institut = Yii::$app->request->post()['PersonalPerjawatan']['id_agensi_institut'];
                //     $perjawatan->save();
                //$id_personal = $model->findOne(['no_kp' => Yii::$app->request->post()['Personal']['no_kp']])->id_personal;
                $val_kod = md5($personal_email).'@'.$no_kp;
                $url = 'http://'.$_SERVER['HTTP_HOST'].Yii::$app->urlManager->createUrl(['personal/confirm']);
                $body = '<h3>Pengesahan Email</h3>';
                $body .= '<p>Kod Pengesahan anda adalah '.$val_kod.' .</p>';
                $body .= '<p>Login: '.$no_kp.'<br>Katalaluan: '.$password.'<p>';
                $body .= '<p>Anda boleh melawat URL '.$url.' untuk mengesahan email atau ';
                $body .= 'klik pada <a href=\''.$url.'&code='.$val_kod.'\'>link ini</a> untuk pengesahan email anda.</p>';

                $sent = Yii::$app->mailer->compose()
                    ->setFrom(['sistem@ciast.gov.my' => 'Sistem eProfiling'])
                    ->setTo($personal_email)
                    ->setSubject('Pengesahan Pendaftaran eProfiling')
                    ->setHTMLBody($body)
                    ->send();

                if($sent) {
                    if($model->load(Yii::$app->request->post()) && $model->save()) {
                        //$id_personal = $model->findOne(['no_kp' => Yii::$app->request->post()['Personal']['no_kp']])->id_personal;
                        $personal = $model->findOne(['no_kp' => Yii::$app->request->post()['Personal']['no_kp']]);
                        $id_personal = $personal->id_personal;
                        $personal->katalaluan = Yii::$app->getSecurity()->generatePasswordHash($password);
                        if(!$personal->save())
                            return print_r($personal->getErrors());
                        $perjawatan->id_personal = $id_personal;
                        $perjawatan->id_agensi_institut = Yii::$app->request->post()['PersonalPerjawatan']['id_agensi_institut'];
                        $perjawatan->save();
                        // $val_kod = md5($id_personal.$no_kp).'@'.$id_personal;
                        // $url = 'http://'.$_SERVER['HTTP_HOST'].Yii::$app->urlManager->createUrl(['personal/confirm']);
                        // $body = '<h3>Pengesahan Email</h3>';
                        // $body .= '<p>Kod Pengesahan anda adalah '.$val_kod.' .';
                        // $body .= '<p>Anda boleh melawat URL '.$url.' untuk mengesahan email atau ';
                        // $body .= 'klik pada <a href=\''.$url.'&code='.$val_kod.'\'>link ini</a> untuk pengesahan email anda.</p>';

                        return $this->render('emailed', ['model' => $model]);
                    }
                    else
                        print_r($model->getErrors());
                }
                //}
                //else
                //    print_r($model->getErrors());
            }
            else
                return $this->render('register', ['no_kp' => $no_kp, 'model' => $model, 'agensi' => $agensi, 'perjawatan' => $perjawatan]); 
        
            if(count($result) > 0) {
                return $this->redirect(['personal/check']);
            }
        }
        else {
            //return $this->redirect(['personal/check']);
            $no_kp = Yii::$app->request->get()['no_kp'];
            //return print_r(Yii::$app->request->get());
            return $this->render('register', ['no_kp' => $no_kp, 'model' => $model, 'agensi' => $agensi, 'perjawatan' => $perjawatan]); 
        }
        // if(Yii::$app->request->post()) {
        //     // if(isset(Yii::$app->request->post()['Personal']['emel'])) {
        //     //     //print_r(Yii::$app->request->post());
        //     //     if($model->load(Yii::$app->request->post()) && $model->save()) {
        //     //         $perjawatan->id_personal = $model->findOne(['no_kp' => Yii::$app->request->post()['Personal']['no_kp']])->id_personal;
        //     //         $perjawatan->id_agensi_institut = Yii::$app->request->post()['PersonalPerjawatan']['id_agensi_institut'];
        //     //         $perjawatan->save();
        //     //         print_r($perjawatan->getErrores());
        //     //     }
        //     // }
        //     // else
        //     //     return $this->render('register', ['no_kp' => $no_kp, 'model' => $model, 'agensi' => $agensi, 'perjawatan' => $perjawatan]);    
        // }
        
    }

    public function actionConfirm($code = 0)
    {
        //return $code;
        if($code != '0'){
            $arr_code = explode('@', $code);
            //return $arr_code[1];
            $model = Personal::findOne(['no_kp' => $arr_code[1]]);
            //$pre_code = $model->id_personal.$model->emel;
        
            if(md5($model->emel) == $arr_code[0]){
                $model->id_ref_status_data = 2;
                //$model->captcha = Yii::$app->session['__captcha/site/captcha']; // This is to set captha on update if required
                if($model->save())
                    return $this->render('confirmed', ['confirm' => 1]);
                else
                    return $this->render('confirmed', ['confirm' => 0, 'error' => $model->getErrors()]);
                
            }
            return $this->render('confirmed', ['save' => -1]);
            
        }
        else
            return $this->render('confirm');
    }

    public function actionVerify($id)
    {
        if(Yii::$app->request->post()) {
            $model = $this->findModel($id);
            $model->id_ref_status_data = 3;
            if(!$model->save())
                return print_r($model->getErrors());
            return $this->redirect(['info', 'tab' => 4]);
        }
    }

    public function actionList($id)
    {
        $instituts = AgensiInstitut::find()->where(['id_agensi' => $id])->all();

        if(count($instituts) > 0) {
            $option = "<option value=\"\">- Sila Pilih -</option>";
            foreach($instituts as $institut) {
                $option .= "<option value=\"".$institut->id_agensi_institut."\">".$institut->nama_institut."</option>";    
            }
            return $option;
        }
        else
            return '<option> - </option>';
    }

    public function actionInfo()
    {
        $id = \Yii::$app->user->identity->id_personal;

        $perjawatanQuery = PersonalPerjawatan::find()->where(['id_personal' => $id]);
        $kelulusanQuery = PersonalKelulusan::find()->where(['id_personal' => $id]);
        $bidangQuery = PersonalBidang::find()->where(['id_personal' => $id]);

        $perjawatanProvider = new ActiveDataProvider([
            'query' => $perjawatanQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC,
                    'id_personal_perjawatan' => SORT_DESC,
                ]
            ],
        ]);

        $kelulusanProvider = new ActiveDataProvider([
            'query' => $kelulusanQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC, 
                ]
            ],
        ]);

        $bidangProvider = new ActiveDataProvider([
            'query' => $bidangQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC, 
                    'id_personal_bidang' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('info', [
            'personal' => $this->findModel($id),
            'perjawatanDataProvider' => $perjawatanProvider,
            'kelulusanDataProvider' => $kelulusanProvider,
            'bidangDataProvider' => $bidangProvider,
        ]);
    }

    public function actionPersonalPerjawatan($id)
    {
        $perjawatanQuery = PersonalPerjawatan::find()->where(['id_personal' => $id]);

        $perjawatanDataProvider = new ActiveDataProvider([
            'query' => $perjawatanQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC,
                    'id_personal_perjawatan' => SORT_DESC,
                ]
            ],
        ]);

        return $this->renderAjax('_perjawatan_info', ['perjawatanDataProvider' => $perjawatanDataProvider, 'id_personal' => $id]);
    }

    public function actionPersonalKelulusan($id)
    {
        $kelulusanQuery = PersonalKelulusan::find()->where(['id_personal' => $id]);

        $kelulusanDataProvider = new ActiveDataProvider([
            'query' => $kelulusanQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC, 
                ]
            ],
        ]);

        return $this->renderAjax('_kelulusan_info', ['kelulusanDataProvider' => $kelulusanDataProvider, 'id_personal' => $id]);
    }

    public function actionPersonalBidang($id)
    {
        $bidangQuery = PersonalBidang::find()->where(['id_personal' => $id]);

         $bidangDataProvider = new ActiveDataProvider([
            'query' => $bidangQuery,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    //'created_at' => SORT_DESC,
                    //'title' => SORT_ASC, 
                    'id_personal_bidang' => SORT_DESC,
                ]
            ],
        ]);

        return $this->renderAjax('_bidang_info', ['bidangDataProvider' => $bidangDataProvider, 'id_personal' => $id]);
    }

    /**
     * Finds the Personal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
