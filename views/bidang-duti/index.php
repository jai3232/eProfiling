<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangDutiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidang Duti';
//$this->params['breadcrumbs'][] = ['label' => 'Agensi ('.$agensi->kod_agensi.')', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Bidang ('.$bidang->nama_bidang.')', 'url' => ['bidang/index']];
$this->params['breadcrumbs'][] = ['label' => 'Bidang Tier ('.$bidangTier->kod_tier.')', 'url' => ['bidang-tier/index', 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-duti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Bidang Duti', ['create', 'idbi' => Yii::$app->request->get('idbi'), 'idbt' => Yii::$app->request->get('idbt')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang_duti',
            'idBidangTier.kod_tier',
            'nombor_duti',
            'nama_duti',
            'status_bidang_duti',

            ['class' => 'yii\grid\ActionColumn'],
            [
                'label' => 'Bidang Abiliti',
                'format' => 'raw',
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang-abiliti/index', 'idbi' => Yii::$app->request->get('idbi'), 'idbt' =>Yii::$app->request->get('idbt'), 'idbd' => $data->id_bidang_duti], ['title' => 'List']);
                }
            ],
        ],
    ]); ?>
</div>
