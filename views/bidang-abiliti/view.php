<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BidangAbiliti */

$this->title = $model->id_bidang_abiliti;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Abiliti', 'url' => ['index', 'idbd' => $model->id_bidang_duti, 'idbt' => $bidangTier->id_bidang_tier, 'idbi' =>$bidang->id_bidang]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-abiliti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create', ['create', 'idbd' => $model->id_bidang_duti, 'idbt' => $bidangTier->id_bidang_tier, 'idbi' =>$bidang->id_bidang], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id_bidang_abiliti], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bidang_abiliti], [
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
            'id_bidang_abiliti',
            'id_bidang_duti',
            'nombor_abiliti',
            'nama_abiliti',
            'jenis_abiliti',
            'importance',
            'status_bidang_abiliti',
            'tarikh_daftar',
            'tarikh_mati',
        ],
    ]) ?>

</div>
