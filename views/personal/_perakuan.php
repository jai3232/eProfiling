<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="personal-form">

    <?php $form = ActiveForm::begin( ['action' => ['personal/verify', 'id' => $model->id_personal]]); ?>


    <?= $form->field($model, 'id_ref_status_data')->checkbox(['value' => 3, 'label' => 'Perakuan', 'disabled' => $model->id_ref_status_data == 3? true:false]) ?>

    <div class="form-group">
        <?= Html::submitButton('Sah Perakuan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 
                                                'data-confirm' => 'Buat Perakuan?',
                                                'class' => 'hidden',
                              ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>