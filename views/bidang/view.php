<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bidang */

$this->title = $model->id_bidang;
$this->params['breadcrumbs'][] = ['label' => 'Bidang', 'url' => ['index', 'idag' => $model->id_agensi]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bidang], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bidang], [
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
            'id_bidang',
            'id_agensi',
            'kod_noss',
            'nama_bidang',
            'status_bidang',
            'id_jenis_kompetensi',
        ],
    ]) ?>

</div>
