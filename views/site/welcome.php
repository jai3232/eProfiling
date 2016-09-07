<?php

use app\models\Personal;
use app\models\PersonalBidang;
use app\models\PenilaianProfil;
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'eProfiling';
?>

<?php
	$personals = Personal::find()->select(['id_personal'])->where(['id_personal_penyelia' => Yii::$app->user->identity->id_personal])->all();
	$arrPersonal = [];
	foreach ($personals as $key => $value) {
		array_push($arrPersonal, $value->attributes['id_personal']);
	}
	
	$penilaianProfils = PenilaianProfil::find()
										->joinWith('idPersonalBidang')
										->where(['personal_bidang.id_personal' => $arrPersonal, 'penilaian_profil.status_siap' => 1])
										->all();

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>eProfiling</h1>

        <p class="lead">Selamat datang <?= Yii::$app->user->identity->nama ?> . Sila pilih menu berkaitan.</p>

    </div>
    <div class="body-content">
      <div class="row">
      	<div class="panel panel-info">
				  <div class="panel-heading">
				    <h3 class="panel-title"><strong>Maklumat</strong></h3>
				  </div>
				  <div class="panel-body">
				    <div class="row">
						  <div class="col-sm-6 col-md-4">
						  	Status Pengesahan Kakitangan Seliaan
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						        <!-- <h3>Thumbnail label</h3> -->
						        <ul class="list-group">
						        	<?php
						        		$i = 1;
						        		foreach ($penilaianProfils as $key => $value) {
						        			$id_personal = $value['idPersonalBidang']->attributes['id_personal'];
						        			$name = Personal::findOne(['id_personal' => $id_personal])->attributes['nama'];
						        			$ic = Personal::findOne(['id_personal' => $id_personal])->attributes['no_kp'];
						        	?>
										  <li class="list-group-item"><?php echo $i.'. '.Html::a($name.' ('.$ic.')', Url::to(['penilaian-profil/supervise', 'id' => $value->attributes['id_penilaian_profil']])); ?></li>

										  <?php
										  		$i++;
										  	}
										  ?>
										</ul>
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						  	Status Pendaftaran
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						        <!-- <h3>Thumbnail label</h3> -->
						        <ul class="list-group">
										  <li class="list-group-item"><span class="badge">64</span>Pendaftaran Baru</li>
										  <li class="list-group-item"><span class="badge">21</span>Pengesan Email</li>
										  <li class="list-group-item"><span class="badge">33</span>Perakuan Maklumat</li>
										</ul>
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						  	Status Lain
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						      	<ul class="list-group">
										  <li class="list-group-item"><span class="badge">24</span>Jumlah Agensi</li>
										  <li class="list-group-item"><span class="badge">14</span>Jumlah Bidang</li>
										</ul>
						        <!-- <h3>Thumbnail label</h3> -->
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
						      </div>
						    </div>
						  </div>
						</div>


				  </div>
				</div>
      </div>
    </div>
</div>
