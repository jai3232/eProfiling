<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BidangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bidang') ?>

    <?= $form->field($model, 'id_agensi') ?>

    <?= $form->field($model, 'kod_noss') ?>

    <?= $form->field($model, 'nama_bidang') ?>

    <?= $form->field($model, 'status_bidang') ?>

    <?php // echo $form->field($model, 'id_jenis_kompetensi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
