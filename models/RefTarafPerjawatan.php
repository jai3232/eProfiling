<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_taraf_perjawatan".
 *
 * @property integer $id_ref_taraf_perjawatan
 * @property string $taraf_perjawatan
 */
class RefTarafPerjawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_taraf_perjawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taraf_perjawatan'], 'required'],
            [['taraf_perjawatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_taraf_perjawatan' => 'Id Ref Taraf Perjawatan',
            'taraf_perjawatan' => 'Taraf Perjawatan',
        ];
    }
}
