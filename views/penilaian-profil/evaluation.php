<?php

use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\PenilaianProfil;
use app\models\PenilaianMarkah;
use app\models\PersonalBidang;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;


$this->title = 'Penilaian Markah';
$this->params['breadcrumbs'][] = ['label' => 'Profail Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$score = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

?>
<div class="penilaian-markah">
    <h1><?= Html::encode($this->title) ?></h1>
<?php echo Html::beginForm(['evaluation'], 'post', ['id' => 'evaluation']); ?>
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
                'value' => function($model) {
                    $bidang_duti = BidangDuti::findOne($model->id_bidang_duti);
                    return $bidang_duti->nombor_duti.'-'.$model->nombor_abiliti;
                }
            ],
            'importance',
            'nama_abiliti',
            //'id_bidang_abiliti',
            [
            	'header' => 'Evaluation Score'.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
            	'format' => 'raw',
            	'value' => function ($model, $key, $index, $grid) {
            		$score = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];
            		$id_penilaian_profil = Yii::$app->request->get('id');
            		$penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
            		if(count($penilaian_markah) > 0)
            			$markah = $penilaian_markah->attributes['markah'];
            		else
            			$markah = '';
                    //return print_r($penilaian_markah);
            		return Html::radioList($model->id_bidang_abiliti, $markah, $score, ['class' => 'score-radio']);
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
    <?= Html::button('Simpan Penilaian' , ['class' => 'btn btn-success', 'onclick' => 'if(confirm("Simpan Penilaian?")) $.post("'.Url::to(['penilaian-profil/save-evaluation']).'", $("#evaluation").serialize(), function(data){if(data != true)alert(data);})']) ?>
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
        if(!$('input:radio[name=' + name + ']').is(':checked')) {
            alert('Sila lengkapkan semua markah abiliti');
            return false;
        }
    }
    return true;
}

$(".dataTables_length select").addClass('form-control');
$(".dataTables_filter input").addClass('form-control');

JS;
$this->registerJs($script);

?>