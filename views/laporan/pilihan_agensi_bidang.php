<?php
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

//$aa_ai = 'aa';
//echo "Role : AA<br>";
//Cari Bidang Agensi utk AA/EX
$cari_bidang_agensi = new \yii\db\Query();

//distict x jalan => groupby ok
$cari_bidang_agensi->select('*')
->from('bidang')
->join('left join','bidang_institut','bidang.id_bidang = bidang_institut.id_bidang')
->join('left join','agensi_institut','agensi_institut.id_agensi_institut = bidang_institut.id_agensi_institut')
->join('left join','agensi','agensi_institut.id_agensi = agensi.id_agensi')
->where(['agensi_institut.id_agensi'=>$agensi])
->groupBy('bidang.id_bidang')
->all();
$command = $cari_bidang_agensi->createCommand();
$resp = $command->queryAll();
echo "Bidang Agensi : <br>";
//print_r($resp);
//echo "test".$resp->nama_bidang;
foreach ($resp as $dapat){
	echo "Bidang : ".$dapat['nama_bidang']."<br>";
}
//tukar array jd model/dataprovider
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
echo "<h3>Pilihan Bidang Dalam Agensi</h3>";
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
								return Html::a('<span class="glyphicon glyphicon-tag"></span>', ['abiliti-map-agensi', 'idag' => $provider['id_agensi'],'idbi' => $provider['id_bidang']], ['title' => 'Ability Map Agensi - PENILAIAN TERKINI']);
								},
								'abilitymapbt'=>function($url,$provider){
								return Html::a('<span class="glyphicon glyphicon-tags"></span>', ['abiliti-map-agensi-bulan-tahun', 'idag' => $provider['id_agensi'],'idbi' => $provider['id_bidang']], ['title' => 'Ability Map Agensi - PILIHAN TARIKH']);
								},
						],
								//
				],
		],
	]);
//*/
?>