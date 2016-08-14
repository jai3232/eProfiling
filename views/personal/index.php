<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\RefAdmTahapAkses;
use app\models\RefStatusData;
use app\models\Personal;
use app\models\PersonalPerjawatan;
use yii\bootstrap\Modal;
use yii\jui\DatePicker;
//use yii2mod\editable\EditableColumn;
use yii\jui\AutoComplete;

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
                'attribute' => 'id_personal',
                'value' => 'id_personal',
                'filter'=> false,
            ],
            'nama',
            'no_kp',
            /*[
                'class' => EditableColumn::className(),
                'attribute' => 'id_personal_penyelia',
                'type' => 'text',
                'url' => ['change-id-personal'],
                'value' => function($model) {
                    return $model->id_personal_penyelia;
                },
                'editableOptions' => function ($model) {
                    return [
                        'source' => [1 => 'Active', 2 => 'Deleted'],
                        'value' => $model->id_personal,
                    ];
                },
            ],*/
           /* [
                //'class' => 'hiqdev\xeditable\grid\XEditableColumn',
                'attribute' => 'id_personal_penyelia',
                'format' => 'raw',
                'value' => function($model) {
                    return Editable::widget([
                                    'name'=>'person_name', 
                                    'asPopover' => true,
                                    'value' => $model->id_personal_penyelia,
                                    'header' => 'Name',
                                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                                    'data' => [0 => 'pass', 1 => 'fail', 2 => 'waived', 3 => 'todo'],
                                    'size'=>'md',
                                    'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...'],
                                    'pluginOptions'=>[
                                                        'url' => Url::to(['/site/prod'])
                                                     ]
                                ]);
                    ///return $model->id_personal_penyelia;
                },
            ],*/
            [
                'label' => 'ID Penyelia',
                'format' => 'raw',
                'value' => function($model) {

                    $id_personal = Yii::$app->user->identity->id_personal;
                    if(count(PersonalPerjawatan::findAll(['id_personal' => $id_personal])) > 0) {
                        $id_institut = PersonalPerjawatan::find()->select('id_agensi_institut')->where(['is_aktif' => 1, 'id_personal' => $id_personal])->one()->attributes['id_agensi_institut'];
                        $where_institut = ['personal_perjawatan.id_agensi_institut' => $id_institut];
                    }
                    else
                        $where_institut = '';

                    $data = Personal::find()
                            ->select(['personal.id_personal', 'personal.id_personal AS value', 'CONCAT(personal.nama, \' (No. KP: \', personal.no_kp, \', ID:\', personal.id_personal,\')\') AS label', 'personal.id_personal AS id'])
                            ->joinWith('personalPerjawatans')
                            ->where($where_institut)
                            ->orderBy('nama')
                            ->asArray()
                            ->all();

                    return AutoComplete::widget([
                                //'model' => $model,
                                'attribute' => 'id_personal_penyelia',
                                'value' => $model->id_personal_penyelia,
                                'clientOptions' => [
                                    'source' => $data,//['1' => 'USA', '2' => 'RUS'],
                                    //'source' => json_encode($negeri, JSON_PRETTY_PRINT),
                                    'autoFill' => true,
                                ],
                                'options' => [
                                                'class' => 'form-control', 'onclick' => 'this.select();', 
                                                'onchange' => '$.get("'.URL::to(['personal/update-supervisor', 'id' => $model->id_personal]).'&value="+$(this).val(), function(data){if($.trim(data) != 1)alert(data);});',
                                                //'onblur' => '$.get("'.URL::to(['personal/update-supervisor', 'id' => $model->id_personal]).'&value="+$(this).val(), function(data){if($.trim(data) != 1)alert(data);});',
                                             ],
                            ]);
                    
                },
            ],
            // [
            //     'class' => EditableColumn::className(),
            //     'value' => function($model) {
            //         return 'x';
            //     }
            // ],
            'emel',
            // [
            //     'class' => EditableColumn::className(),
            //     'attribute' => 'id_personal_penyelia',
            //     'url' => ['change-username'],
            // ],
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
                    if(Yii::$app->user->identity->accessLevel([0]))
                        $accessLevel = ['AS', 'AU', 'AA', 'AI', 'HD', 'EX', 'DE', 'PE' ];
                    elseif(Yii::$app->user->identity->accessLevel([1]))
                        $accessLevel = [2 => 'AA', 3 => 'AI', 4 => 'HD', 5 => 'EX', 6 => 'DE', 7 => 'PE' ];
                    elseif(Yii::$app->user->identity->accessLevel([2]))
                        $accessLevel = [3 => 'AI', 4 => 'HD', 5 => 'EX', 6 => 'DE', 7 => 'PE' ];
                    elseif(Yii::$app->user->identity->accessLevel([3]))
                        $accessLevel = [4 => 'HD', 5 => 'EX', 6 => 'DE', 7 => 'PE' ];
                    else
                        $accessLevel = [];
                    
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
            ['header' => 'Tindakan', 'class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php $script = <<< JS

$('.editable-input input').on('shown', function(){
    setTimeout(function() { alert('x'); }, 50);
});

$(document).ready(function () {
    $('html').on('click', '.editable-input input', function () {
        $(this).select();
    });
});

$('.ui-autocomplete-input').on("blur focus", function(e){ 
     $(this).change();
});

JS;
$this->registerJs($script);

?>
