<?php

namespace app\controllers;

use app\models\Personal;
use app\models\PersonalBidang;
use app\models\Bidang;
use app\models\BidangTier;
use app\models\BidangDuti;
use app\models\BidangAbiliti;
use Yii;

class EvaluationController extends \yii\web\Controller
{
    public function actionIndex()
    {
			if(Yii::$app->user->isGuest)    	
				$this->redirect(['site/login']);
  		$bidang = new Bidang();
  		$personal = Personal::findOne(Yii::$app->user->identity->id_personal);
  		//$personal = Personal::find()->where(['no_kp' => Yii::$app->user->identity->no_kp])->one();
  		$personalBidang = new PersonalBidang();
  		//print_r($personal->getPersonalBidangs());
  		//exit;
      return $this->render('index', 
      										[
      											'no_kp' => !Yii::$app->user->isGuest ? Yii::$app->user->identity->no_kp : '-',
      											'bidang' => $bidang,
      											'personalBidang' => $personal->getPersonalBidangs()
      										]
      						);
    }

}
