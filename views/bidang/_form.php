<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bidang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_agensi')->textInput() ?>

    <?= $form->field($model, 'kod_noss')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_sektor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_bidang')->textInput(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord)
            echo $form->field($model, 'status_bidang')->checkBox();
    ?>

    <?= $form->field($model, 'id_jenis_kompetensi')->dropDownList(ArrayHelper::map($jenisKompetensi->find()->all(),
                                                                    'id_jenis_kompetensi', 'nama_kompetensi'),
                                                                    ['prompt' => '- Sila Pilih -']
                                                    )->label('Jenis Kompetensi')?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
