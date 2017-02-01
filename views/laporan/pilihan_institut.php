<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use app\models\Bidang;
//use app\models\PersonalPerjawatan;
use app\models\Agensi;
use app\models\AgensiInstitut;

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
$nama_agensi=Agensi::find()->where(['id_agensi'=>$agensi])->one()->attributes['nama_agensi'];
?>
<h3>Laporan Abiliti Map Agensi : <?=$nama_agensi;?></h3>
<ul class="nav nav-tabs">
<li class="active"><a href="#pilih_bidang" data-toggle="tab">Laporan Bidang</a></li>
<li><a href="#pilih_institut" data-toggle="tab">Laporan Institut</a></li>

</ul>
<div class="tab-content">
	<div class="tab-pane active" id="pilih_bidang">
<?php
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
//echo "<h3>Pilihan Bidang Dalam Agensi</h3>";
echo GridView::widget([
		'dataProvider' => $provider,
		//'filterModel' => $cari_bidang_agensi,
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
	</div>
	<div class="tab-pane" id="pilih_institut">
		<?php 
		$cari_agensi_institut = new \yii\db\Query();
		$cari_agensi_institut->select('*')
		->from('agensi_institut')
		->where(['agensi_institut.id_agensi'=>$agensi])
		->all();
		$command2 = $cari_agensi_institut->createCommand();
		$resp2 = $command2->queryAll();
		//tukar array jd model/dataprovider
		$provider2 = new ArrayDataProvider([
				'allModels' => $resp2,
				'sort' => [
						'attributes' => ['nama_institut'],
				],
				'pagination' => [
						'pageSize' => 10,
				],
		]);
						
		echo GridView::widget([
				'dataProvider' => $provider2,
				'columns' => [
						['header'=>'Bil','class' => 'yii\grid\SerialColumn'],
						//'id_bidang_institut',
						'nama_institut',
						[
								'header'=>'Senarai Bidang','class' => 'yii\grid\ActionColumn',
								//'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false,
								'template' => '{pilihinstitut}',//{abilitymappm}
								
								'buttons' => [
		
										'pilihinstitut'=>function($url,$provider){
										return Html::a('<span class="glyphicon glyphicon-list"></span>', ['senarai-bidang-institut', 'idag' => $provider['id_agensi'],'idai' => $provider['id_agensi_institut']], ['title' => 'Senarai Bidang Institut']);
										},

								],
								
										//
						],
				],
		]);
		?>
	</div>
</div>