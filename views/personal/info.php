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
    $tabActive = Yii::$app->request->get('tab');
    if(!isset($tabActive))
        $tabActive = 0;
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Personal',
                'content' => $this->render('_personal', ['model' => $personal]),
                'active' => $tabActive == 0 ? true:false,
            ],
            [
                'label' => 'Perjawatan',
                'content' => $this->render('_perjawatan', ['perjawatanDataProvider' => $perjawatanDataProvider, 'id_personal' => $personal->id_personal]),
            ],
            [
                'label' => 'Kelulusan',
                'content' => $this->render('_kelulusan', ['kelulusanDataProvider' => $kelulusanDataProvider, 'id_personal' => $personal->id_personal]),
            ],            
            [
                'label' => 'Bidang',
                'content' => $this->render('_bidang', ['bidangDataProvider' => $bidangDataProvider, 'id_personal' => $personal->id_personal]),
            ],
            [
                'label' => 'Perakuan',
                'content' => $this->render('_perakuan', ['model' => $personal]),
                'active' => $tabActive == 4 ? true:false,
            ],
            [
                'label' => 'Tukar Katalaluan',
                'content' => $this->render('_katalaluan', ['model' => $personal, 'msg' => $msg]),
                'active' => $tabActive == 5 ? true:false,
            ],
            
        ],
    ]);
?>

</div>