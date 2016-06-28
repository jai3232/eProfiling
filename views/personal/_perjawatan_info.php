<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\RefSkimPerjawatan;
use app\models\RefTarafPerjawatan;
use app\models\RefGredPerjawatan;
use app\models\AgensiInstitut;
use app\models\RefPurataJamMengajar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalPerjawatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Personal Perjawatans';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-perjawatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'perjawatanGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $perjawatanDataProvider,
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_personal_perjawatan',
            //'id_personal',
            [
                'attribute' => 'kategori_perjawatan',
                'label' => 'Katergori Perjawatan',
                'value' => function($model) {
                    return $model->kategori_perjawatan ? 'Pengurusan':'Latihan';    
                }
            ],
            // [
            //     'label' => 'Taraf Jawatan',
            //     'attribute' => 'id_ref_taraf_perjawatan',
            //     'value' => function($model) {
            //         return RefTarafPerjawatan::findOne(['id_ref_taraf_perjawatan' => $model->id_ref_taraf_perjawatan])['taraf_perjawatan'];
            //     }
            // ],
            'nama_perjawatan',
            // 'id_ref_skim_perjawatan',
            // 'id_ref_gred_perjawatan',
           // [
           //      'attribute' => 'id_agensi_institut',
           //      'label' => 'Agensi',
           //      'value' => function($model) {
           //          return $model->id_agensi_institut ? Agensi::findOne()[]:'Tiada';    
           //      }
           // ],
           //'nama_institut_lain',
           [
                'label' => 'Institut',
                //'attribute' => 'nama_institut_lain',
                'value' => function($model) {
                    return $model->id_agensi_institut? AgensiInstitut::findOne(['id_agensi_institut' => $model->id_agensi_institut])['nama_institut']:$model->nama_institut_lain;
                }
           ],
           'nama_bidang_lain',
            // 'no_telefon_pejabat',
            // 'id_ref_purata_jam_mengajar',
            'tarikh_mula_perjawatan',
            'tarikh_tamat_perjawatan',
            //'is_aktif',
            [
                'label' => 'Status Aktif',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model) {

                    if($model->is_aktif)
                        return '<span class="glyphicon glyphicon-ok"></span>';
                    return '<span class="glyphicon glyphicon-remove"></span>';
                }
            ],

            // [
            //     'class' => 'yii\grid\CheckboxColumn',
            //     'header' => 'Aktif',
            //     'contentOptions' => ['class' => 'text-center'],
            //     'checkboxOptions' => function ($model, $key, $index, $column) {
            //         return $model->is_aktif? 
            //             ['checked' => true, 'class' => 'jawatan-aktif-check', 'value' => Url::to(['personal-perjawatan/jawatan-update-active', 
            //              'id' => $model->id_personal_perjawatan, 'id_personal' => $model->id_personal])]
            //             : 
            //             ['checked' => false, 'class' => 'jawatan-aktif-check', 'value' => Url::to(['personal-perjawatan/jawatan-update-active', 
            //              'id' => $model->id_personal_perjawatan, 'id_personal' => $model->id_personal])];
            //     }

            // ],

            // ['class' => 'yii\grid\ActionColumn',
            //  'controller' => 'personal-perjawatan',
            //  'header' => 'Tindakan'
            // ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
