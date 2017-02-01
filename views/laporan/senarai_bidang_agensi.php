<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use app\models\Bidang;
use app\models\BidangAgensiSearch;
use app\models\Agensi;

Url::remember(['senarai-bidang-agensi?idag='.$agensi->id_agensi],'senarai_bidang_agensi');

$this->params['breadcrumbs'][] = ['label' => 'Laman Laporan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h3>Laporan Ability Map Agensi : <?=$agensi->nama_agensi;?></h3>

<?php 

//Cari Bidang Agensi
//*
$cari_bidang_agensi = new \yii\db\Query();

//distict x jalan => groupby ok
$cari_bidang_agensi->select('*')
->from('bidang')
->join('left join','bidang_institut','bidang.id_bidang = bidang_institut.id_bidang')
->join('left join','agensi_institut','agensi_institut.id_agensi_institut = bidang_institut.id_agensi_institut')
->join('left join','agensi','agensi_institut.id_agensi = agensi.id_agensi')
->where(['agensi_institut.id_agensi'=>$agensi->id_agensi])
->groupBy('bidang.id_bidang')
->all();
$command = $cari_bidang_agensi->createCommand();
$resp = $command->queryAll();


$provider = new ArrayDataProvider([
		'allModels' => $resp,
		'sort' => [
				'attributes' => ['nama_bidang'],
		],
		'pagination' => [
				'pageSize' => 10,
		],
]);
/*
$searchModel = new BidangAgensiSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize=10;
*/
echo GridView::widget([
		'dataProvider' => $provider,
		//'filterModel' => $searchModel,
		//'dataProvider' => $dataProvider,
		//'filterModel' => $searchModel,
		'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
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
								return Html::a('<span class="glyphicon glyphicon-tag"></span>', ['abiliti-map-agensi','idbi' => $provider['id_bidang'],'idag' => $provider['id_agensi']], ['title' => 'Ability Map Agensi - PENILAIAN TERKINI']);
								},
								'abilitymapbt'=>function($url,$provider){
								return Html::a('<span class="glyphicon glyphicon-tags"></span>', ['abiliti-map-agensi-bulan-tahun','idbi' => $provider['id_bidang'],'idag' => $provider['id_agensi']], ['title' => 'Ability Map Agensi - PILIHAN TARIKH']);
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
