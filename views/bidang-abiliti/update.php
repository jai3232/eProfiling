<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BidangAbiliti */

$this->title = 'Kemaskini Abiliti ';// . $model->id_bidang_abiliti;
$this->params['breadcrumbs'][] = ['label' => 'Abiliti', 'url' => ['index', 'idbd' => $model->id_bidang_duti, 'idbt' => $bidangTier->id_bidang_tier, 'idbi' => $bidang->id_bidang]];
$this->params['breadcrumbs'][] = ['label' => $model->id_bidang_abiliti, 'url' => ['view', 'id' => $model->id_bidang_abiliti]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-abiliti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
