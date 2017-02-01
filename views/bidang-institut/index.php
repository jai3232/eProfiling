<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\PersonalPerjawatan;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangInstitutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Bidang';
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Institut', 'url' => ['agensi-institut/index','idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;

$id_personal = Yii::$app->user->identity->id_personal;
$id_agensi = PersonalPerjawatan::findOne(['id_personal' => $id_personal, 'is_aktif' => 1])->attributes['id_agensi'];
?>

<div class="bidang-institut-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo '<h2>Institut: '.$agensiInstitut->nama_institut.' (ID: '.$agensiInstitut->id_agensi_institut.')</h2>'; ?>

    <p>
        <?php
          if(($agensiInstitut->id_agensi == $id_agensi && Yii::$app->user->identity->tahap_akses == 2) || Yii::$app->user->identity->tahap_akses < 2) {
        ?>
            <?= Html::a('Tambah Bidang Institut', ['create','idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
        <?php
          }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'columns' => [
            ['header'=>'Bil','class' => 'yii\grid\SerialColumn'],

          //  'id_bidang_institut',
          //  'id_agensi_institut',
           //'id_bidang',
          ['attribute'=>'id_bidang','value'=>'idBidang.nama_bidang'],

            ['header'=>'Fungsi','class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {abilitymap} {abilitymapbt}',
            'buttons' => [
                'view'=>function($url,$model){
                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')]);
                },
                'update'=>function($url,$model){
                  return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')]);
                },
                'delete'=>function($url,$model){
                  return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')]);
                },
                'abilitymap'=>function($url,$model){
                return Html::a('<span class="glyphicon glyphicon-tag"></span>', ['abiliti-map-institut', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], ['title' => 'Ability Map Institut - PENILAIAN TERKINI']);
                },
                'abilitymapbt'=>function($url,$model){
                return Html::a('<span class="glyphicon glyphicon-tags"></span>', ['abiliti-map-institut-bulan-tahun', 'id' => $model->id_bidang_institut,'idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], ['title' => 'Ability Map Institut - PILIHAN TARIKH']);
                },
              ],
              //*/
          ],
        ],
    ]); ?>
</div>
