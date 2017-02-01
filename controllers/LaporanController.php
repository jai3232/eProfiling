<?php

namespace app\controllers;

use Yii;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\BidangInstitut;
use app\models\Personal;
use app\models\PersonalBidang;
//use app\models\PersonalPerjawatan;
use app\models\PenilaianProfil;
use app\models\PenilaianMarkah;
use app\models\PersonalPerjawatan;
use app\models\Agensi;
use app\models\AgensiInstitut;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;



class LaporanController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$id_personal = Yii::$app->user->identity->id_personal;
    	$tahap_akses = Yii::$app->user->identity->tahap_akses;
    	//jai control user
    	//(Yii::$app->user->identity->accessLevel([0, 1, 6])
    	$cari_personal_perjawatan = PersonalPerjawatan::find()
    	//->select(['personal_perjawatan.*','agensi.*','agensi_institut.*'])
    	//->leftJoin('agensi','agensi.id_agensi=personal_perjawatan.id_agensi')
    	//->leftJoin('agensi_institut','agensi_institut.id_agensi_institut=personal_perjawatan.id_agensi_institut')
    	->where('personal_perjawatan.is_aktif=1')
    	->one();
    	$cari_personal_bidang = PersonalBidang::find()
    	->where('personal_bidang.is_aktif=1')
    	->one();
    	//echo "id_personal : $id_personal<br> Tahap Akses : ";
    	//print_r($tahap_akses);
    	//echo "<br>";
    	//Cek Institut/Agensi
    	$agensi = $cari_personal_perjawatan->id_agensi;
    	$institut = $cari_personal_perjawatan->id_agensi_institut;
    	$cari_agensi=Agensi::find()
    	->where(['id_agensi'=>$agensi])
    	->one();
    	$cari_agensi_institut=AgensiInstitut::find()
    	->where(['id_agensi_institut'=>$institut])
    	->one();
    	//echo "Agensi : $cari_agensi->nama_agensi <br>Institut : $cari_agensi_institut->nama_institut<br>";
    	//cek tahap AI/HOD atau AA/EX
    	$ai=array(3,5);//AI HOD
    	$aa=array(2);//AA 
    	$au=array(0,1,4);//AA EX AU
    	$ta=explode(",", $tahap_akses);
    	//print_r($ta);
    	
    	$result_ai = count(array_intersect($ai, $ta));
    	$result_aa = count(array_intersect($aa, $ta));
    	$result_au = count(array_intersect($au, $ta));
    	//$gai=$result_ai ;
    	// AA
    	if($result_au>0){
    		return $this->render('pilihan_agensi',[
    				'agensi' => $agensi,
    				//'institut' => $institut,
    		]);
    	}elseif($result_aa>0){
    			return $this->render('pilihan_institut',[
    					'agensi' => $agensi,
    					//'institut' => $institut,
    			]);
    		}elseif($result_ai>0){
    	//AI
    			return $this->render('index',[
    					//'agensi' => $agensi,
    					'institut' => $institut,
    			]);
    		}elseif($result_aa==0&&$result_ai==0){
    			//echo "Anda Tiada Akses<br>";//Perlu redirect page
    			return $this->redirect(['site/unauthorized']);
    		}
    		
    	
    		
    	
    }
    public function actionSenaraiBidangInstitut($idag,$idai)
    {
    	$agensi = Agensi::findOne(['id_agensi' => $idag]);
    	$agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
    
    	return $this->render('senarai_bidang_institut', [
    			'agensi' => $agensi,//bidang institut
    			'agensiInstitut'=>$agensiInstitut,
    	]);
    }
    public function actionSenaraiBidangAgensi($idag)
    {
    	$agensi = Agensi::findOne(['id_agensi' => $idag]);
    	//$agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
    
    	return $this->render('senarai_bidang_agensi', [
    			'agensi' => $agensi,//bidang institut
    			//'agensiInstitut'=>$agensiInstitut,
    	]);
    }
    public function actionLaporan($idai)
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
    public function actionAbilitiMapInstitut($id,$idai)
    {
    	$model = $this->findModel($id);//bidang institut
    	$agensiInstitut = AgensiInstitut::findOne(['id_agensi_institut' => $idai]);
    	return $this->render('abiliti_map_institut', [
    			'model' => $model,//bidang institut
    			'agensiInstitut'=>$agensiInstitut,
    			//'cekai'=>$GLOBALS['gai'],
    	]);
    }
    public function actionAbilitiMapInstitutBulanTahun($id,$idai)
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
    				//'cekai'=>'ya',
    		]);
    	}
    	else {
    		return $this->render('_form_bidang_institut_bulan_tahun', [
    				'model' => $model,
    				'agensiInstitut'=>$agensiInstitut,
    		]);
    	}
    	 
    }
    public function actionAbilitiMapAgensi($idag,$idbi)
    {
    	$bidang = Bidang::findOne(['id_bidang' => $idbi]);
    	$agensi = Agensi::findOne(['id_agensi' => $idag]);
    	return $this->render('abiliti_map_agensi', [
    			'bidang' => $bidang,//bidang 
    			'agensi'=>$agensi,
    			//'idag'=>$idag,
    	]);
    }
    public function actionAbilitiMapAgensiBulanTahun($idag,$idbi)
    {
    	$bidang = Bidang::findOne(['id_bidang' => $idbi]);
    	$agensi = Agensi::findOne(['id_agensi' => $idag]);
    
    	if (Yii::$app->request->post()) {
    		$request = Yii::$app->request;
    		$bulan_tahun = $request->post('bulan_tahun');
    		$bulan_tahun2 = $request->post('bulan_tahun2');
    		return $this->render('abiliti_map_agensi_bulan_tahun', [
    				'bidang' => $bidang,//bidang 
    				'agensi'=>$agensi,
    				'bulan_tahun' => $bulan_tahun,
    				'bulan_tahun2' => $bulan_tahun2,
    				//'idag'=>$idag,
    		]);
    	}
    	else {
    		return $this->render('_form_bidang_agensi_bulan_tahun', [
    				'bidang' => $bidang,//bidang 
    				'agensi'=>$agensi,
    		]);
    	}
    
    }
    public function actionAbilitiMapSemua($idbi)
    {
    	$bidang = Bidang::findOne(['id_bidang' => $idbi]);
    	//$agensi = Agensi::findOne(['id_agensi' => $idag]);
    	return $this->render('abiliti_map_semua', [
    			'bidang' => $bidang,//bidang
    			//'agensi'=>$agensi,
    			//'idag'=>$idag,
    	]);
    }
    public function actionAbilitiMapSemuaBulanTahun($idbi)
    {
    	$bidang = Bidang::findOne(['id_bidang' => $idbi]);
    	//$agensi = Agensi::findOne(['id_agensi' => $idag]);
    
    	if (Yii::$app->request->post()) {
    		$request = Yii::$app->request;
    		$bulan_tahun = $request->post('bulan_tahun');
    		$bulan_tahun2 = $request->post('bulan_tahun2');
    		return $this->render('abiliti_map_semua_bulan_tahun', [
    				'bidang' => $bidang,//bidang
    				//'agensi'=>$agensi,
    				'bulan_tahun' => $bulan_tahun,
    				'bulan_tahun2' => $bulan_tahun2,
    				//'idag'=>$idag,
    		]);
    	}
    	else {
    		return $this->render('_form_bidang_semua_bulan_tahun', [
    				'bidang' => $bidang,//bidang
    				//'agensi'=>$agensi,
    		]);
    	}
    
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
        if (($model = BidangInstitut::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
