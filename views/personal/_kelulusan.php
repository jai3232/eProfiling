<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalKelulusanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Kelulusan Personal';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-kelulusan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Tambah Kelulusan', ['create'], ['class' => 'btn btn-success', 'id' => 'tambah-kelulusan']) ?>
        <?= Html::button('Tambah Kelulusan', ['value' => Url::to(['personal-kelulusan/create', 'id' => $id_personal]), 'class' => 'btn btn-success', 'id' => 'tambah-kelulusan']) ?>
    </p>

    <?php

    Modal::begin([
        'header' => '<h3 id="modal-header2">Tambah Kelulusan</h3>',
        'id' => 'modal2',
        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
    ]);

        echo '<div id="modalContent2"></div>';

    Modal::end();

    ?>
    <?php Pjax::begin(['id' => 'kelulusanGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $kelulusanDataProvider,
        //'filterModel' => $searchModel,
        'showOnEmpty' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_personal_kelulusan',
            //'id_personal',
            //'id_ref_tahap_kelulusan',
            [
                'label' => 'Tahap Kelulusan',
                'attribute' => 'id_ref_tahap_kelulusan',
                'value' => 'idTahapKelulusan.tahap_kelulusan',
            ],
            'institusi_kelulusan',
            'pengkhususan_kelulusan',
            'tahun_dapat_sijil',
            'tahun_lupus_sijil',

            [
             'class' => 'yii\grid\ActionColumn',
             'controller' => 'personal-kelulusan'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
