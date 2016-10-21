<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgensiInstitutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Institut';
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="agensi-institut-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->user->identity->accessLevel([0, 1, 6])) { ?>
    <p>
        <?= Html::a('Tambah Agensi Institut', ['create', 'idag' => Yii::$app->request->get('idag')], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'emptyCell' => '-',
        'emptyText' => '-',
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_agensi_institut',
            'idAgensi.kod_agensi',
            'kod_institut',
            'nama_institut',
            'alamat',
            //'alamat2',
            // 'alamat3',
            'bandar',
            'poskod',
            'negeri',
            'no_tel',
            'no_faks',
            'email:email',
            'portal',

            ['class' => 'yii\grid\ActionColumn', 'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false],
            [
                'label' => 'Bidang Institut',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang-institut/index', 'idai' => $data->id_agensi_institut, 'idag' => Yii::$app->request->get('idag')], ['title' => 'List']);
                }
            ],
        ],
    ]); ?>
</div>
