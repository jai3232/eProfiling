<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bidang */

$this->title = 'Update Bidang: ' . $model->id_bidang;
$this->params['breadcrumbs'][] = ['label' => 'Bidangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_bidang, 'url' => ['view', 'id' => $model->id_bidang]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bidang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
