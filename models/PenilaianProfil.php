<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penilaian_profil".
 *
 * @property integer $id_penilaian_profil
 * @property integer $id_personal_bidang
 * @property string $tarikh_penilaian
 * @property integer $status_siap
 *
 * @property PenilaianMarkah[] $penilaianMarkahs
 * @property PersonalBidang $idPersonalBidang
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
            [['id_personal_bidang'], 'required'],
            [['id_personal_bidang', 'status_siap'], 'integer'],
            [['tarikh_penilaian'], 'safe'],
            [['id_personal_bidang'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalBidang::className(), 'targetAttribute' => ['id_personal_bidang' => 'id_personal_bidang']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_penilaian_profil' => 'Id Penilaian Profil',
            'id_personal_bidang' => 'Id Personal Bidang',
            'tarikh_penilaian' => 'Tarikh Penilaian',
            'status_siap' => 'Status Siap',
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
    public function getIdPersonalBidang()
    {
        return $this->hasOne(PersonalBidang::className(), ['id_personal_bidang' => 'id_personal_bidang']);
    }
}
