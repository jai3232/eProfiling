<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model app\models\Bidang */

$this->title = 'Tambah Bidang';
$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Bidang', 'url' => ['index', 'idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'jenisKompetensi' => $jenisKompetensi,
    ]) ?>

</div>
