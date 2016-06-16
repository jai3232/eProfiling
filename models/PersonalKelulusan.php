<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_kelulusan".
 *
 * @property integer $id_personal_kelulusan
 * @property integer $id_personal
 * @property integer $id_ref_tahap_kelulusan
 * @property string $institusi_kelulusan
 * @property string $pengkhususan_kelulusan
 * @property integer $tahun_dapat_sijil
 * @property integer $tahun_lupus_sijil
 *
 * @property Personal $idPersonal
 */
class PersonalKelulusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_kelulusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal', 'id_ref_tahap_kelulusan', 'institusi_kelulusan', 'pengkhususan_kelulusan', 'tahun_dapat_sijil'], 'required'],
            [['id_personal', 'id_ref_tahap_kelulusan', 'tahun_dapat_sijil', 'tahun_lupus_sijil'], 'integer'],
            [['institusi_kelulusan', 'pengkhususan_kelulusan'], 'string', 'max' => 50],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id_personal']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_personal_kelulusan' => 'Id Personal Kelulusan',
            'id_personal' => 'Id Personal',
            'id_ref_tahap_kelulusan' => 'Id Ref Tahap Kelulusan',
            'institusi_kelulusan' => 'Institusi Kelulusan',
            'pengkhususan_kelulusan' => 'Pengkhususan Kelulusan',
            'tahun_dapat_sijil' => 'Tahun Dapat Sijil',
            'tahun_lupus_sijil' => 'Tahun Lupus Sijil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonal()
    {
        return $this->hasOne(Personal::className(), ['id_personal' => 'id_personal']);
    }

    public function getIdTahapKelulusan()
    {
        return $this->hasOne(RefTahapKelulusan::className(), ['id_ref_tahap_kelulusan' => 'id_ref_tahap_kelulusan']);
    }
}
