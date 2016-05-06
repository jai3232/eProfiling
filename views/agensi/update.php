<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agensi */

$this->title = 'Update Agensi: ' . $model->id_agensi;
$this->params['breadcrumbs'][] = ['label' => 'Agensis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_agensi, 'url' => ['view', 'id' => $model->id_agensi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agensi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
