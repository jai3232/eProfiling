<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = $model->id_personal;
$this->params['breadcrumbs'][] = ['label' => 'Personals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_personal], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_personal], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_personal',
            'nama',
            'no_kp',
            'id_personal_penyelia',
            'emel',
            'jantina',
            'status_oku',
            'jenis_oku',
            'status_warganegara',
            'nama_warganegara',
            'bangsa',
            'bangsa_lain',
            'status_perkahwinan',
            'alamat1',
            'alamat2',
            'bandar',
            'poskod',
            'negeri',
            'no_telefon_peribadi',
            'gambar_personal',
            'katalaluan',
            'status',
            'tahap_akses',
        ],
    ]) ?>

</div>