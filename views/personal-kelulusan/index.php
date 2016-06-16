<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalKelulusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Kelulusans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-kelulusan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Personal Kelulusan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_personal_kelulusan',
            'id_personal',
            'id_ref_tahap_kelulusan',
            'institusi_kelulusan',
            'pengkhususan_kelulusan',
            // 'tahun_dapat_sijil',
            // 'tahun_lupus_sijil',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
