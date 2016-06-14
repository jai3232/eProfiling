<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PersonalPerjawatan;

/**
 * PersonalPerjawatanSearch represents the model behind the search form about `app\models\PersonalPerjawatan`.
 */
class PersonalPerjawatanSearch extends PersonalPerjawatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal_perjawatan', 'id_personal', 'kategori_perjawatan', 'id_ref_taraf_perjawatan', 'id_ref_skim_perjawatan', 'id_ref_gred_perjawatan', 'id_agensi_institut', 'id_ref_purata_jam_mengajar', 'is_aktif'], 'integer'],
            [['nama_perjawatan', 'nama_institut_lain', 'nama_bidang_lain', 'no_telefon_pejabat', 'tarikh_mula_perjawatan', 'tarikh_tamat_perjawatan'], 'safe'],
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
        $query = PersonalPerjawatan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_personal_perjawatan' => $this->id_personal_perjawatan,
            'id_personal' => $this->id_personal,
            'kategori_perjawatan' => $this->kategori_perjawatan,
            'id_ref_taraf_perjawatan' => $this->id_ref_taraf_perjawatan,
            'id_ref_skim_perjawatan' => $this->id_ref_skim_perjawatan,
            'id_ref_gred_perjawatan' => $this->id_ref_gred_perjawatan,
            'id_agensi_institut' => $this->id_agensi_institut,
            'id_ref_purata_jam_mengajar' => $this->id_ref_purata_jam_mengajar,
            'tarikh_mula_perjawatan' => $this->tarikh_mula_perjawatan,
            'tarikh_tamat_perjawatan' => $this->tarikh_tamat_perjawatan,
            'is_aktif' => $this->is_aktif,
        ]);

        $query->andFilterWhere(['like', 'nama_perjawatan', $this->nama_perjawatan])
            ->andFilterWhere(['like', 'nama_institut_lain', $this->nama_institut_lain])
            ->andFilterWhere(['like', 'nama_bidang_lain', $this->nama_bidang_lain])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat]);

        return $dataProvider;
    }
}
