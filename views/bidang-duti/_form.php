<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BidangDuti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-duti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_bidang_tier')->textInput() ?>

    <?= $form->field($model, 'nombor_duti')->textInput() ?>

    <?= $form->field($model, 'nama_duti')->textInput(['maxlength' => true]) ?>

    <?php
    	if(!$model->isNewRecord)
     		echo $form->field($model, 'status_bidang_duti')->checkBox();
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
