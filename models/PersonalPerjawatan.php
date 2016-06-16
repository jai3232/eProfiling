<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_perjawatan".
 *
 * @property integer $id_personal_perjawatan
 * @property integer $id_personal
 * @property integer $kategori_perjawatan
 * @property integer $id_ref_taraf_perjawatan
 * @property string $nama_perjawatan
 * @property integer $id_ref_skim_perjawatan
 * @property integer $id_ref_gred_perjawatan
 * @property integer $id_agensi_institut
 * @property string $nama_institut_lain
 * @property string $nama_bidang_lain
 * @property string $no_telefon_pejabat
 * @property integer $id_ref_purata_jam_mengajar
 * @property string $tarikh_mula_perjawatan
 * @property string $tarikh_tamat_perjawatan
 * @property integer $is_aktif
 *
 * @property PersonalBidang[] $personalBidangs
 * @property Personal $idPersonal
 */
class PersonalPerjawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_perjawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal', 'kategori_perjawatan', 'id_ref_taraf_perjawatan', 'id_ref_skim_perjawatan', 'id_ref_gred_perjawatan', 'id_agensi_institut', 'id_ref_purata_jam_mengajar', 'is_aktif'], 'integer'],
            [['tarikh_mula_perjawatan', 'tarikh_tamat_perjawatan'], 'safe'],
            [['nama_perjawatan', 'nama_bidang_lain'], 'string', 'max' => 100],
            [['nama_institut_lain'], 'string', 'max' => 50],
            [['no_telefon_pejabat'], 'string', 'max' => 12],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id_personal']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_personal_perjawatan' => 'Id Personal Perjawatan',
            'id_personal' => 'Id Personal',
            'kategori_perjawatan' => 'Kategori Perjawatan',
            'id_ref_taraf_perjawatan' => 'Id Ref Taraf Perjawatan',
            'nama_perjawatan' => 'Nama Perjawatan',
            'id_ref_skim_perjawatan' => 'Id Ref Skim Perjawatan',
            'id_ref_gred_perjawatan' => 'Id Ref Gred Perjawatan',
            'id_agensi_institut' => 'Id Agensi Institut',
            'nama_institut_lain' => 'Nama Institut Lain',
            'nama_bidang_lain' => 'Nama Bidang Lain',
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'id_ref_purata_jam_mengajar' => 'Id Ref Purata Jam Mengajar',
            'tarikh_mula_perjawatan' => 'Tarikh Mula Perjawatan',
            'tarikh_tamat_perjawatan' => 'Tarikh Tamat Perjawatan',
            'is_aktif' => 'Is Aktif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalBidangs()
    {
        return $this->hasMany(PersonalBidang::className(), ['id_personal_perjawatan' => 'id_personal_perjawatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonal()
    {
        return $this->hasOne(Personal::className(), ['id_personal' => 'id_personal']);
    }

    public function getIdTarafPerjawatan()
    {
        return $this->hasOne(RefTarafPerjawatan::className(), ['id_ref_taraf_perjawatan' => 'id_ref_taraf_perjawatan']);
    }

    public function getIdSkimPerjawatan()
    {
        return $this->hasOne(RefSkimPerjawatan::className(), ['id_ref_skim_perjawatan' => 'id_ref_skim_perjawatan']);
    }

    public function getIdGredPerjawatan()
    {
        return $this->hasOne(RefGredPerjawatan::className(), ['id_ref_gred_perjawatan' => 'id_ref_gred_perjawatan']);
    }

    public function getIdAgensiInstitut()
    {
        return $this->hasOne(AgensiInstitut::className(), ['id_agensi_institut' => 'id_agensi_institut']);
    }

    public function getIdPurataJamMengajar()
    {
        return $this->hasOne(RefPurataJamMengajar::className(), ['id_ref_purata_jam_mengajar' => 'id_ref_purata_jam_mengajar']);
    }

}
