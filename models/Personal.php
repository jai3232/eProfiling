<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal".
 *
 * @property integer $id_personal
 * @property string $nama
 * @property string $no_kp
 * @property integer $id_personal_penyelia
 * @property string $emel
 * @property string $jantina
 * @property integer $status_oku
 * @property string $jenis_oku
 * @property integer $status_warganegara
 * @property string $nama_warganegara
 * @property integer $bangsa
 * @property string $bangsa_lain
 * @property integer $status_perkahwinan
 * @property string $alamat1
 * @property string $alamat2
 * @property string $bandar
 * @property integer $poskod
 * @property integer $negeri
 * @property string $no_telefon_peribadi
 * @property string $gambar_personal
 * @property string $katalaluan
 * @property integer $status
 * @property string $tahap_akses
 *
 * @property PenilaianProfil[] $penilaianProfils
 * @property PersonalBidang[] $personalBidangs
 * @property PersonalKelulusan[] $personalKelulusans
 * @property PersonalPerjawatan[] $personalPerjawatans
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'no_kp', 'id_personal_penyelia', 'emel', 'jantina', 'jenis_oku', 'nama_warganegara', 'bangsa', 'alamat1', 'bandar', 'poskod', 'negeri', 'no_telefon_peribadi', 'katalaluan', 'tahap_akses'], 'required'],
            [['id_personal_penyelia', 'status_oku', 'status_warganegara', 'bangsa', 'status_perkahwinan', 'poskod', 'negeri', 'status'], 'integer'],
            [['nama', 'katalaluan'], 'string', 'max' => 255],
            [['no_kp', 'no_telefon_peribadi'], 'string', 'max' => 12],
            [['emel', 'jenis_oku'], 'string', 'max' => 100],
            [['jantina'], 'string', 'max' => 1],
            [['nama_warganegara'], 'string', 'max' => 30],
            [['bangsa_lain', 'tahap_akses'], 'string', 'max' => 10],
            [['alamat1', 'alamat2', 'bandar', 'gambar_personal'], 'string', 'max' => 50],
            [['emel'], 'unique'],
            [['no_kp'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_personal' => 'Id Personal',
            'nama' => 'Nama',
            'no_kp' => 'No Kp',
            'id_personal_penyelia' => 'Id Personal Penyelia',
            'emel' => 'Emel',
            'jantina' => 'Jantina',
            'status_oku' => 'Status Oku',
            'jenis_oku' => 'Jenis Oku',
            'status_warganegara' => 'Status Warganegara',
            'nama_warganegara' => 'Nama Warganegara',
            'bangsa' => 'Bangsa',
            'bangsa_lain' => 'Bangsa Lain',
            'status_perkahwinan' => 'Status Perkahwinan',
            'alamat1' => 'Alamat1',
            'alamat2' => 'Alamat2',
            'bandar' => 'Bandar',
            'poskod' => 'Poskod',
            'negeri' => 'Negeri',
            'no_telefon_peribadi' => 'No Telefon Peribadi',
            'gambar_personal' => 'Gambar Personal',
            'katalaluan' => 'Katalaluan',
            'status' => 'Status',
            'tahap_akses' => 'Tahap Akses',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaianProfils()
    {
        return $this->hasMany(PenilaianProfil::className(), ['id_personal' => 'id_personal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalBidangs()
    {
        return $this->hasMany(PersonalBidang::className(), ['id_personal' => 'id_personal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalKelulusans()
    {
        return $this->hasMany(PersonalKelulusan::className(), ['id_personal' => 'id_personal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalPerjawatans()
    {
        return $this->hasMany(PersonalPerjawatan::className(), ['id_personal' => 'id_personal']);
    }
}
