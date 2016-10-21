<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\RefJenisKompetensi;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidang';
//$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->identity->accessLevel([0, 1, 6])) { ?>
    <p>
        <?= Html::a('Tambah Bidang', ['create', 'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang',
            'kod_noss',
            'sub_sektor',
            'nama_bidang',
            //'status_bidang',
            //'id_jenis_kompetensi',
            [
                'label' => 'Jenis Kompetensi',
                'attribute' => 'id_jenis_kompetensi',
                'format' => 'raw',
                'value' => 'idJenisKompetensi.nama_kompetensi',
                'filter' => ArrayHelper::map(RefJenisKompetensi::find()->all(), 'id_jenis_kompetensi', 'nama_kompetensi'),
            ],
            ['header' => 'Tindakan', 'class' => 'yii\grid\ActionColumn', 'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false],
            [
                'label' => 'Senarai Tier',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false,
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang-tier/index', 'idbi' => $data->id_bidang], ['title' => 'List']);
                }
            ],
        ],

    ]); ?>
</div>
