<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\RefTahapKelulusan;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalKelulusan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-kelulusan-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?php //= $form->field($model, 'id_personal')->textInput() ?>

    <?= $form->field($model, 'id_ref_tahap_kelulusan')->dropDownList(ArrayHelper::map(RefTahapKelulusan::find()->all(), 'id_ref_tahap_kelulusan', 'tahap_kelulusan'), ['prompt' => 'Sila Pilih'])->label('Tahap Kelulusan'); ?>

    <?= $form->field($model, 'institusi_kelulusan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pengkhususan_kelulusan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tahun_dapat_sijil')->textInput() ?>

    <?= $form->field($model, 'tahun_lupus_sijil')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(){

    var form = $(this);
    //alert(form.attr('action'));
    //return false;
    $.post(
        form.attr('action'),
        form.serialize()
    )
        .done(function(data){
            if($.trim(data) == 1) {
                form.trigger('reset');
                $.pjax.reload({container: '#kelulusanGrid'});
            }
            else
            if($.trim(data) == 2) {
                $('#modalContent2').html('<h4>Berjaya</h4>');
                $.pjax.reload({container: '#kelulusanGrid'});
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
