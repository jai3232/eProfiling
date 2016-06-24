<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenilaianProfil */

$this->title = 'Create Penilaian Profil';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Profils', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
