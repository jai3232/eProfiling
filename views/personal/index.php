<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_personal',
            'nama',
            'no_kp',
            'id_personal_penyelia',
            'emel',
            // 'jantina',
            // 'status_oku',
            // 'jenis_oku',
            // 'status_warganegara',
            // 'nama_warganegara',
            // 'bangsa',
            // 'bangsa_lain',
            // 'status_perkahwinan',
            // 'alamat1',
            // 'alamat2',
            // 'bandar',
            // 'poskod',
            // 'negeri',
            // 'no_telefon_peribadi',
            // 'gambar_personal',
            // 'katalaluan',
            // 'status',
            // 'tahap_akses',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
