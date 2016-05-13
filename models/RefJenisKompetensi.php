<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_jenis_kompetensi".
 *
 * @property integer $id_jenis_kompetensi
 * @property string $nama_kompetensi
 * @property string $kod_jenis_kompetensi
 */
class RefJenisKompetensi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_jenis_kompetensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_kompetensi', 'kod_jenis_kompetensi'], 'required'],
            [['kod_jenis_kompetensi'], 'string'],
            [['nama_kompetensi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_jenis_kompetensi' => 'Id Jenis Kompetensi',
            'nama_kompetensi' => 'Nama Kompetensi',
            'kod_jenis_kompetensi' => 'Kod Jenis Kompetensi',
        ];
    }
}
