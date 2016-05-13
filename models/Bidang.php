<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang".
 *
 * @property integer $id_bidang
 * @property integer $id_agensi
 * @property string $kod_noss
 * @property string $nama_bidang
 * @property integer $status_bidang
 * @property integer $id_jenis_kompetensi
 *
 * @property Agensi $idAgensi
 * @property BidangTier[] $bidangTiers
 * @property PersonalBidang[] $personalBidangs
 */
class Bidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_agensi', 'kod_noss', 'nama_bidang', 'id_jenis_kompetensi'], 'required'],
            [['id_agensi', 'status_bidang', 'id_jenis_kompetensi'], 'integer'],
            [['kod_noss', 'nama_bidang'], 'string', 'max' => 255],
            [['id_agensi'], 'exist', 'skipOnError' => true, 'targetClass' => Agensi::className(), 'targetAttribute' => ['id_agensi' => 'id_agensi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang' => 'Id Bidang',
            'id_agensi' => 'Id Agensi',
            'kod_noss' => 'Kod Noss',
            'nama_bidang' => 'Nama Bidang',
            'status_bidang' => 'Status Bidang',
            'id_jenis_kompetensi' => 'Id Jenis Kompetensi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAgensi()
    {
        return $this->hasOne(Agensi::className(), ['id_agensi' => 'id_agensi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangTiers()
    {
        return $this->hasMany(BidangTier::className(), ['id_bidang' => 'id_bidang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalBidangs()
    {
        return $this->hasMany(PersonalBidang::className(), ['id_bidang' => 'id_bidang']);
    }

    public function getIdJenisKompetensi()
    {
        return $this->hasOne(RefJenisKompetensi::className(), ['id_jenis_kompetensi' => 'id_jenis_kompetensi']);
    }
}
