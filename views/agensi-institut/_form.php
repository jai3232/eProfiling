<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AgensiInstitut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agensi-institut-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kod_institut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_institut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bandar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poskod')->textInput() ?>

    <?= $form->field($model, 'negeri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_faks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'portal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
