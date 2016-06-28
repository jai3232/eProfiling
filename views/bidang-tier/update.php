<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BidangTier */

$this->title = 'Kemaskini Tier ';// . $model->id_bidang_tier;
$this->params['breadcrumbs'][] = ['label' => 'Tier', 'url' => ['index', 'idbi' => $model->id_bidang]];
$this->params['breadcrumbs'][] = ['label' => $model->id_bidang_tier, 'url' => ['view', 'id' => $model->id_bidang_tier]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>
<div class="bidang-tier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
