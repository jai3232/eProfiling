<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidang */

$this->title = $model->id_personal_bidang;
$this->params['breadcrumbs'][] = ['label' => 'Personal Bidangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-bidang-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->id_personal_bidang], ['class' => 'btn btn-primary']) ?>
        <?php //= Html::a('Delete', ['delete', 'id' => $model->id_personal_bidang], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => 'Are you sure you want to delete this item?',
            //     'method' => 'post',
            // ],
        //]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_personal_bidang',
            'idBidang.nama_bidang',
            //'id_personal_perjawatan',
            'idPersonalPerjawatan.nama_perjawatan',
            [
                'label' => 'Aktif',
                'value' => $model->is_aktif ? 'Ya' : 'Tidak',
            ]
            //'is_aktif',
        ],
    ]) ?>

</div>
