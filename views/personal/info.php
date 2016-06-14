<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Personal */

//$this->title = $personal->id_personal;
$this->params['breadcrumbs'][] = ['label' => 'Personal', 'url' => ['info']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

<?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Personal',
                'content' => $this->render('_personal', ['model' => $personal]),
                'active' => true
            ],
            [
                'label' => 'Perjawatan',
                'content' => $this->render('_perjawatan', ['perjawatanDataProvider' => $perjawatanDataProvider, 'id_personal' => $personal->id_personal]),
            ],
            [
                'label' => 'Kelulusan',
                'content' => 'Anim pariatur cliche...',
            ],            

            
        ],
    ]);
?>

</div>