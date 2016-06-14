<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonalPerjawatan */

// $this->title = 'Create Personal Perjawatan';
// $this->params['breadcrumbs'][] = ['label' => 'Personal Perjawatans', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-perjawatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
