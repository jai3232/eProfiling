<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianProfil */

$this->title = 'Update Penilaian Profil: ' . $model->id_penilaian_profil;
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penilaian_profil, 'url' => ['view', 'id' => $model->id_penilaian_profil]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
