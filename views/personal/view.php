<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Personal;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

// $this->title = $model->id_personal;
// $this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['index', 'sort' => '-id_personal']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->id_personal], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a('Delete', ['delete', 'id' => $model->id_personal], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>
    <?php
    $negeri =   [
                '1' => 'Johor',
                '2' => 'Kedah',
                '3' => 'Kelantan',
                '4' => 'Melaka',
                '5' => 'Negeri Sembilan',
                '6' => 'Pahang',
                '7' => 'Pulau Pinang',
                '8' => 'Perak',
                '9' => 'Perlis',
                '10' => 'Selangor',
                '11' => 'Terengganu',
                '12' => 'Sabah',
                '13' => 'Sarawak',
                '14' => 'Kuala Lumpur',
                '15' => 'Labuan',
                '16' => 'Putrajaya'
            ];
    function getTahapAkses($str) {
        $arr = explode(",", $str);

        $ta = array("Admin Sistem", "Admin UPPK", "Admin Agensi", "Admin Institut", "Ex", "Hod", "Data Entri", "Pengajar");
        $list = '';
        foreach ($arr as $key => $value) {
            $value = $value/1;
            $list .= $ta[$value].', ';
        }
        return $list;
    }

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_personal',
            'nama',
            'no_kp',
            //'id_personal_penyelia',
            [
                'label' => 'Penyelia',
                'value' => $model->id_personal_penyelia > 0 ? Personal::findOne(['id_personal' => $model->id_personal_penyelia])->attributes['nama'].' ('.$model->id_personal_penyelia.')' : '',
            ],
            'emel',
            'jantina',
            'status_oku',
            'jenis_oku',
            'status_warganegara',
            'nama_warganegara',
            'bangsa',
            'bangsa_lain',
            'status_perkahwinan',
            'alamat1',
            'alamat2',
            'bandar',
            'poskod',
            //'negeri',
            [
                'label' => 'Negari',
                'value' => $model->negeri > 0? $negeri[$model->negeri]:'-',
            ],
            'no_telefon_peribadi',  
            //'gambar_personal',
            [                      // the owner name of the model
                'label' => 'Gambar',
                'format' => ['image', ['width' => 150]],
                'value' => 'uploads/'.$model->no_kp.'.jpg',
            ],
            //'katalaluan',
            'id_ref_status_data',
            //'tahap_akses',
            [
                'label' => 'Tahap Akses',
                'value' => getTahapAkses($model->tahap_akses),
            ]
        ],
    ]) ?>

</div>
