<?php
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\DetailView;
use yii\grid\GridView;
//use yii\data\ArrayDataProvider;
//use yii\data\ActiveDataProvider;
use app\models\Bidang;
use app\models\BidangSearch;
use app\models\Agensi;
use app\models\AgensiSearch;

//$aa_ai = 'aa';
//echo "Role : AA<br>";
//Cari Bidang Agensi utk AA/EX

$this->registerJs(
	'$("document").ready(function(){
        		$("a[data-toggle=\"tab\"]").on("show.bs.tab", function (e) {
				      localStorage.setItem("lastTab", $(this).attr("href"));
				   });
				   var lastTab = localStorage.getItem("lastTab");
				   if (lastTab) {
				      $("[href=\"" + lastTab + "\"]").tab("show");
				   }
			});'
);
/*
echo "Bidang Agensi : <br>";
foreach ($resp as $dapat){
	echo "Bidang : ".$dapat['nama_bidang']."<br>";
}
*/

?>
<h3>Laporan Abiliti Map Semua Agensi</h3>
<ul class="nav nav-tabs">
<li class="active"><a href="#pilih_bidang" data-toggle="tab">Laporan Bidang</a></li>
<li><a href="#pilih_agensi" data-toggle="tab">Laporan Agensi</a></li>

</ul>
<div class="tab-content">
	<div class="tab-pane active" id="pilih_bidang">
<?php
/*
$cari_bidang = new \yii\db\Query();
$cari_bidang->select('*')
->from('bidang')
->all();
$command = $cari_bidang->createCommand();
$resp = $command->queryAll();
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
*/
$searchModel = new BidangSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->pagination->pageSize=10;
//echo "<h3>Pilihan Bidang Dalam Agensi</h3>";
echo GridView::widget([
		//'dataProvider' => $provider,
		//'filterModel' => $searchModel,
'dataProvider' => $dataProvider,
'filterModel' => $searchModel,
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
								return Html::a('<span class="glyphicon glyphicon-tag"></span>', ['abiliti-map-semua','idbi' => $provider['id_bidang']], ['title' => 'Ability Map Semua - PENILAIAN TERKINI']);
								},
								'abilitymapbt'=>function($url,$provider){
								return Html::a('<span class="glyphicon glyphicon-tags"></span>', ['abiliti-map-semua-bulan-tahun','idbi' => $provider['id_bidang']], ['title' => 'Ability Map Semua - PILIHAN TARIKH']);
								},
						],
								//
				],
		],
	]);
//*/
?>
	</div>
	<div class="tab-pane" id="pilih_agensi">
		<?php 
		/*
		$cari_agensi = new \yii\db\Query();
		$cari_agensi->select('*')
		->from('agensi')
		//->where(['agensi_institut.id_agensi'=>$agensi])
		->all();
		$command2 = $cari_agensi->createCommand();
		$resp2 = $command2->queryAll();
		//tukar array jd model/dataprovider
		$provider2 = new ArrayDataProvider([
				'allModels' => $resp2,
				'sort' => [
						'attributes' => ['nama_agensi'],
				],
				'pagination' => [
						'pageSize' => 10,
				],
		]);
		*/	
		$searchModel2 = new AgensiSearch();
		$dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
		$dataProvider2->pagination->pageSize=10;
		echo GridView::widget([
				'dataProvider' => $dataProvider2,
				'filterModel' => $searchModel2,
				'columns' => [
						['header'=>'Bil','class' => 'yii\grid\SerialColumn'],
						//'id_bidang_institut',
						'nama_agensi',
						[
								'header'=>'Senarai Bidang','class' => 'yii\grid\ActionColumn',
								//'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false,
								'template' => '{pilihinstitut}',//{abilitymappm}
								
								'buttons' => [
		
										'pilihinstitut'=>function($url,$provider){
										return Html::a('<span class="glyphicon glyphicon-list"></span>', ['senarai-bidang-agensi', 'idag' => $provider['id_agensi']], ['title' => 'Senarai Bidang']);
										},

								],
								
										//
						],
				],
		]);
		?>
	</div>
</div>