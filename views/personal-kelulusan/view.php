<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonalKelulusan */

$this->title = $model->id_personal_kelulusan;
$this->params['breadcrumbs'][] = ['label' => 'Personal Kelulusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-kelulusan-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->id_personal_kelulusan], ['class' => 'btn btn-primary']) ?>
        <?php //= Html::a('Delete', ['delete', 'id' => $model->id_personal_kelulusan], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => 'Are you sure you want to delete this item?',
            //     'method' => 'post',
            // ],
        // ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id_personal_kelulusan',
            //'id_personal',
            'id_ref_tahap_kelulusan',
            'institusi_kelulusan',
            'pengkhususan_kelulusan',
            'tahun_dapat_sijil',
            'tahun_lupus_sijil',
        ],
    ]) ?>

</div>
