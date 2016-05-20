<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Personal */

$this->title = 'Daftar Personal';
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="info">
	<ol>
		<li>Anda akan mendapat satu email pengesahan selepas mendaftar pada sistem ini.</li>
		<li>Akaun anda perlu diaktifkan dahulu oleh admin agensi/institut untuk memboleh capaian ke dalam sistem.</li>
	</ol>
</div>
<div class="personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_kp')->textInput(['maxlength' => true])->textInput(['readonly' => true, 'value' => $no_kp]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emel_repeat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($agensi, 'nama_agensi')->dropDownList(ArrayHelper::map($agensi->find()->all(), 
    																											'id_agensi', 'nama_agensi'),
    																											[
    																												'prompt' => '- Sila Pilih -',
    																												'onchange' => '$.post("'.Yii::$app->urlManager->createUrl(['personal/list', 'id' => ''])
    																																								.'"+$(this).val(), function(data){$("#personalperjawatan-id_agensi_institut").html(data);})'
    																											]) ?>

    <?= $form->field($perjawatan, 'id_agensi_institut')->dropDownList(['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), []) ?><?php //echo $this->getVerifyCode(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
