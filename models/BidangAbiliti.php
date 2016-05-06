<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidang_abiliti".
 *
 * @property integer $id_bidang_abiliti
 * @property integer $id_bidang_duti
 * @property integer $nombor_abiliti
 * @property string $nama_abiliti
 * @property string $jenis_abiliti
 * @property string $importance
 * @property integer $status_bidang_abiliti
 * @property string $tarikh_daftar
 * @property string $tarikh_mati
 *
 * @property BidangDuti $idBidangDuti
 */
class BidangAbiliti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidang_abiliti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_duti', 'nombor_abiliti', 'nama_abiliti', 'jenis_abiliti', 'importance', 'tarikh_daftar'], 'required'],
            [['id_bidang_duti', 'nombor_abiliti', 'status_bidang_abiliti'], 'integer'],
            [['tarikh_daftar', 'tarikh_mati'], 'safe'],
            [['nama_abiliti'], 'string', 'max' => 255],
            [['jenis_abiliti', 'importance'], 'string', 'max' => 10],
            [['id_bidang_duti'], 'exist', 'skipOnError' => true, 'targetClass' => BidangDuti::className(), 'targetAttribute' => ['id_bidang_duti' => 'id_bidang_duti']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bidang_abiliti' => 'Id Bidang Abiliti',
            'id_bidang_duti' => 'Id Bidang Duti',
            'nombor_abiliti' => 'Nombor Abiliti',
            'nama_abiliti' => 'Nama Abiliti',
            'jenis_abiliti' => 'Jenis Abiliti',
            'importance' => 'Importance',
            'status_bidang_abiliti' => 'Status Bidang Abiliti',
            'tarikh_daftar' => 'Tarikh Daftar',
            'tarikh_mati' => 'Tarikh Mati',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBidangDuti()
    {
        return $this->hasOne(BidangDuti::className(), ['id_bidang_duti' => 'id_bidang_duti']);
    }
}
