<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_status_data".
 *
 * @property integer $id_ref_status_data
 * @property string $status_data
 */
class RefStatusData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_status_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_data'], 'required'],
            [['status_data'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_status_data' => 'Id Ref Status Data',
            'status_data' => 'Status Data',
        ];
    }
}
