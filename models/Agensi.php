<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "agensi".
 *
 * @property integer $id_agensi
 * @property string $kod_agensi
 * @property string $nama_agensi
 *
 * @property AgensiInstitut[] $agensiInstituts
 * @property Bidang[] $bidangs
 */
class Agensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_agensi', 'nama_agensi'], 'required'],
            [['kod_agensi'], 'string', 'max' => 10],
            [['nama_agensi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_agensi' => 'Id Agensi',
            'kod_agensi' => 'Kod Agensi',
            'nama_agensi' => 'Nama Agensi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgensiInstituts()
    {
        return $this->hasMany(AgensiInstitut::className(), ['id_agensi' => 'id_agensi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidangs()
    {
        return $this->hasMany(Bidang::className(), ['id_agensi' => 'id_agensi']);
    }  

}
