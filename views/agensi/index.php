<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AgensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Agensi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agensi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->user->identity->accessLevel([0, 1, 6])) { ?>
    <p>
        <?= Html::a('Tambah Agensi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_agensi',
            'kod_agensi',
            'nama_agensi',

            ['class' => 'yii\grid\ActionColumn', 'visible' => Yii::$app->user->identity->accessLevel([0, 1])? true:false],
            [
                'label' => 'Institut',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($data){
                    return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['agensi-institut/list', 'idag' => $data->id_agensi], ['title' => 'List']);
                }
            ],
            // [
            //     'label' => 'Bidang',
            //     'format' => 'raw',
            //     'contentOptions' => ['class' => 'text-center'],
            //     'value' => function($data){
            //         return HTML::a('<span class="glyphicon glyphicon-list"></span>', ['bidang/index', 'idag' => $data->id_agensi], ['title' => 'List']);
            //     }
            // ]
        ],
    ]); ?>
</div>
