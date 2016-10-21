<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BidangInstitutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Bidang';
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Institut', 'url' => ['agensi-institut/index','idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="bidang-institut-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo '<h2>Intitut : '.$agensiInstitut->nama_institut.' (ID :'.$agensiInstitut->id_agensi_institut.')</h2>'; ?>
    <?php //if(Yii::$app->user->identity->accessLevel([0, 1, 6])) { ?>
    <p>
        <?= Html::a('Tambah Bidang Institut', ['create','idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
    </p>
    <?php //} ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['header'=>'Bil','class' => 'yii\grid\SerialColumn'],

          //  'id_bidang_institut',
          //  'id_agensi_institut',
           //'id_bidang',
            ['attribute'=>'id_bidang','value'=>'idBidang.nama_bidang'],

            [
              'header'=>'Fungsi','class' => 'yii\grid\ActionColumn',
              //'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false,
              'template' => '{view} {update} {delete}',
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
              ],
              //*/
          ],
        ],
    ]); ?>
</div>
