<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalPerjawatan */

$this->title = $model->id_personal_perjawatan;
$this->params['breadcrumbs'][] = ['label' => 'Personal Perjawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-perjawatan-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->id_personal_perjawatan], ['class' => 'btn btn-primary']) ?>
        <?php //= Html::a('Delete', ['delete', 'id' => $model->id_personal_perjawatan], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => 'Are you sure you want to delete this item?',
            //     'method' => 'post',
            // ],
        //]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_personal_perjawatan',
            //'id_personal',
            'kategori_perjawatan',
            [
                'label' => 'Kategori Perjawatan',
                'value' => $model->kategori_perjawatan? 'Pengurusan':'Latihan',
            ],
            'id_ref_taraf_perjawatan',
            'nama_perjawatan',
            'id_ref_skim_perjawatan',
            'id_ref_gred_perjawatan',
            'id_agensi_institut',
            'nama_institut_lain',
            'nama_bidang_lain',
            'no_telefon_pejabat',
            'id_ref_purata_jam_mengajar',
            'tarikh_mula_perjawatan',
            'tarikh_tamat_perjawatan',
            //'is_aktif',
            [
                'label' => 'Aktif',
                'format' => 'raw',
                'value' => $model->is_aktif ? '<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>',
            ]
        ],
    ]) ?>

</div>
