<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Bidang;
use app\models\BidangInstitut;
use app\models\PersonalPerjawatan;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-bidang-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>
    <?php
        // print_r(Bidang::findOne(['id_bidang' => 5])->attributes['nama_bidang']);
        $id_personal = Yii::$app->user->identity->id_personal;
        $id_agensi_institut = PersonalPerjawatan::find()->where(['id_personal' => $id_personal, 'is_aktif' => 1])->one()->attributes['id_agensi_institut'];
        
        $bidang = Bidang::find()->joinWith('bidangInstituts')
                                ->where(['bidang_institut.id_agensi_institut' => $id_agensi_institut])
                                ->all();
    ?>
    <?= $form->field($model, 'id_bidang')->dropDownList(ArrayHelper::Map($bidang, 'id_bidang', 'nama_bidang'), ['prompt' => '- Sila Pilih -', 'data-live-search' => 'true'])->label('Bidang') ?>

    <?php // = $form->field($model, 'id_personal_perjawatan')->textInput(['readonly' => true, 'value' => 'Your Value']) ?>

    <?php // = $form->field($model, 'id_personal')->textInput() ?>

    <?php //= $form->field($model, 'is_aktif')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>