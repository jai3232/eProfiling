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


$this->title = 'Penilaian Markah';
$this->params['breadcrumbs'][] = ['label' => 'Profail Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$score = [1, 2, 3, 4, 5];

$total_score = 0; 
$supervisor_total_score = 0;

if (!empty($dataProvider->getModels())) {
    foreach ($dataProvider->getModels() as $key => $val) {
        $total_score += $val->markah;
        $supervisor_total_score += $val->markah_supervisor;
    }
}

?>
<div class="penilaian-markah">
    <h1><?= Html::encode($this->title) ?></h1>

<?php  echo GridView::widget([
        'id' => 'penilaian-tablel',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showFooter'=> true,
        //'footerRowOptions'=>['style'=>'font-weight:bold;text-decoration: underline;'],
        'showOnEmpty' => false,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'nombor_abiliti',
            [
                'label' => 'Nombor Abiliti',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    //$bidang_duti = BidangDuti::findOne($model->id_bidang_duti);
                    $abiliti = BidangAbiliti::findOne($model->id_bidang_abiliti);
                    $duti = BidangDuti::findOne($abiliti->id_bidang_duti);
                    return $duti->nombor_duti.'-'.$abiliti->nombor_abiliti;
                }
            ],
            [
                'label' => 'Importance',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    $abiliti = BidangAbiliti::findOne($model->id_bidang_abiliti);
                    return $abiliti->importance;
                }
            ],
            [
                'label' => 'Nama Abiliti',
                'value' => function($model) {
                    $abiliti = BidangAbiliti::findOne($model->id_bidang_abiliti);
                    return $abiliti->nama_abiliti;
                },
                'footer' => '<strong>Jumlah</strong>'
            ],
            //'importance',
            //'nama_abiliti',
            //'id_bidang_abiliti',
            //'markah', 
            [
                'label' => 'Markah',
                'attribute' => 'markah',
                'value' => function($model) {
                    return $model->markah;
                },
                'footer' => '<strong>'.$total_score.'</strong>',
            ],
            [
                'attribute' => 'markah_supervisor',
                'footer' => '<strong>'.$supervisor_total_score.'</strong>',
            ],
            'nota_supervisor',          
        ],
    ]);
?>
</div>