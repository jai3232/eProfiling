<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangAbilitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abiliti';
//$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Bidang ('.$bidang->nama_bidang.')', 'url' => ['bidang/index']];//, 'idag' => $bidang->id_agensi]];
$this->params['breadcrumbs'][] = ['label' => 'Tier ('.$bidangTier->kod_tier.')', 'url' => ['bidang-tier/index', 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = ['label' => 'Duti ('.$bidangDuti->nama_duti.')', 'url' => ['bidang-duti/index', 'idbt' => Yii::$app->request->get('idbt'), 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = $this->title;
//print_r($this->params);
?>
<div class="bidang-abiliti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Abiliti', ['create', 'idbi' => Yii::$app->request->get('idbi'), 'idbt' => Yii::$app->request->get('idbt'), 'idbd' => Yii::$app->request->get('idbd')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang_abiliti',
            //'idBidangDuti.nama_duti',
            'nombor_abiliti',
            'nama_abiliti',
            'jenis_abiliti',
            [
                'label' => 'Jenis Abiliti',
                'attribute' => 'jenis_abiliti',
                'format' => 'raw',
                'value' => 'jenis_abiliti',
                'filter' => ['A' => 'Attitude', 'S' => 'Skill', 'K' => 'Knowledge'],
            ],
            [
                'label' => 'Importance',
                'attribute' => 'importance',
                'format' => 'raw',
                'value' => 'importance',
                'filter' => ['A' => 'Very Important', 'B' => 'Moderate', 'C' => 'Not so important'],
            ],
            
            //'status_bidang_abiliti',
            'tarikh_daftar',
            'tarikh_mati',

            ['header' => 'Tindakan', 'class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
