<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_adm_tahap_akses".
 *
 * @property integer $id_adm_tahap_akses
 * @property string $tahap_akses
 */
class RefAdmTahapAkses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_adm_tahap_akses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahap_akses'], 'required'],
            [['tahap_akses'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_adm_tahap_akses' => 'Id Adm Tahap Akses',
            'tahap_akses' => 'Tahap Akses',
        ];
    }
}
