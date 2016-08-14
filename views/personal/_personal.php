<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use app\models\Personal;
use app\models\PersonalPerjawatan;
//use yii\web\JsExpression;
//use yii\helpers\ArrayHelper;
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

$id_personal = Yii::$app->user->identity->id_personal;
if(count(PersonalPerjawatan::findAll(['id_personal' => $id_personal])) > 0) {
    $id_institut = PersonalPerjawatan::find()->select('id_agensi_institut')->where(['is_aktif' => 1, 'id_personal' => $id_personal])->one()->attributes['id_agensi_institut'];
    $where_institut = ['personal_perjawatan.id_agensi_institut' => $id_institut];
}
else
    $where_institut = '';
//print_r($id_institut);

$data = Personal::find()
    ->select(['personal.id_personal', 'personal.id_personal AS value', 'CONCAT(personal.nama, \' (No. KP: \', personal.no_kp, \')\') AS label', 'personal.id_personal AS id'])
    ->joinWith('personalPerjawatans')
    ->where($where_institut)
    ->orderBy('nama')
    ->asArray()
    ->all();

//print_r($data);

?>

<div class="personal-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['personal/update2', 'id' => $model->id_personal]]); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_kp')->textInput(['maxlength' => true]) ?>

    <?php /*echo $form->field($model, 'id_personal_penyelia')->widget(AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,//['1' => 'USA', '2' => 'RUS'],
                //'source' => json_encode($negeri, JSON_PRETTY_PRINT),
                'autoFill' => true,
            ],
            'options' => ['class' => 'form-control', 'onclick' => 'this.select();'],
        ])->label('ID Penyelia (Sila taip nama / no. KP Penyelia)');*/
    ?>
    <!-- <div class="form-group">
        <label class="control-label" for="personal-id_personal_penyelia">ID Penyelia</label> -->
    <?php
        // echo AutoComplete::widget([
        //         'name' => 'Personal',
        //         'id' => 'ddd',
        //         'clientOptions' => [
        //             'source' => $data,
        //             'autoFill' => true,
        //             'minLegth' => '4',
        //             'select' => new JsExpression("function(event, ui){
        //                 $('#personal-id_personal_penyelia').val(ui.item.id);
        //             }"),
        //         ],
        //         'options' => ['class' => 'form-control'],
        //     ]);

    ?>
    <!-- </div> -->

    <?= $form->field($model, 'emel')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'jantina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jantina')->radioList(['L' => 'Lelaki', 'P' => 'Perempuan']) ?>

    <?= $form->field($model, 'status_oku')->radioList(['0' => 'Tidak', '1' => 'Ya']) ?>

    <?= $form->field($model, 'jenis_oku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_warganegara')->checkbox() ?>

    <?= $form->field($model, 'nama_warganegara')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bangsa')->dropDownList(['1' => 'Melayu', '2' => 'Cina', '3' => 'India', '4' => 'Lain'], ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'bangsa_lain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_perkahwinan')->dropDownList(['0' => 'Bujang', '1' => 'Kahwin'], ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'alamat1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bandar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poskod')->textInput() ?>

    <?= $form->field($model, 'negeri')->dropDownList($negeri, ['prompt' => '- Sila Pilih -']) ?>

    <?= $form->field($model, 'no_telefon_peribadi')->textInput(['maxlength' => true]) ?>

    <?php
        if(!$model->isNewRecord)
            echo Html::img('uploads/'.$model->gambar_personal.'?'.rand(), ['width' => 250, 'style' => 'border: 1px solid #333; border-radius: 5px;'])
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


