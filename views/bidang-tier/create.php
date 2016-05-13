<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BidangTier */

$this->title = 'Tambah Bidang Tier';
//$this->params['breadcrumbs'][] = ['label' => 'Bidang Tier', 'url' => ['index',  'idag' => Yii::$app->request->get('idag'), 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = ['label' => 'Bidang Tier', 'url' => ['index', 'idbi' => Yii::$app->request->get('idbi')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-tier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
