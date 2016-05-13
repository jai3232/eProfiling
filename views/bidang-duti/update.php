<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BidangDuti */

$this->title = 'Update Bidang Duti: ' . $model->id_bidang_duti;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Duti', 'url' => ['index', 'idbt' => $model->id_bidang_tier, 'idbi' => $bidang->id_bidang]];
$this->params['breadcrumbs'][] = ['label' => $model->id_bidang_duti, 'url' => ['view', 'id' => $model->id_bidang_duti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-duti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
