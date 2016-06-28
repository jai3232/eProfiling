<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BidangDuti */

$this->title = $model->id_bidang_duti;
$this->params['breadcrumbs'][] = ['label' => 'Duti', 'url' => ['index', 'idbt' => $model->id_bidang_tier, 'idbi' => $bidang->id_bidang]];
$this->params['breadcrumbs'][] = $this->title;
///print_r($model->getIdBidangTier()->primaryModel);
?>
<div class="bidang-duti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bidang_duti], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bidang_duti], [
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
            'id_bidang_duti',
            'idBidangTier.kod_tier',
            'nombor_duti',
            'nama_duti',
            'status_bidang_duti',
        ],
    ]) ?>

</div>
