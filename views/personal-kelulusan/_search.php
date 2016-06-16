<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalKelulusanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-kelulusan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_personal_kelulusan') ?>

    <?= $form->field($model, 'id_personal') ?>

    <?= $form->field($model, 'id_ref_tahap_kelulusan') ?>

    <?= $form->field($model, 'institusi_kelulusan') ?>

    <?= $form->field($model, 'pengkhususan_kelulusan') ?>

    <?php // echo $form->field($model, 'tahun_dapat_sijil') ?>

    <?php // echo $form->field($model, 'tahun_lupus_sijil') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
