<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidangSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-bidang-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_personal_bidang') ?>

    <?= $form->field($model, 'id_bidang') ?>

    <?= $form->field($model, 'id_personal_perjawatan') ?>

    <?= $form->field($model, 'is_aktif') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
