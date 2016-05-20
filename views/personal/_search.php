<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_personal') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_kp') ?>

    <?= $form->field($model, 'id_personal_penyelia') ?>

    <?= $form->field($model, 'emel') ?>

    <?php // echo $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'status_oku') ?>

    <?php // echo $form->field($model, 'jenis_oku') ?>

    <?php // echo $form->field($model, 'status_warganegara') ?>

    <?php // echo $form->field($model, 'nama_warganegara') ?>

    <?php // echo $form->field($model, 'bangsa') ?>

    <?php // echo $form->field($model, 'bangsa_lain') ?>

    <?php // echo $form->field($model, 'status_perkahwinan') ?>

    <?php // echo $form->field($model, 'alamat1') ?>

    <?php // echo $form->field($model, 'alamat2') ?>

    <?php // echo $form->field($model, 'bandar') ?>

    <?php // echo $form->field($model, 'poskod') ?>

    <?php // echo $form->field($model, 'negeri') ?>

    <?php // echo $form->field($model, 'no_telefon_peribadi') ?>

    <?php // echo $form->field($model, 'gambar_personal') ?>

    <?php // echo $form->field($model, 'katalaluan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tahap_akses') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
