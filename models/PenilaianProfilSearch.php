<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianProfil;
use app\models\Personal;
use app\models\PersonalBidang;

/**
 * PenilaianProfilSearch represents the model behind the search form about `app\models\PenilaianProfil`.
 */
class PenilaianProfilSearch extends PenilaianProfil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penilaian_profil', 'id_personal_bidang'], 'integer'],
            [['tarikh_penilaian'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PenilaianProfil::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_penilaian_profil' => SORT_DESC,
            ]
    ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        // $personal = Personal::findOne(['no_kp' => Yii::$app->user->identity->no_kp]);
        // $id_personal = $personal->id_personal;
        // $personal_bidang = PersonalBidang::findAll(['id_personal' => 2]);
        // if(count($personal_bidang)) {
        //     $id_personal_bidang = $personal_bidang->attributes['id_personal_bidang'];
        // }
        // else
        //     $id_personal_bidang = -1; // no record
        //$personal_bidangs = PersonalBidang::findAll(['id_personal' => $id_personal]);
        $personal_bidangs = PersonalBidang::findAll(['id_personal' => Yii::$app->user->identity->id_personal]);
        if(count($personal_bidangs) > 0) {
            $i = 0;
            foreach ($personal_bidangs as $personal_bidang) {
                $id_personal_bidang_array[$i] = $personal_bidang->attributes['id_personal_bidang'];
                $i++;
            }
            $penilaian_profils = PenilaianProfil::findAll(['id_personal_bidang' => $id_personal_bidang_array]);

            if(count($penilaian_profils)) {
                foreach ($penilaian_profils as $penilaian_profil) {
                    $id_penilaian_profil_array[$i] = $penilaian_profil->attributes['id_penilaian_profil'];
                    $i++;   
                }
            }
            else
                $id_penilaian_profil_array = -1;
        }
        else
            $id_penilaian_profil_array = -1;
        //return print_r($id_penilaian_profil_array);

        $query->andFilterWhere([
            'id_penilaian_profil' => $id_penilaian_profil_array,//$this->id_penilaian_profil,
            'id_personal_bidang' => $this->id_personal_bidang,
            'tarikh_penilaian' => $this->tarikh_penilaian,
        ]);
        
        return $dataProvider;
    }
}
