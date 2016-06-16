<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_tahap_kelulusan".
 *
 * @property integer $id_ref_tahap_kelulusan
 * @property string $tahap_kelulusan
 */
class RefTahapKelulusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_tahap_kelulusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahap_kelulusan'], 'required'],
            [['tahap_kelulusan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_tahap_kelulusan' => 'Id Ref Tahap Kelulusan',
            'tahap_kelulusan' => 'Tahap Kelulusan',
        ];
    }
}
