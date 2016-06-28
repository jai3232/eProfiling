<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BidangAbiliti */

$this->title = 'Tambah Abiliti';
$this->params['breadcrumbs'][] = ['label' => 'Abiliti', 'url' => ['index', 'idbi' => Yii::$app->request->get('idbi'), 'idbt' => Yii::$app->request->get('idbt'), 'idbd' => Yii::$app->request->get('idbd')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bidang-abiliti-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
