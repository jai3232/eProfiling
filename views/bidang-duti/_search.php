<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BidangDutiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-duti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bidang_duti') ?>

    <?= $form->field($model, 'id_bidang_tier') ?>

    <?= $form->field($model, 'nombor_duti') ?>

    <?= $form->field($model, 'nama_duti') ?>

    <?= $form->field($model, 'status_bidang_duti') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
