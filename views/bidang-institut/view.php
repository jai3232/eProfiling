<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BidangInstitut */

$this->title = "Lihat Bidang Institut : ".$agensiInstitut->nama_institut;
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Institut', 'url' => ['agensi-institut/index','idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = ['label' => 'Bidang', 'url' => ['index','idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-institut-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Pinda', ['update', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], [
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
            //'id_bidang_institut',
            //'id_agensi_institut',
            //'id_bidang',
            ['attribute'=>'id_agensi_institut','value'=>$agensiInstitut->nama_institut],
            'idBidang.nama_bidang',
            //['attribute'=>'id_bidang','value'=>'idBidang.nama_bidang'],
        ],
    ]) ?>

</div>
