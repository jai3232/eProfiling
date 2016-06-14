<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang".
 *
 * @property integer $id_bidang
 * @property string $kod_noss
 * @property string $nama_bidang
 * @property integer $status_bidang
 * @property integer $id_jenis_kompetensi
 *
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
            [['kod_noss', 'nama_bidang', 'id_jenis_kompetensi'], 'required'],
            [['status_bidang', 'id_jenis_kompetensi'], 'integer'],
            [['kod_noss', 'nama_bidang'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang' => 'Id Bidang',
            'kod_noss' => 'Kod Noss',
            'nama_bidang' => 'Nama Bidang',
            'status_bidang' => 'Status Bidang',
            'id_jenis_kompetensi' => 'Id Jenis Kompetensi',
        ];
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

    //'idJenisKompetensi.nama_kompetensi',

    public function getIdJenisKompetensi()
    {
        return $this->hasOne(RefJenisKompetensi::className(), ['id_jenis_kompetensi' => 'id_jenis_kompetensi']);
    }
}
