<?php

use yii\helpers\Html;
use app\models\Agensi;

/* @var $this yii\web\View */
/* @var $model app\models\AgensiInstitut */


$this->title = 'Tambah Institut Agensi '.Agensi::findOne(['id_agensi' => $model->id_agensi])->kod_agensi;//.$model->getIdAgensi();//->nama_agensi;

$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Institut Agensi', 'url' =>  ['list', 'idag' => $model->id_agensi]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agensi-institut-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if($error)print_r($error); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
