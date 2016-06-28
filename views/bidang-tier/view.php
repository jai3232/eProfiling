<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BidangTier */

$this->title = $model->id_bidang_tier;
//$this->params['breadcrumbs'][] = ['label' => 'Bidang Tier', 'url' => ['index',  'idag' => Yii::$app->request->get('idag'), 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = ['label' => 'Tier', 'url' => ['index', 'idbi' => $model->id_bidang]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-tier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bidang_tier], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bidang_tier], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_bidang_tier',
            'idBidang.nama_bidang',
            //'subsektor:ntext',
            'kod_tier',
            'status_bidang_tier',
            'tarikh_pembangunan_tier',
        ],
    ]) ?>

</div>
