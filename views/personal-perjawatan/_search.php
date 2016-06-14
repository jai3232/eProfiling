<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalPerjawatanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-perjawatan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_personal_perjawatan') ?>

    <?= $form->field($model, 'id_personal') ?>

    <?= $form->field($model, 'kategori_perjawatan') ?>

    <?= $form->field($model, 'id_ref_taraf_perjawatan') ?>

    <?= $form->field($model, 'nama_perjawatan') ?>

    <?php // echo $form->field($model, 'id_ref_skim_perjawatan') ?>

    <?php // echo $form->field($model, 'id_ref_gred_perjawatan') ?>

    <?php // echo $form->field($model, 'id_agensi_institut') ?>

    <?php // echo $form->field($model, 'nama_institut_lain') ?>

    <?php // echo $form->field($model, 'nama_bidang_lain') ?>

    <?php // echo $form->field($model, 'no_telefon_pejabat') ?>

    <?php // echo $form->field($model, 'id_ref_purata_jam_mengajar') ?>

    <?php // echo $form->field($model, 'tarikh_mula_perjawatan') ?>

    <?php // echo $form->field($model, 'tarikh_tamat_perjawatan') ?>

    <?php // echo $form->field($model, 'is_aktif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
