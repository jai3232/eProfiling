<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AgensiInstitut */

$this->title = $model->id_agensi_institut;
$this->params['breadcrumbs'][] = ['label' => 'Agensi Institut', 'url' => ['list', 'idag' => $model->id_agensi]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agensi-institut-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_agensi_institut], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_agensi_institut, 'agensi' =>  $model->id_agensi], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'attributes' => [
            'id_agensi_institut',
            //'id_agensi',
            'idAgensi.kod_agensi',
            'kod_institut',
            'nama_institut',
            'alamat',
            'bandar',
            'poskod',
            'negeri',
            'no_tel',
            'no_faks',
            'email:email',
            'portal',
        ],
    ]) ?>

</div>
