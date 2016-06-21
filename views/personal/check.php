<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Agensi;

/* @var $this yii\web\View */
/* @var $model app\models\Peribadi */
/* @var $form ActiveForm */

$this->title = 'Periksa No Kad Pengenalan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-personal">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'no_kp') ?>

        <?php
            if(isset($nokp)) {
        ?>
        XXX
        <?php
            }
        ?>
    
        <div class="form-group">
            <?= Html::submitButton('Periksa No KP', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-personal -->
