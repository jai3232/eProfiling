<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BidangAbilitiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-abiliti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bidang_abiliti') ?>

    <?= $form->field($model, 'id_bidang_duti') ?>

    <?= $form->field($model, 'nombor_abiliti') ?>

    <?= $form->field($model, 'nama_abiliti') ?>

    <?= $form->field($model, 'jenis_abiliti') ?>

    <?php // echo $form->field($model, 'importance') ?>

    <?php // echo $form->field($model, 'status_bidang_abiliti') ?>

    <?php // echo $form->field($model, 'tarikh_daftar') ?>

    <?php // echo $form->field($model, 'tarikh_mati') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
