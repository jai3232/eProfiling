<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_duti".
 *
 * @property integer $id_bidang_duti
 * @property integer $id_bidang_tier
 * @property integer $nombor_duti
 * @property string $nama_duti
 * @property integer $status_bidang_duti
 *
 * @property BidangAbiliti[] $bidangAbilitis
 * @property BidangTier $idBidangTier
 */
class BidangDuti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang_duti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_tier', 'nombor_duti', 'nama_duti'], 'required'],
            [['id_bidang_tier', 'nombor_duti', 'status_bidang_duti'], 'integer'],
            [['nama_duti'], 'string', 'max' => 255],
            [['id_bidang_tier'], 'exist', 'skipOnError' => true, 'targetClass' => BidangTier::className(), 'targetAttribute' => ['id_bidang_tier' => 'id_bidang_tier']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang_duti' => 'Id Bidang Duti',
            'id_bidang_tier' => 'Id Bidang Tier',
            'nombor_duti' => 'Nombor Duti',
            'nama_duti' => 'Nama Duti',
            'status_bidang_duti' => 'Status Bidang Duti',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangAbilitis()
    {
        return $this->hasMany(BidangAbiliti::className(), ['id_bidang_duti' => 'id_bidang_duti']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBidangTier()
    {
        return $this->hasOne(BidangTier::className(), ['id_bidang_tier' => 'id_bidang_tier']);
    }
}
