<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\BidangAbiliti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-abiliti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_bidang_duti')->textInput() ?>

    <?= $form->field($model, 'nombor_abiliti')->textInput() ?>

    <?= $form->field($model, 'nama_abiliti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_abiliti')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'importance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_bidang_abiliti')->textInput() ?>

    <?= $form->field($model, 'tarikh_daftar')->widget(DatePicker::className(), ['options' => ['class' => 'form-control datepicker', 'readonly' => 'readonly'], 
                                                                                'dateFormat' => 'php:Y-m-d', 
                                                                                'clientOptions' => ['setDate' => date('Y-m-d'), 'changeYear'=> true],
                                                                                'value' => date('Y-m-d'),
                                                                                
                                                                                ]) ?>

    <?= $form->field($model, 'tarikh_mati')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control', 'readonly' => 'readonly'],
                                                                                           'dateFormat' => 'yyyy-MM-dd',
                                                                                           'clientOptions' => ['setDate' => date('Y-m-d'), 'defaultValue'  => date('Y-m-d'), 'changeYear'=> true],
                                                                                           'value' => date('Y-m-d'),

                                                                                          ]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$code = '$("#bidangabiliti-tarikh_daftar").val("'.date('Y-m-d').'");';
$this->registerJs($code, View::POS_END);

?>
