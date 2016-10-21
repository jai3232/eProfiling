<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_institut".
 *
 * @property integer $id_bidang_institut
 * @property integer $id_agensi_institut
 * @property integer $id_bidang
 *
 * @property AgensiInstitut $idAgensiInstitut
 * @property Bidang $idBidang
 */
class BidangInstitut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang_institut';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_agensi_institut', 'id_bidang'], 'required'],
            [['id_agensi_institut', 'id_bidang'], 'integer'],
            [['id_agensi_institut'], 'exist', 'skipOnError' => true, 'targetClass' => AgensiInstitut::className(), 'targetAttribute' => ['id_agensi_institut' => 'id_agensi_institut']],
            [['id_bidang'], 'exist', 'skipOnError' => true, 'targetClass' => Bidang::className(), 'targetAttribute' => ['id_bidang' => 'id_bidang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang_institut' => 'Id Bidang Institut',
            'id_agensi_institut' => 'Id Agensi Institut',
            'id_bidang' => 'Bidang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAgensiInstitut()
    {
        return $this->hasOne(AgensiInstitut::className(), ['id_agensi_institut' => 'id_agensi_institut']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBidang()
    {
        return $this->hasOne(Bidang::className(), ['id_bidang' => 'id_bidang']);
    }
}
