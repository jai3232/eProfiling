<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BidangTier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-tier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_bidang')->textInput() ?>

    <?= $form->field($model, 'subsektor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'kod_tier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_bidang_tier')->textInput() ?>

    <?php //= $form->field($model, 'tarikh_pembangunan_tier')->textInput() ?>

    <?= $form->field($model, 'tarikh_pembangunan_tier')->widget(DatePicker::className(), ['options' => ['class' => 'form-control', 'readonly' => 'readonly'], 'dateFormat' => 'dd/M/yyyy']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
