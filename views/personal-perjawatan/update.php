<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalPerjawatan */

// $this->title = 'Update Personal Perjawatan: ' . $model->id_personal_perjawatan;
// $this->params['breadcrumbs'][] = ['label' => 'Personal Perjawatans', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_personal_perjawatan, 'url' => ['view', 'id' => $model->id_personal_perjawatan]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-perjawatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
