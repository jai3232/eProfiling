<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use app\models\Bidang;
use app\models\Agensi;
use app\models\AgensiInstitut;

Url::remember(['senarai-bidang-institut?idag='.$agensi->id_agensi.'&idai='.$agensiInstitut->id_agensi_institut],'senarai_bidang_institut');

$this->params['breadcrumbs'][] = ['label' => 'Laman Laporan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Laporan Ability Map Agensi : <?=$agensi->nama_agensi;?></h3>
<h3>Institut Pilihan : <?=$agensiInstitut->nama_institut;?></h3>

<?php 

//Cari Bidang Institut
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
->where(['bidang_institut.id_agensi_institut'=>$agensiInstitut->id_agensi_institut])
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
