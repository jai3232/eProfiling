<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\RefAdmTahapAkses;
use app\models\RefStatusData;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Personal';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--[if lt IE 9]>
<script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="http://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<div class="personal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /*= Html::a('Create Personal', ['create'], ['class' => 'btn btn-success'])*/ ?>
    </p>

    <?php

    Modal::begin([
        'header' => '<h3 id="modal-header">Personal</h3>',
        'id' => 'modal',
        'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>',
    ]);
        echo '<div style="overflow:scroll; max-height:500px;" id="modalContent"></div>';
    Modal::end();

    echo DatePicker::widget([
    'name'  => 'from_date',
    'value'  => 'x',
    'options' => ['class' => 'hidden'],
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
    ]);

    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterRowOptions' => ['class' => 'input-sm'],
        'tableOptions' => [
                            'class' => 'table table-striped table-bordered table-condensed table-hover table-mini',
                          ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_personal',
            [
                'label' => 'ID',
                //'attribute' => 'id_personal',
                'value' => 'id_personal',
            ],
            'nama',
            'no_kp',
            // [
            //     'label' => 'ID Penyelia',
            //     'attribute' => 'id_personal_penyelia',
            // ],
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
            //'status',
            [
                'label' => 'Status',
                'attribute' => 'id_ref_status_data',
                'filter' => ArrayHelper::map(RefStatusData::find()->all(), 'id_ref_status_data', 'status_data'),
            ],
            [
                'label' => 'Tindakan',
                'format' => 'raw',
                'contentOptions' => ['class' => 'text-center'],
                'value' => function($model) {
                    if($model->id_ref_status_data == 1)
                        return 'Baru';
                    if($model->id_ref_status_data == 2)
                        return 'Deraf';
                    if($model->id_ref_status_data == 3)
                        return Html::a('Sah',  Url::to(['personal/update-status', 'id' => $model->id_personal]), ['class' => 'btn btn-warning personal-sah']);
                    if($model->id_ref_status_data == 4)
                        return 'Selesai';
                }
            ],
            // [
            //     'label' => 'Tahap Akses',
            //     'attribute' => 'tahap_akses',
            //     //'value' => 'tahap_akses',
            //     'format' => 'raw',
            //     'value' => function($model) {

            //         return Html::dropDownList('tahap'.$model->id_personal, $model->tahap_akses, ArrayHelper::map(RefAdmTahapAkses::find()->all(), 'id_adm_tahap_akses', 'tahap_akses'), ['id' => $model->id_personal, 'class' => 'form-control input-sm tahap-akses', 'title' => Url::to(['personal/update-access', 'id' => $model->id_personal])]);
            //     },
            //     'filter' => ArrayHelper::map(RefAdmTahapAkses::find()->all(), 'id_adm_tahap_akses', 'tahap_akses'),
            // ],
            [
                'label' => 'Akses',
                'format' => 'raw',
                'value' => function($model) {
                    //return Html::checkBox('test', false, ['class' => 'xx', 'value' => 'yyy']);
                    //($name, $selection = null, $items = [], $options = [])
                    $accessLevel = ['AS', 'AU', 'AA', 'AI', 'HD', 'EX', 'DE', 'PE' ];
                    $checkedValue = explode(',', $model->tahap_akses);
                    return Html::checkBoxList('access_level', $checkedValue, $accessLevel, ['class' => 'access', 'id' => $model->id_personal, 'dir' => Url::to(['update-access', 'id' => $model->id_personal]),]);
                },
            ],
            //'aktif',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'header' => 'Aktif',
                'contentOptions' => ['class' => 'text-center'],
                // 'header' => Html::checkBox('selection_all', false, [
                //     'class' => 'select-on-check-all',
                //     'label' => 'Check All',
                // ]),
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return $model->aktif? ['checked' => true, 'class' => 'aktif-check', 'value' => Url::to(['personal/update-active', 'id' => $model->id_personal])]: ['checked' => false, 'class' => 'aktif-check', 'value' => Url::to(['personal/update-active', 'id' => $model->id_personal])];
                }

            ],
            [
                'class' => 'yii\grid\ActionColumn', 
                'header' => 'Maklumat Lanjut',
                'contentOptions' => ['class' => 'text-center'],
                'buttons' => [
                    'personal' => function($url, $model) {
                        return '<a href="'.Url::to(['view', 'id' => $model->id_personal])
                            .'" class="personal-info" id="'.$model->id_personal
                            .'" title="Maklumat Personal"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'jawatan' => function($url, $model) {
                        return '<a href="'.Url::to(['personal-perjawatan', 'id' => $model->id_personal])
                            .'" class="personal-perjawatan" id="'.$model->id_personal
                            .'" title="Jawatan"><span class="glyphicon glyphicon-briefcase"></span></a>';
                    },
                    'kelulusan' => function($url, $model) {
                        return '<a href="'.Url::to(['personal-kelulusan', 'id' => $model->id_personal])
                            .'" class="personal-kelulusan" id="'.$model->id_personal
                            .'" title="Kelulusan"><span class="glyphicon glyphicon-education"></span></a>';
                    },
                    'bidang' => function($url, $model) {
                        return '<a href="'.Url::to(['personal-bidang', 'id' => $model->id_personal])
                            .'" class="personal-bidang" id="'.$model->id_personal
                            .'" title="Bidang"><span class="glyphicon glyphicon-cog"></span></a>';
                    },
                ],
                'template' => '{personal}&nbsp;&nbsp;{jawatan}&nbsp;&nbsp;{kelulusan}&nbsp;&nbsp;{bidang}',
            ],
        ],
    ]); ?>
</div>
