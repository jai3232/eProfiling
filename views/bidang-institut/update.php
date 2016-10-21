<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BidangInstitut */

$this->title = 'Pinda Bidang Institut : '.$agensiInstitut->nama_institut;
//$this->params['breadcrumbs'][] = ['label' => 'Bidang', 'url' => ['index','idai' => Yii::$app->request->get('id')]];
//$this->params['breadcrumbs'][] = ['label' => $model->id_bidang_institut, 'url' => ['view', 'id' => $model->id_bidang_institut]];
$this->params['breadcrumbs'][] = ['label' => 'Agensi', 'url' => ['agensi/index']];
$this->params['breadcrumbs'][] = ['label' => 'Institut', 'url' => ['agensi-institut/index','idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = ['label' => 'Bidang', 'url' => ['index','idai' => Yii::$app->request->get('idai'),'idag' => Yii::$app->request->get('idag')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-institut-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
