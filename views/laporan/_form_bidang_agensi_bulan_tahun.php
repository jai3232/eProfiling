<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
use app\models\Bidang;
//use kartik\select2\Select2;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\BidangInstitut */

$this->title = $agensi->nama_agensi;
$this->params['breadcrumbs'][] = ['label' => 'Laman Laporan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Kembali', 'url' => Url::previous('senarai_bidang_agensi')];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bidang-institut-form-julat">

    <?php $form = ActiveForm::begin(); ?>
	<div class="form-group">
	<?= Html::label('Dari')?>
	<?php
	echo DatePicker::widget([
	    'name'  => 'bulan_tahun',
	    'dateFormat' => 'dd-MM-yyyy',
		//'showOptions' => true,
		'clientOptions' => ['showAnim' => 'fold'],
	]);
	?>
	<?= Html::label('Hingga')?>
	<?php
	echo DatePicker::widget([
	    'name'  => 'bulan_tahun2',
	    'dateFormat' => 'dd-MM-yyyy',
		//'showOptions' => true,
		'clientOptions' => ['showAnim' => 'fold'],
	]);
	?>
	</div>

    <div class="form-group">
        <?= Html::submitButton('Hasilkan Report' ,['class' => 'btn btn-success' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
