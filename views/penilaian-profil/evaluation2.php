<?php

use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\PenilaianProfil;
use app\models\PenilaianMarkah;
use app\models\Personal;
use app\models\PersonalBidang;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;


$this->title = 'Penilaian Markah Penyelia';
$this->params['breadcrumbs'][] = ['label' => 'Profail Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$score = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

?>
<div class="penilaian-markah">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="list-group">
      <a href="#" class="list-group-item active"><strong>Petunjuk</strong></a>
      <a href="#" class="list-group-item">1. Tidak dapat melakukan kerja tanpa pengawasan / Tidak tahu apa-apa / Tiada pengetahuan</a>
      <a href="#" class="list-group-item">2. Dapat melakukan kerja tapi masih perlukan bantuan / Sedikit pengetahuan</a>
      <a href="#" class="list-group-item">3. Dapat melakukan kerja sendiri / ada pengetahuan / Boleh dipercayai</a>
      <a href="#" class="list-group-item">4. Mampu melakukan kerja sendiri / Banyak pengetahuan / Boleh mengajar tapi tidak kreatif</a>
      <a href="#" class="list-group-item">5. Mampu melakukan kerja sendiri dengan lengkap dan boleh mengarah / Pengetahuan yang mencukupi / Boleh mengajar, membangun dan menasihat</a>
      <a href="#" class="list-group-item">A = Sangat Penting</a>
      <a href="#" class="list-group-item">B = Penting</a>
      <a href="#" class="list-group-item">C = Kurang Penting</a>
    </div>
<?php echo Html::beginForm(['supervise'], 'post', ['id' => 'supervise']); ?>
<?= Html::hiddenInput('id_penilaian_profil', Yii::$app->request->get('id')? Yii::$app->request->get('id') : $id_penilaian_profil, []) ?>

<?php Pjax::begin(['id' => 'penilaianGrid']); ?>
<?php  echo GridView::widget([
        'id' => 'penilaian-tablel',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'nombor_abiliti',
            [
                'label' => 'Nombor Abiliti',
                'header' => 'Nombor <br>Abiliti',
                'value' => function($model) {
                    $bidang_duti = BidangDuti::findOne($model->id_bidang_duti);
                    return $bidang_duti->nombor_duti.'-'.$model->nombor_abiliti;
                }
            ],
            //'importance',
            [
                'header' => 'Tahap <br> Kepentingan',
                'attribute' => 'importance',
                'contentOptions' =>['style' => 'text-align:center;'],
                'value' => function($model) {
                    $importance = ['A' => 'Sangat Penting', 'B' => 'Penting', 'C' => 'Kurang Penting'];
                    return $model->importance;//.' ('.$importance[ $model->importance].')';
                }
            ],
            'nama_abiliti',
            //'id_bidang_abiliti',
            [
            	'header' => 'Skor Pengajar',//.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
            	'format' => 'raw',
                'contentOptions' =>['style' => 'width:270px; text-align:center;'],
            	'value' => function ($model, $key, $index, $grid) {
            		$score = [1 => '1, &nbsp;&nbsp;&nbsp;', 2 => '2, &nbsp;&nbsp;&nbsp;', 3 => '3, &nbsp;&nbsp;&nbsp;', 4 => '4, &nbsp;&nbsp;&nbsp;', 5 => 5];
                    //$score = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];
            		$id_penilaian_profil = Yii::$app->request->get('id');
            		$penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
            		if(count($penilaian_markah) > 0)
            			$markah = $penilaian_markah->attributes['markah'];
            		else
            			$markah = '';
                    //return print_r($markah);
            		return Html::radioList($model->id_bidang_abiliti, $markah, $score, ['class' => 'score-radio', 
                                                                                        'encode'=>false, 
        //                                                                                 // 'item' => function ($index, $label, $name, $checked, $value) {
        //                                                                                 //                 return Html::radio($name, $checked, [
        //                                                                                 //                     'value' => $value,
        //                                                                                 //                     'label' => Html::encode($label),
        //                                                                                 //                     'disabled' => true,
        //                                                                                 //                     'encode'=>false, 
        // ]);
        //                                                                                           }
                                                                                       ]);
            	}
            ],
            [
                'header' => 'Pengesahan Penyelia',//.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
                'format' => 'raw',
                'contentOptions' =>['style' => 'width:270px; text-align:center;'],
                'value' => function ($model, $key, $index, $grid) {
                    $score = [1 => '1, &nbsp;&nbsp;&nbsp;', 2 => '2, &nbsp;&nbsp;&nbsp;', 3 => '3, &nbsp;&nbsp;&nbsp;', 4 => '4, &nbsp;&nbsp;&nbsp;', 5 => 5];
                    //$score = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];
                    $id_penilaian_profil = Yii::$app->request->get('id');
                    $penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
                    if(count($penilaian_markah) > 0)
                        $markah_supervisor = $penilaian_markah->attributes['markah_supervisor'];
                    else
                        $markah_supervisor = '';
                    //return print_r($markah);
                    return Html::radioList('s'.$model->id_bidang_abiliti, $markah_supervisor, $score, ['class' => 'supervise-radio', 'encode'=>false]);
                }
            ],
            [
                'header' => 'Nota Penyelia',
                'format' => 'raw',
                'value' => function($model, $key, $index, $grid) {
                    $id_penilaian_profil = Yii::$app->request->get('id');
                    $penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
                    if(count($penilaian_markah) > 0)
                        $nota_supervisor = $penilaian_markah->attributes['nota_supervisor'];
                    else
                        $nota_supervisor = '';
                    return Html::textarea('n'.$model->id_bidang_abiliti, $nota_supervisor);
                }
            ]
        ],
    ]);
?>
<?php Pjax::end(); ?>

<?php 
    // echo 
    // DataTables::widget([
    //     'dataProvider' => $dataProvider,
    //     //'filterModel' => $searchModel,
    //     'showOnEmpty' => false,
    //     'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
    //     'clientOptions' => [
    //         'bSort' => false, 
    //         'sLengthSelect' => 'form-control',
    //         'lengthMenu' => [[50, 100, 200, -1], [50, 100, 200, "All"]],
    //     ],
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],
    //         //'nombor_abiliti',
    //         [
    //             'label' => 'Nombor Abiliti',
    //             'value' => function($model) {
    //                 $bidang_duti = BidangDuti::findOne($model->id_bidang_duti);
    //                 return $bidang_duti->nombor_duti.'-'.$model->nombor_abiliti;
    //             }
    //         ],
    //         'importance',
    //         'nama_abiliti',
    //         //columns
    //         [
    //             'header' => 'Skor Penilaian'.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
    //             'format' => 'raw',
    //             'contentOptions' => ['style' => 'width:200px;'], 
    //             'value' => function ($model, $key, $index, $grid) {
    //                 $score = [1, 2, 3, 4, 5];
    //                 $id_penilaian_profil = Yii::$app->request->get('id');
    //                 $penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
    //                 if(count($penilaian_markah) > 0)
    //                     $markah = $penilaian_markah->attributes['markah'];
    //                 else
    //                     $markah = '';
    //                 //return print_r($penilaian_markah);
    //                 return Html::radioList($model->id_bidang_abiliti, $markah, $score, ['class' => 'score-radio']);
    //             }
    //         ],

    //         //['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]);
?>

<div class="form-group">
    <?= Html::button('Simpan Penilaian' , ['class' => 'btn btn-success', 'onclick' => 'if(confirm("Simpan Penilaian?")) {/*alert( $("#supervise").serialize());*/$.post("'.Url::to(['penilaian-profil/save-supervise']).'", $("#supervise").serialize(), function(data){if(data != true)alert(data);})}']) ?>
    <?= Html::submitButton('Hantar Penilaian' , ['class' => 'btn btn-primary', 'id' => 'hantar-penilaian']) ?>
</div>

<?php echo Html::endForm(); ?>
</div>

<?php $script = <<< JS

$('#hantar-penilaian').click(function(){
    if(confirm('Hantar Penilaian ini?') && checkScore())
        return true;
    
    return false;
});

function checkScore() {
    var radioLength = $('.score-radio').length;
    for(var i = 0; i < radioLength; i++) {
        name = $('.score-radio:eq(' + i +') input:eq(0)').attr('name');
        if(!$('input:radio[name=s' + name + ']').is(':checked')) {
            alert('Sila lengkapkan semua markah abiliti');
            return false;
        }
    }
    return true;
}

//$('.score-radio input[value=1]').prop('checked', true);

$('.score-radio input').prop('disabled', true);

scoreLength = $('.score-radio').length;
for(var i = 0; i < scoreLength; i++)
{
    name = $('.score-radio:eq(' + i +') input:eq(0)').attr('name');
    if(!$('input:radio[name=' + name + ']').is(':checked')) {
        $('.score-radio:eq(' + i +') input:eq(0)').prop('checked', true);
    }
}


$(".dataTables_length select").addClass('form-control');
$(".dataTables_filter input").addClass('form-control');


JS;
$this->registerJs($script);

?>