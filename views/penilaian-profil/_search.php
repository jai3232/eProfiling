<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianProfilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-profil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_penilaian_profil') ?>

    <?= $form->field($model, 'id_personal_bidang') ?>

    <?= $form->field($model, 'id_agensi_institut') ?>

    <?= $form->field($model, 'tarikh_penilaian') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
