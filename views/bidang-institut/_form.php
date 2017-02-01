<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Bidang;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\BidangInstitut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bidang-institut-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id_agensi_institut')->textInput() ?>

    <?php //= $form->field($model, 'id_bidang')->textInput() ?>

    <?= $form->field($model, 'id_bidang')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Bidang::find()->all(), 'id_bidang', 'nama_bidang'),
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Bidang ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
