<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penilaian_markah".
 *
 * @property integer $id_penilaian_markah
 * @property integer $id_penilaian_profil
 * @property integer $markah
 * @property integer $status_supervisor
 * @property string $nota_supervisor
 *
 * @property PenilaianProfil $idPenilaianProfil
 */
class PenilaianMarkah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penilaian_markah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penilaian_profil', 'markah'], 'required'],
            [['id_penilaian_profil', 'markah', 'status_supervisor'], 'integer'],
            [['nota_supervisor'], 'string'],
            [['id_penilaian_profil'], 'exist', 'skipOnError' => true, 'targetClass' => PenilaianProfil::className(), 'targetAttribute' => ['id_penilaian_profil' => 'id_penilaian_profil']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_penilaian_markah' => 'Id Penilaian Markah',
            'id_penilaian_profil' => 'Id Penilaian Profil',
            'markah' => 'Markah',
            'status_supervisor' => 'Status Supervisor',
            'nota_supervisor' => 'Nota Supervisor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPenilaianProfil()
    {
        return $this->hasOne(PenilaianProfil::className(), ['id_penilaian_profil' => 'id_penilaian_profil']);
    }
}
