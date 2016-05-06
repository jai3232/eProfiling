<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_tier".
 *
 * @property integer $id_bidang_tier
 * @property integer $id_bidang
 * @property string $subsektor
 * @property string $kod_tier
 * @property integer $status_bidang_tier
 * @property string $tarikh_pembangunan_tier
 *
 * @property BidangDuti[] $bidangDutis
 * @property Bidang $idBidang
 */
class BidangTier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang_tier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang', 'subsektor', 'kod_tier', 'tarikh_pembangunan_tier'], 'required'],
            [['id_bidang', 'status_bidang_tier'], 'integer'],
            [['subsektor'], 'string'],
            [['tarikh_pembangunan_tier'], 'safe'],
            [['kod_tier'], 'string', 'max' => 255],
            [['id_bidang'], 'exist', 'skipOnError' => true, 'targetClass' => Bidang::className(), 'targetAttribute' => ['id_bidang' => 'id_bidang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang_tier' => 'Id Bidang Tier',
            'id_bidang' => 'Id Bidang',
            'subsektor' => 'Subsektor',
            'kod_tier' => 'Kod Tier',
            'status_bidang_tier' => 'Status Bidang Tier',
            'tarikh_pembangunan_tier' => 'Tarikh Pembangunan Tier',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangDutis()
    {
        return $this->hasMany(BidangDuti::className(), ['id_bidang_tier' => 'id_bidang_tier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBidang()
    {
        return $this->hasOne(Bidang::className(), ['id_bidang' => 'id_bidang']);
    }
}
