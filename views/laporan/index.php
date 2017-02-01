<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
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
?>
<h2>Laporan Ability Map</h2>

<?php 
//AI dan HOD
//$aa_ai = 'ai';
//echo "Role : AI<br>";
//Cari Bidang Institu utk AI/HOD
$cari_bidang_institut = new \yii\db\Query();
$cari_bidang_institut->select('*')
/*
 ->from('bidang_institut')
->leftjoin('bidang','bidang.id_bidang = bidang_institut.id_bidang')
*/
->from('bidang')
->join('left join','bidang_institut','bidang.id_bidang = bidang_institut.id_bidang')
->join('left join','agensi_institut','agensi_institut.id_agensi_institut = bidang_institut.id_agensi_institut')
->join('left join','agensi','agensi_institut.id_agensi = agensi.id_agensi')
->where(['bidang_institut.id_agensi_institut'=>$institut])
->all();
$command = $cari_bidang_institut->createCommand();
$resp = $command->queryAll();
/*
echo "Bidang Institut : <br>";
//print_r($resp);
//echo "test".$resp->nama_bidang;
foreach ($resp as $dapat){
	echo "Bidang : ".$dapat['nama_bidang']."<br>";
}
*/
$provider = new ArrayDataProvider([
		'allModels' => $resp,
		'sort' => [
				'attributes' => ['nama_bidang'],
		],
		'pagination' => [
				'pageSize' => 10,
		],
]);
//*
echo GridView::widget([
		'dataProvider' => $provider,
		'columns' => [
				['header'=>'Bil','class' => 'yii\grid\SerialColumn'],
				//'id_bidang_institut',
				'nama_bidang',
				[
						'header'=>'Fungsi','class' => 'yii\grid\ActionColumn',
						//'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false,
						'template' => '{abilitymap}{abilitymapbt}',//{abilitymappm}
						'buttons' => [

								'abilitymap'=>function($url,$provider,$aa_ai){
								return Html::a('<span class="glyphicon glyphicon-tag"></span>', ['abiliti-map-institut', 'id' => $provider['id_bidang_institut'],'idai' => $provider['id_agensi_institut'],'idag'=> $provider['id_agensi']], ['title' => 'Ability Map Institut - PENILAIAN TERKINI']);
								},
								'abilitymapbt'=>function($url,$provider){
								return Html::a('<span class="glyphicon glyphicon-tags"></span>', ['abiliti-map-institut-bulan-tahun', 'id' => $provider['id_bidang_institut'],'idai' => $provider['id_agensi_institut'],'idag'=> $provider['id_agensi']], ['title' => 'Ability Map Institut - PILIHAN TARIKH']);
								},
						],
								//
				],
		],
	]);
//*/
// get the posts in the current page
//$posts = $provider->getModels();

//echo $command2;



?>
