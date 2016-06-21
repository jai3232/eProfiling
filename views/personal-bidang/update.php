<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidang */

// $this->title = 'Update Personal Bidang: ' . $model->id_personal_bidang;
// $this->params['breadcrumbs'][] = ['label' => 'Personal Bidangs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_personal_bidang, 'url' => ['view', 'id' => $model->id_personal_bidang]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-bidang-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
