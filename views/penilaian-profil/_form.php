<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianProfil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penilaian-profil-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_penilaian_profil')->textInput() ?>

    <?= $form->field($model, 'id_personal_bidang')->textInput() ?>

    <?= $form->field($model, 'id_agensi_institut')->textInput() ?>

    <?= $form->field($model, 'tarikh_penilaian')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
