<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_gred_perjawatan".
 *
 * @property integer $id_ref_gred_perjawatan
 * @property string $gred_perjawatan
 */
class RefGredPerjawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_gred_perjawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gred_perjawatan'], 'required'],
            [['gred_perjawatan'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_gred_perjawatan' => 'Id Ref Gred Perjawatan',
            'gred_perjawatan' => 'Gred Perjawatan',
        ];
    }
}
