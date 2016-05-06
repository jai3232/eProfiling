<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AgensiInstitut */

$this->title = 'Update Agensi Institut: ' . $model->id_agensi_institut;
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Agensi Institut', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_agensi_institut, 'url' => ['view', 'id' => $model->id_agensi_institut]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agensi-institut-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
