<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalBidangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Personal Bidangs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-bidang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Tambah Bidang', ['personal-bidang/create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Tambah Bidang', ['value' => Url::to(['personal-bidang/create', 'id' => $id_personal]), 'class' => 'btn btn-success', 'id' => 'tambah-bidang']) ?>
    </p>
    <?php  
        Modal::begin([
            'header' => '<h3 id="modal-header3">Tambah Bidang</h3>',
            'id' => 'modal3',
            'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
         ]);

        echo '<div id="modalContent3"></div>';

        Modal::end();


    ?>
    <?php Pjax::begin(['id' => 'bidangGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $bidangDataProvider,
        //'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_personal_bidang',
            [
                'label' => 'Bidang',
                'attribute' => 'id_bidang',
                'value' => 'idBidang.nama_bidang',
            ],
            //id_bidang',
            //'id_personal_perjawatan',
            [
                'label' => 'Perjawatan',
                'value' => 'idPersonalPerjawatan.nama_perjawatan',
            ],
            //'is_aktif',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => 'Aktif',
                'contentOptions' => ['class' => 'text-center'],
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return $model->is_aktif? 
                        ['checked' => true, 'class' => 'bidang-aktif-check', 'value' => Url::to(['personal-bidang/bidang-update-active', 
                         'id' => $model->id_personal_bidang, 'id_personal' => $model->id_personal])]
                        : 
                        ['checked' => false, 'class' => 'bidang-aktif-check', 'value' => Url::to(['personal-bidang/bidang-update-active', 
                         'id' => $model->id_personal_bidang, 'id_personal' => $model->id_personal])];
                }

            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Tindakan',
                'controller' => 'personal-bidang',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
