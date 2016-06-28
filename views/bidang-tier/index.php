<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangTierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tier';
//$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Bidang ('.$model->nama_bidang.')', 'url' => ['bidang/index', 'idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;
//echo "X". $dataProvider->idag
//print_r($dataProvider);
;
?>
<div class="bidang-tier-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Tier', ['create', 'idag' => Yii::$app->request->get('idag'), 'idbi' => Yii::$app->request->get('idbi')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang_tier',
            //'id_bidang',
            'idBidang.nama_bidang',
            //'subsektor:ntext',
            'kod_tier',
            //'status_bidang_tier',
            'tarikh_pembangunan_tier',

            ['header' => 'Tindakan', 'class' => 'yii\grid\ActionColumn'],
            [
                'label' => 'Senarai Duti',
                'format' => 'raw',
                'contentOptions' =>['style'=>'display:block; text-align: center;'],
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang-duti/index', 'idbi' => $data->id_bidang, 'idbt' => $data->id_bidang_tier, ], ['title' => 'List']);
                }
            ],
        ],
    ]); ?>
</div>
