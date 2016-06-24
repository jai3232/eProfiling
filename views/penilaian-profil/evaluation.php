<?php

use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use app\models\PenilaianProfil;
use app\models\PenilaianMarkah;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

$bidang_tiers = BidangTier::findAll(['id_bidang' => $id_bidang]);


if(count($bidang_tiers) > 0) {
	$i = 0;
	foreach ($bidang_tiers as $bidang_tier) {
		$id_bidang_tier_array[$i] = $bidang_tier->attributes['id_bidang_tier'];
		$i++;
	}

	$bidang_dutis = BidangDuti::find()->where(['id_bidang_tier' => $id_bidang_tier_array])->all();

	if(count($bidang_dutis) > 0) {
		$i = 0;
		foreach ($bidang_dutis as $bidang_duti) {
			$id_bidang_duti_array[$i] = $bidang_duti->attributes['id_bidang_duti'];
			$i++;
		}


		$bidang_abilitis = BidangAbiliti::find();//->where(['id_bidang_abiliti' => $id_bidang_duti_array]);
	}
}

//print_r($bidang_abilitis);
if(!isset($bidang_abilitis))
	$bidang_abilitis = BidangAbiliti::find()->where(['id_bidang_abiliti' => -1]);



$dataProvider = new ActiveDataProvider([
								'query' => $bidang_abilitis,
								'pagination' => [
									'pageSize' => 20,
								]

								]);

$score = [1, 2, 3, 4, 5];
?>

<?php echo Html::beginForm(['evaluation']); ?>
<?= Html::hiddenInput('id_penilaian_profil', Yii::$app->request->get('id'), []) ?>
<?=  GridView::widget([
        'dataProvider' =>$dataProvider,
        //'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombor_abiliti',
            'importance',
            'nama_abiliti',
            [
            	'header' => 'Evaluation Score'.Html::radioList('header-radio', '', $score, ['class' => 'select-score']),
            	'format' => 'raw',
            	'value' => function ($model, $key, $index, $grid) {
            		$score = [1, 2, 3, 4, 5];
            		$id_penilaian_profil = Yii::$app->request->get('id');
            		$penilaian_markah = PenilaianMarkah::find(['id_penilaian_profil' => $id_penilaian_profil, 'id_bidang_abiliti' => $model->id_bidang_abiliti]);
            		if(count($penilaian_markah) > 0)
            			$penilaian_markah = '';
            		else
            			$penilaian_markah = '';

            		return Html::radioList($model->nombor_abiliti, $penilaian_markah, $score, ['class' => 'score-radio']);
            	}
            ]
        ],
    ]);
?>
<div class="form-group">
        <?= Html::submitButton('Hantar Penilaian' , ['class' => 'btn btn-primary', 'data-confirm' => 'Hantar Penilaian?']) ?>
    </div>

<?php echo Html::endForm(); ?>