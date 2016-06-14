<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_purata_jam_mengajar".
 *
 * @property integer $id_ref_purata_jam_mengajar
 * @property string $purata_jam_mengajar
 */
class RefPurataJamMengajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_purata_jam_mengajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purata_jam_mengajar'], 'required'],
            [['purata_jam_mengajar'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ref_purata_jam_mengajar' => 'Id Ref Purata Jam Mengajar',
            'purata_jam_mengajar' => 'Purata Jam Mengajar',
        ];
    }
}
