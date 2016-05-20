<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Agensi;

/* @var $this yii\web\View */
/* @var $model app\models\Peribadi */
/* @var $form ActiveForm */
?>
<div class="site-personal">

    <?php $form = ActiveForm::begin(); ?>
        <h3 style="text-align:center;">Anda telah mendaftar. Sila klik pada butang kemaskini sekiranya anda ingin mengemaskini profail peribagi anda.</h3>
        <?= $form->field($model, 'no_kp')->hiddenInput()->label(false); ?>

        <?php //= $form->field($model, 'tarikh_kemaskini')->hiddenInput()->label(false); ?>

    
        <div class="form-group">
            <?= Html::submitButton('Kemaskini', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-personal -->
