<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Bidang;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-bidang-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'id_bidang')->dropDownList(ArrayHelper::Map(Bidang::find()->all(), 'id_bidang', 'nama_bidang'), ['prompt' => '- Sila Pilih -'])->label('Bidang') ?>

    <?php // = $form->field($model, 'id_personal_perjawatan')->textInput(['readonly' => true, 'value' => 'Your Value']) ?>

    <?php // = $form->field($model, 'id_personal')->textInput() ?>

    <?php //= $form->field($model, 'is_aktif')->textInput() ?>

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
            if($.trim(data) == 1) { // if create success
                form.trigger('reset');
                $.pjax.reload({container: '#bidangGrid'});
            }
            else
            if($.trim(data) == 2) { // if uddate success
                $('#modalContent2').html('<h4>Berjaya</h4>');
                $.pjax.reload({container: '#bidangGrid'});
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
