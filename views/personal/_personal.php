<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['personal/update2', 'id' => $model->id_personal]]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_personal_penyelia')->textInput() ?>

    <?= $form->field($model, 'emel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jantina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_oku')->textInput() ?>

    <?= $form->field($model, 'jenis_oku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_warganegara')->textInput() ?>

    <?= $form->field($model, 'nama_warganegara')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bangsa')->textInput() ?>

    <?= $form->field($model, 'bangsa_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_perkahwinan')->textInput() ?>

    <?= $form->field($model, 'alamat1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bandar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poskod')->textInput() ?>

    <?= $form->field($model, 'negeri')->textInput() ?>

    <?= $form->field($model, 'no_telefon_peribadi')->textInput(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord)
            echo Html::img('uploads/'.$model->gambar_personal.'?'.rand(), ['width' => 250, 'style' => 'border: 1px solid #333; border-radius: 5px;'])
    ?>

    <?= $form->field($model, 'image_file')->fileInput(['class' => 'form-control file'])  ?>

    <?php //= $form->field($model, 'katalaluan')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'status')->textInput() ?>

    <?php //= $form->field($model, 'tahap_akses')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


