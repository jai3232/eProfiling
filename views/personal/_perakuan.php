<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php

$perakuan = 'Adalah saya mengaku bahawa semua maklumat adalah benar dan saya bertanggungjawab terhadap maklumat berkenaan. Saya juga membenarkan maklumat ini digunakan oleh Kementerian Sumber Manusia.';

?>

<div class="perakuan-form">
    <?php $form = ActiveForm::begin(['action' => ['personal/verify', 'id' => $model->id_personal]]); ?>

    <?= $form->field($model, 'id_ref_status_data')->checkbox(['value' => 3, 
                                                              'label' => $perakuan,
                                                              'disabled' => $model->id_ref_status_data == 3? true:false,
                                                              ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Hantar Perakuan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'data-confirm' => 'Hantar Perakauan?', 'class' => $model->id_ref_status_data == 3? 'hidden': 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
