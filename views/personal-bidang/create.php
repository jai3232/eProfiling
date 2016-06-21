<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonalBidang */

// $this->title = 'Create Personal Bidang';
// $this->params['breadcrumbs'][] = ['label' => 'Personal Bidangs', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-bidang-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
