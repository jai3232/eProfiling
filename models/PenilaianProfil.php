<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penilaian_profil".
 *
 * @property integer $id_penilaian_profil
 * @property integer $id_bidang_abiliti
 * @property integer $id_personal
 * @property integer $id_agensi_institut
 * @property string $tarikh_penilaian
 *
 * @property PenilaianMarkah[] $penilaianMarkahs
 * @property Personal $idPersonal
 */
class PenilaianProfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penilaian_profil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penilaian_profil', 'id_bidang_abiliti', 'id_personal', 'id_agensi_institut', 'tarikh_penilaian'], 'required'],
            [['id_penilaian_profil', 'id_bidang_abiliti', 'id_personal', 'id_agensi_institut'], 'integer'],
            [['tarikh_penilaian'], 'safe'],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id_personal']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_penilaian_profil' => 'Id Penilaian Profil',
            'id_bidang_abiliti' => 'Id Bidang Abiliti',
            'id_personal' => 'Id Personal',
            'id_agensi_institut' => 'Id Agensi Institut',
            'tarikh_penilaian' => 'Tarikh Penilaian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaianMarkahs()
    {
        return $this->hasMany(PenilaianMarkah::className(), ['id_penilaian_profil' => 'id_penilaian_profil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonal()
    {
        return $this->hasOne(Personal::className(), ['id_personal' => 'id_personal']);
    }
}
