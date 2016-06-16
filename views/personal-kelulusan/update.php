<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalKelulusan */

// $this->title = 'Update Personal Kelulusan: ' . $model->id_personal_kelulusan;
// $this->params['breadcrumbs'][] = ['label' => 'Personal Kelulusans', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_personal_kelulusan, 'url' => ['view', 'id' => $model->id_personal_kelulusan]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="personal-kelulusan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
