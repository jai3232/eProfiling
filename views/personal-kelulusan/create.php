<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonalKelulusan */

// $this->title = 'Create Personal Kelulusan';
// $this->params['breadcrumbs'][] = ['label' => 'Personal Kelulusans', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-kelulusan-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
