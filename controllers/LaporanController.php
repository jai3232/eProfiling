<?php

namespace app\controllers;

use app\models\BidangInstitut;



class LaporanController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPengajarHOD()
    {
    	$model = new BidangInstitut();
    	 return $this->render('pengajarHOD', ['model' => $model]);
    }

}
