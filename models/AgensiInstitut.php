<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agensi_institut".
 *
 * @property integer $id_agensi_institut
 * @property integer $id_agensi
 * @property string $kod_institut
 * @property string $nama_institut
 * @property string $alamat
 * @property string $bandar
 * @property integer $poskod
 * @property string $negeri
 * @property string $no_tel
 * @property string $no_faks
 * @property string $email
 * @property string $portal
 *
 * @property Agensi $idAgensi
 * @property BidangInstitut[] $bidangInstituts
 */
class AgensiInstitut extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agensi_institut';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_agensi'], 'required'],
            [['id_agensi', 'poskod'], 'integer'],
            [['kod_institut'], 'string', 'max' => 10],
            [['nama_institut'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 150],
            [['bandar', 'negeri'], 'string', 'max' => 20],
            [['no_tel', 'no_faks'], 'string', 'max' => 15],
            [['email', 'portal'], 'string', 'max' => 50],
            [['id_agensi'], 'exist', 'skipOnError' => true, 'targetClass' => Agensi::className(), 'targetAttribute' => ['id_agensi' => 'id_agensi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_agensi_institut' => 'Id Agensi Institut',
            'id_agensi' => 'Id Agensi',
            'kod_institut' => 'Kod Institut',
            'nama_institut' => 'Nama Institut',
            'alamat' => 'Alamat',
            'bandar' => 'Bandar',
            'poskod' => 'Poskod',
            'negeri' => 'Negeri',
            'no_tel' => 'No Tel',
            'no_faks' => 'No Faks',
            'email' => 'Email',
            'portal' => 'Portal',
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
    public function getBidangInstituts()
    {
        return $this->hasMany(BidangInstitut::className(), ['id_agensi_institut' => 'id_agensi_institut']);
    }
}
