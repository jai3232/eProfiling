<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_bidang".
 *
 * @property integer $id_personal_bidang
 * @property integer $id_bidang
 * @property integer $id_personal
 * @property integer $id_personal_perjawatan
 * @property integer $is_aktif
 *
 * @property PersonalPerjawatan $idPersonalPerjawatan
 * @property Bidang $idBidang
 * @property Personal $idPersonal
 */
class PersonalBidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang', 'id_personal', 'id_personal_perjawatan'], 'required'],
            [['id_bidang', 'id_personal', 'id_personal_perjawatan', 'is_aktif'], 'integer'],
            [['id_personal_perjawatan'], 'exist', 'skipOnError' => true, 'targetClass' => PersonalPerjawatan::className(), 'targetAttribute' => ['id_personal_perjawatan' => 'id_personal_perjawatan']],
            [['id_bidang'], 'exist', 'skipOnError' => true, 'targetClass' => Bidang::className(), 'targetAttribute' => ['id_bidang' => 'id_bidang']],
            [['id_personal'], 'exist', 'skipOnError' => true, 'targetClass' => Personal::className(), 'targetAttribute' => ['id_personal' => 'id_personal']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_personal_bidang' => 'Id Personal Bidang',
            'id_bidang' => 'Id Bidang',
            'id_personal' => 'Id Personal',
            'id_personal_perjawatan' => 'Id Personal Perjawatan',
            'is_aktif' => 'Is Aktif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonalPerjawatan()
    {
        return $this->hasOne(PersonalPerjawatan::className(), ['id_personal_perjawatan' => 'id_personal_perjawatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBidang()
    {
        return $this->hasOne(Bidang::className(), ['id_bidang' => 'id_bidang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonal()
    {
        return $this->hasOne(Personal::className(), ['id_personal' => 'id_personal']);
    }
}
