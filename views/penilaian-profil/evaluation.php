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
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;

$this->title = 'Penilaian Markah';
$this->params['breadcrumbs'][] = ['label' => 'Profail Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$score = [1, 2, 3, 4, 5];
?>
<div class="penilaian-markah">
    <h1><?= Html::encode($this->title) ?></h1>
<?php echo Html::beginForm(['evaluation']); ?>
<?= Html::hiddenInput('id_penilaian_profil', Yii::$app->request->get('id'), []) ?>

<?php //Pjax::begin(['id' => 'penilaianGrid']); ?>
<?php /* GridView::widget([
        'id' => 'penilaian-tablel',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombor_abiliti',
            'importance',
            'nama_abiliti',
            //'id_bidang_abiliti',
            [
            	'header' => 'Evaluation Score'.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
            	'format' => 'raw',
            	'value' => function ($model, $key, $index, $grid) {
            		$score = [1, 2, 3, 4, 5];
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
    ]);*/
?>
<?php //Pjax::end(); ?>

<?= DataTables::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'showOnEmpty' => false,
    'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
    'clientOptions' => [
        'bSort' => false, 
        'sLengthSelect' => 'form-control',
        'lengthMenu' => [[50, 100, 200, -1], [50, 100, 200, "All"]],
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'nombor_abiliti',
        'importance',
        'nama_abiliti',
        //columns
        [
            'header' => 'Skor Penilaian'.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
            'format' => 'raw',
            'value' => function ($model, $key, $index, $grid) {
                $score = [1, 2, 3, 4, 5];
                $id_penilaian_profil = Yii::$app->request->get('id');
                $penilaian_markah = PenilaianMarkah::findOne(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
                if(count($penilaian_markah) > 0)
                    $markah = $penilaian_markah->attributes['markah'];
                else
                    $markah = '';
                //return print_r($penilaian_markah);
                return Html::radioList($model->id_bidang_abiliti, $markah, $score, ['class' => 'score-radio']);
            }
        ],

        //['class' => 'yii\grid\ActionColumn'],
    ],
]);?>

<div class="form-group">
        <?= Html::submitButton('Hantar Penilaian' , ['class' => 'btn btn-primary', 'data-confirm' => 'Hantar Penilaian?']) ?>
    </div>

<?php echo Html::endForm(); ?>
</div>

<?php $script = <<< JS

$(".dataTables_length select").addClass('form-control');
$(".dataTables_filter input").addClass('form-control');

JS;
$this->registerJs($script);

?>