<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bidang';
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Bidang', ['create', 'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_bidang',
            'idAgensi.kod_agensi',
            'kod_noss',
            'nama_bidang',
            'status_bidang',
            'id_jenis_kompetensi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
