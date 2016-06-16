<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Personal;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

$negeri =   [
                '1' => 'Johor',
                '2' => 'Kedah',
                '3' => 'Kelantan',
                '4' => 'Melaka',
                '5' => 'Negeri Sembilan',
                '6' => 'Pahang',
                '7' => 'Pulau Pinang',
                '8' => 'Perak',
                '9' => 'Perlis',
                '10' => 'Selangor',
                '11' => 'Terengganu',
                '12' => 'Sabah',
                '13' => 'Sarawak',
                '14' => 'Kuala Lumpur',
                '15' => 'Labuan',
                '16' => 'Putrajaya'
            ];

$data = Personal::find()
    ->select(['id_personal AS value', 'CONCAT(nama, \' (No. KP: \', no_kp, \')\') AS label', 'id_personal AS id'])
    //->where()
    ->orderBy('nama')
    ->asArray()
    ->all();

?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_personal_penyelia')->widget(AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,//['1' => 'USA', '2' => 'RUS'],
                //'source' => json_encode($negeri, JSON_PRETTY_PRINT),
                'autoFill' => true,
            ],
            'options' => ['class' => 'form-control', 'onclick' => 'this.select();'],
        ])->label('ID Penyelia (Sila taip nama Penyelia)');
    ?>

    <?= $form->field($model, 'emel')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'jantina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jantina')->radioList(['L' => 'Lelaki', 'P' => 'Perempuan']) ?>

    <?= $form->field($model, 'status_oku')->checkbox() ?>

    <?= $form->field($model, 'jenis_oku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_warganegara')->checkbox() ?>

    <?= $form->field($model, 'nama_warganegara')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bangsa')->dropDownList(['1' => 'Melayu', '2' => 'Cina', '3' => 'India', '4' => 'Lain'], ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'bangsa_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_perkahwinan')->dropDownList(['0' => 'Bujang', '1' => 'Kahwin', '2' => 'Duda', '3' => 'Janda'], ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'alamat1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bandar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poskod')->textInput() ?>

    <?= $form->field($model, 'negeri')->dropDownList($negeri, ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'no_telefon_peribadi')->textInput(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord)
            echo Html::img('uploads/'.$model->gambar_personal, ['width' => 250, 'style' => 'border: 1px solid #333; border-radius: 5px;'])
    ?>

    <?= $form->field($model, 'image_file')->fileInput(['class' => 'form-control file'])  ?>

    <?php //= $form->field($model, 'katalaluan')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'status')->textInput() ?>

    <?php //= $form->field($model, 'tahap_akses')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


