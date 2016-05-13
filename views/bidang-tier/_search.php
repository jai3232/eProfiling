<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BidangTierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-tier-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bidang_tier') ?>

    <?= $form->field($model, 'id_bidang') ?>

    <?= $form->field($model, 'subsektor') ?>

    <?= $form->field($model, 'kod_tier') ?>

    <?= $form->field($model, 'status_bidang_tier') ?>

    <?php // echo $form->field($model, 'tarikh_pembangunan_tier') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
