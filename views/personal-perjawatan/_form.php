<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\RefSkimPerjawatan;
use app\models\RefTarafPerjawatan;
use app\models\RefGredPerjawatan;
use app\models\Agensi;
use app\models\AgensiInstitut;
use app\models\RefPurataJamMengajar;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalPerjawatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-perjawatan-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?php //= $form->field($model, 'id_personal')->textInput() ?>

    <?= $form->field($model, 'kategori_perjawatan')->radioList(['0' => 'Latihan', '1' => 'Pengurusan'], ['style' => 'font-weight:normal;']) ?>

    <?= $form->field($model, 'id_ref_taraf_perjawatan')->dropDownList(ArrayHelper::map(RefTarafPerjawatan::find()->all(), 'id_ref_taraf_perjawatan', 'taraf_perjawatan'), ['prompt' => 'Sila Pilih'])->label('Taraf Jawatan') ?>

    <?= $form->field($model, 'nama_perjawatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ref_skim_perjawatan')->dropDownList(ArrayHelper::map(RefSkimPerjawatan::find()->all(), 'id_ref_skim_perjawatan', 'nama_skim_perjawatan', 'kod_skim_perjawatan'), ['prompt' => 'Sila Pilih'])->label('Skim Jawatan') ?>

    <?= $form->field($model, 'id_ref_gred_perjawatan')->dropDownList(ArrayHelper::map(RefGredPerjawatan::find()->all(), 'id_ref_gred_perjawatan', 'gred_perjawatan'), ['prompt' => 'Sila Pilih'])->label('Gred Jawatan') ?>

    <div class="form-group">
        <label class="control-label">Agensi</label>
    <?= Html::dropDownList('agensi', '', ArrayHelper::map(Agensi::find()->all(), 'id_agensi', 'nama_agensi'), 
                          ['class' => 'form-control', 
                           'prompt' => 'Sila Pilih',
                           'onchange' => '$.post("'.Yii::$app->urlManager->createUrl(['personal-perjawatan/list', 'id' => '']).'"+$(this).val(), function(data){$("#personalperjawatan-id_agensi_institut").html(data);})'
                          ]

                          ) ?>

    </div>

    <?= $form->field($model, 'id_agensi_institut')->dropDownList(ArrayHelper::map(AgensiInstitut::find()->all(), 'id_agensi_institut', 'nama_institut'), ['prompt' => '-'])->label('Institut Agensi') ?>


    <?= $form->field($model, 'nama_institut_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_bidang_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_telefon_pejabat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_ref_purata_jam_mengajar')->dropDownList(ArrayHelper::map(RefPurataJamMengajar::find()->all(), 'id_ref_purata_jam_mengajar', 'purata_jam_mengajar'), ['prompt' => 'Sila Pilih'])->label('Purata Jam Mengajar Seminggu') ?>

    <?= $form->field($model, 'tarikh_mula_perjawatan')->widget(DatePicker::className(), ['options' => ['class' => 'form-control datepicker', 'readonly' => 'readonly'], 
                                                                                'dateFormat' => 'php:Y-m-d', 
                                                                                'clientOptions' => ['setDate' => date('Y-m-d'), 'changeYear'=> true],
                                                                                'value' => date('Y-m-d'),
                                                                                
                                                                                ]) ?>

    <?= $form->field($model, 'tarikh_tamat_perjawatan')->widget(DatePicker::className(), ['options' => ['class' => 'form-control datepicker', 'readonly' => 'readonly'], 
                                                                                'dateFormat' => 'php:Y-m-d', 
                                                                                'clientOptions' => ['setDate' => date('Y-m-d'), 'changeYear'=> true],
                                                                                'value' => date('Y-m-d'),
                                                                                
                                                                                ]) ?>

    <?= $form->field($model, 'is_aktif')->checkbox(['label' => 'Aktif?']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(){

    var form = $(this);
    //alert(form.attr('action'));
    $.post(
        form.attr('action'),
        form.serialize()
    )
        .done(function(data){
            if($.trim(data) == 1) {
                form.trigger('reset');
                $.pjax.reload({container: '#perjawatanGrid'});
            }
            if($.trim(data) == 2) {
                $('#modalContent').html('Berjaya');
                $.pjax.reload({container: '#perjawatanGrid'});
            }
            else {
                alert('error:'+data);
            }
        })
        .fail();
    return false;
})


JS;
$this->registerJs($script);

?>