<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\web\Session;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianProfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(isset($_GET['ability']))
    echo '<script>alert("Bidang Abiliti tiada dalam Bidang pilihan semasa");</script>';
?>

<div class="penilaian-profil-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Profil Penilaian Baru', ['create', 'op' => 'new'], ['class' => 'btn btn-success', 'data-confirm' => 'Ambil Penilaian Baru?']) ?>
    

    <?php
        echo Html::beginForm(['create', 'op' => 'new'], 'post');
        echo Html::submitButton('Profil Penilaian Baru', ['class' => 'submit btn btn-success', 'data-confirm' => 'Ambil Penilaian Baru?']);
        echo Html::endForm();
    ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-condensed'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_penilaian_profil',
            'id_personal_bidang',
            'idPersonalBidang.idBidang.nama_bidang',
            'tarikh_penilaian',
            [
                'label' => 'Status',
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    $draf = Html::a('Draf', 
                                    Url::to(['penilaian-profil/create', 'id' => $model->id_penilaian_profil]), 
                                    ['title' => 'Draf, Klik untuk siap']);
                    return $model->status_siap? 'Siap' : $draf;
                }
            ],

            [
                'format' => 'raw',
                'value' => function($model) {
                    if($model->status_siap) {
                        return '-';
                    }
                    else {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to([
                            'penilaian-profil/delete-profile', 
                            'id' => $model->id_penilaian_profil,
                        ]), ['title' => 'Padam Rekod', 'data-confirm' => 'Padam rekod ini?']);
                    }
                }
                // 'class' => 'yii\grid\ActionColumn', 
                // 'template' => '{delete}',
                // 'visible' => $this->statuSiap(),
            ],
        ],
    ]); ?>
</div>