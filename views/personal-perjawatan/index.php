<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalPerjawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Perjawatans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-perjawatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personal Perjawatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_personal_perjawatan',
            'id_personal',
            'kategori_perjawatan',
            'id_ref_taraf_perjawatan',
            'nama_perjawatan',
            // 'id_ref_skim_perjawatan',
            // 'id_ref_gred_perjawatan',
            // 'id_agensi_institut',
            // 'nama_institut_lain',
            // 'nama_bidang_lain',
            // 'no_telefon_pejabat',
            // 'id_ref_purata_jam_mengajar',
            // 'tarikh_mula_perjawatan',
            // 'tarikh_tamat_perjawatan',
            // 'is_aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
