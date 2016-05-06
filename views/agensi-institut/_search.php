<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgensiInstitutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agensi-institut-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_agensi_institut') ?>

    <?= $form->field($model, 'id_agensi') ?>

    <?= $form->field($model, 'kod_institut') ?>

    <?= $form->field($model, 'nama_institut') ?>

    <?= $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'alamat2') ?>

    <?php // echo $form->field($model, 'alamat3') ?>

    <?php // echo $form->field($model, 'bandar') ?>

    <?php // echo $form->field($model, 'poskod') ?>

    <?php // echo $form->field($model, 'negeri') ?>

    <?php // echo $form->field($model, 'no_tel') ?>

    <?php // echo $form->field($model, 'no_faks') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'portal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
