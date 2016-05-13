<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BidangDuti */

$this->title = 'Tambah Bidang Duti';
$this->params['breadcrumbs'][] = ['label' => 'Bidang Duti', 'url' => ['index', 'idbi' => Yii::$app->request->get('idbi'), 'idbt' => Yii::$app->request->get('idbt')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-duti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
