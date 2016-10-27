<?php

use app\models\Personal;
use app\models\PersonalBidang;
use app\models\PersonalPerjawatan;
use app\models\PenilaianProfil;
use app\models\Agensi;
use app\models\AgensiInstitut;
use app\models\Bidang;
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
	$countPerjawatan = PersonalPerjawatan::find()->where(['id_personal' =>  Yii::$app->user->identity->id_personal])->count();

	function getTahapAkses($str) {
    $arr = explode(",", $str);

    $ta = array("Admin Sistem", "Admin UPPK", "Admin Agensi", "Admin Institut", "Ex", "Hod", "Data Entri", "Pengajar");
    $list = '';
    foreach ($arr as $key => $value) {
        $value = $value/1;
        $list .= $ta[$value].', ';
    }
    return $list;
	}
	$statusData = [1 => 'Permohonan Baru', 2 => 'Draf', 3 => 'Perakuan', 4 => 'Disahkan'];
?>
<div class="site-index">

    <div class="jumbotron">
      <h1>eProfiling</h1>
      <p class="lead">Selamat datang <?= Yii::$app->user->identity->nama ?> . Sila pilih menu berkaitan.</p>
      <?php 
      	if($countPerjawatan == 0) {
      ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      	<strong>Ingatan!</strong> Anda masih belum mengisi jawatan untuk profil. Sila pastikan jawatan diisi sebelum menambah maklumat lain. Maklumat jawatan boleh diisi di menu pengajar->personal->perjawatan.
  		</div>
  		<?php
  			}
  		?>
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
						  	<h4>Status Semasa</h4>
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						        <!-- <h3>Thumbnail label</h3> -->
						        <ul class="list-group">
										  <li class="list-group-item"><label>Status Capaian:</label> <?= getTahapAkses(Yii::$app->user->identity->tahap_akses) ?></li>
										  <li class="list-group-item"><label>Status Data: </label> <?= $statusData[Yii::$app->user->identity->id_ref_status_data] ?></li>
										  <li class="list-group-item">
										  	<label>Institut: </label> 
										  		<?php 
										  		if(isset(PersonalPerjawatan::find()->select(['id_agensi_institut'])->where(['id_personal' => Yii::$app->user->identity->id_personal, 'is_aktif' => 1])->one()->attributes['id_agensi_institut'])) {
									  				$id_institut = PersonalPerjawatan::find()->select(['id_agensi_institut'])->where(['id_personal' => Yii::$app->user->identity->id_personal, 'is_aktif' => 1])->one()->attributes['id_agensi_institut'];
									  				echo AgensiInstitut::find()->select(['nama_institut'])->where(['id_agensi_institut' => $id_institut])->one()->attributes['nama_institut'];
										  		}
										  		else
										  			echo 'Tiada';
										  		?>
										  </li>
										  <li class="list-group-item">
										  	<label>Bidang Semasa: </label> 
										  		<?php 
										  			if(isset(PersonalBidang::find()->select(['id_bidang'])->where(['id_personal' => Yii::$app->user->identity->id_personal, 'is_aktif' => 1])->one()->attributes['id_bidang'])) {
											  			$id_bidang = PersonalBidang::find()->select(['id_bidang'])->where(['id_personal' => Yii::$app->user->identity->id_personal, 'is_aktif' => 1])->one()->attributes['id_bidang'];
											  			echo Bidang::find()->select(['nama_bidang'])->where(['id_bidang' => $id_bidang])->one()->attributes['nama_bidang'];
										  		}
										  		else
										  			echo 'Tiada';
										  		?>
										  </li>
										  <li class="list-group-item">
										  	<label>Penyelia: </label> 
										  		<?php 
										  			if(isset(Personal::find()->select(['id_personal_penyelia'])->where(['id_personal' => Yii::$app->user->identity->id_personal])->one()->attributes['id_personal_penyelia'])) {
											  			$id_penyelia = Personal::find()->select(['id_personal_penyelia'])->where(['id_personal' => Yii::$app->user->identity->id_personal])->one()->attributes['id_personal_penyelia'];
											  			$penyelia = Personal::find()->where(['id_personal' => $id_penyelia])->one();
											  			echo $penyelia->attributes['nama'].' ('.$penyelia->attributes['emel'].')';
										  		}
										  		else
										  			echo 'Tiada';
										  		?>
										  </li>
										  <li class="list-group-item">
										  	<label>Admin Institut: </label> 
										  		<?php 
										  			if(isset($id_institut)) {
										  				$admins = Personal::find()->select('nama, emel')->joinWith('personalPerjawatans')->andWhere(['tahap_akses' => 3, 'id_agensi_institut' => $id_institut, 'is_aktif' => 1])->all();
										  				$list = '';
											  			foreach ($admins as $key => $value) {
											  				$list .= ucwords(strtolower($value['nama'])).' ('.$value['emel'].'), ';
											  			}
											  			echo $list;
										  			}
										  		
										  		else
										  			echo 'Tiada';
										  		?>
										  </li>
										</ul>
								<!--
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								-->
						      </div>
						    </div>
						    <h4>Status Kakitangan Selian</h4>
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						        <!-- <h3>Thumbnail label</h3> -->
						        <ul class="list-group">
						        	<?php
						        		$i = 1;
										if(count($penilaianProfils) == 0)
						        			echo 'Tiada';
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
								<!--
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								-->
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						  	<h4>Status Pendaftaran</h4>
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						        <!-- <h3>Thumbnail label</h3> -->
						        <ul class="list-group">
								  <li class="list-group-item"><span class="badge"><?= count(Personal::find()->all()); ?></span>Jumlah Pendaftar</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['id_ref_status_data' => 1])); ?></span>Pendaftaran Baru</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['id_ref_status_data' => 2])); ?></span>Pengesahan Email</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['id_ref_status_data' => 3])); ?></span>Perakuan Maklumat</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['id_ref_status_data' => 4])); ?></span>Telah disahkan</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['tahap_akses' => 2])); ?></span>Admin Agensi</li>
								  <li class="list-group-item"><span class="badge"><?= count(Personal::findAll(['tahap_akses' => 3])); ?></span>Admin Institut</li>
								</ul>
								<!--
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								-->
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6 col-md-4">
						  	<h4>Status Lain</h4>
						    <div class="thumbnail">
						      <!-- <img src="..." alt="..."> -->
						      <div class="caption">
						      	<ul class="list-group">
										  <li class="list-group-item"><span class="badge"><?= count(Agensi::find()->all()); ?></span>Jumlah Agensi</li>
										  <li class="list-group-item"><span class="badge"><?= count(AgensiInstitut::find()->all()); ?></span>Jumlah Institut</li>
										  <li class="list-group-item"><span class="badge"><?= count(Bidang::find()->all()); ?></span>Jumlah Bidang</li>
										</ul>
						        <!-- <h3>Thumbnail label</h3> -->
								<!--
						        <p>...</p>
						        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
								-->
						      </div>
						    </div>
						  </div>
						</div>


				  </div>
				</div>
      </div>
    </div>
</div>
