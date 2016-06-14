<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_skim_perjawatan".
 *
 * @property integer $id_ref_skim_perjawatan
 * @property string $kod_skim_perjawatan
 * @property string $nama_skim_perjawatan
 */
class RefSkimPerjawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_skim_perjawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_skim_perjawatan', 'nama_skim_perjawatan'], 'required'],
            [['kod_skim_perjawatan'], 'string', 'max' => 10],
            [['nama_skim_perjawatan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_skim_perjawatan' => 'Id Ref Skim Perjawatan',
            'kod_skim_perjawatan' => 'Kod Skim Perjawatan',
            'nama_skim_perjawatan' => 'Nama Skim Perjawatan',
        ];
    }
}
