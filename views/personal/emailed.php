<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peribadi */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Peribadis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peribadi-view">
<?php 
	if(isset($error)) {
?>
	<div class="alert alert-error alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong><?php print_r($error); ?></strong>
    </div>
<?php
	}
?>

    <h4>
        <p style="align:center;">
            Terima kasih kerana mendaftarkan dengan eProfiling. Satu pengesahan telah dihantar ke email <?= $model->emel; ?>. 
			Sila semak pada folder spam/junk atau seumpamanya sekiranya tidak dapat ditemui di dalam folder inbox.             
            Sila pastikan pengesahan dilakukan melalui email yang dihantar untuk memastikan maklumat pengguna adalah sah.
        </p>
    </h4>
</div>
