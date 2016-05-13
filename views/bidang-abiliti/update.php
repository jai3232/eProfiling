<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BidangAbiliti */

$this->title = 'Update Bidang Abiliti: ' . $model->id_bidang_abiliti;
$this->params['breadcrumbs'][] = ['label' => 'Bidang Abiliti', 'url' => ['index', 'idbd' => $model->id_bidang_duti, 'idbt' => $bidangTier->id_bidang_tier, 'idbi' => $bidang->id_bidang]];
$this->params['breadcrumbs'][] = ['label' => $model->id_bidang_abiliti, 'url' => ['view', 'id' => $model->id_bidang_abiliti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-abiliti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
