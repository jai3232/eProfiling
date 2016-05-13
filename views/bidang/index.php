<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidang';
$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo ;?>

    <p>
        <?= Html::a('Tambah Bidang', ['create', 'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang',
            'idAgensi.kod_agensi',
            'kod_noss',
            'nama_bidang',
            'status_bidang',
            'id_jenis_kompetensi',

            ['class' => 'yii\grid\ActionColumn'],
            [
                'label' => 'Bidang Tier',
                'format' => 'raw',
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang-tier/index', 'idag' => $data->id_agensi, 'idbi' => $data->id_bidang], ['title' => 'List']);
                }
            ],
        ],

    ]); ?>
</div>
