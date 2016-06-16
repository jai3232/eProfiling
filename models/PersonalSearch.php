<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personal;

/**
 * PersonalSearch represents the model behind the search form about `app\models\Personal`.
 */
class PersonalSearch extends Personal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal', 'id_personal_penyelia', 'status_oku', 'status_warganegara', 'bangsa', 'status_perkahwinan', 'poskod', 'negeri', 'id_ref_status_data'], 'integer'],
            [['nama', 'no_kp', 'emel', 'jantina', 'jenis_oku', 'nama_warganegara', 'bangsa_lain', 'alamat1', 'alamat2', 'bandar', 'no_telefon_peribadi', 'gambar_personal', 'katalaluan', 'tahap_akses'], 'safe'],
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
        $query = Personal::find();

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
            'id_personal' => $this->id_personal,
            'id_personal_penyelia' => $this->id_personal_penyelia,
            'status_oku' => $this->status_oku,
            'status_warganegara' => $this->status_warganegara,
            'bangsa' => $this->bangsa,
            'status_perkahwinan' => $this->status_perkahwinan,
            'poskod' => $this->poskod,
            'negeri' => $this->negeri,
            'id_ref_status_data' => $this->id_ref_status_data,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kp', $this->no_kp])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'jenis_oku', $this->jenis_oku])
            ->andFilterWhere(['like', 'nama_warganegara', $this->nama_warganegara])
            ->andFilterWhere(['like', 'bangsa_lain', $this->bangsa_lain])
            ->andFilterWhere(['like', 'alamat1', $this->alamat1])
            ->andFilterWhere(['like', 'alamat2', $this->alamat2])
            ->andFilterWhere(['like', 'bandar', $this->bandar])
            ->andFilterWhere(['like', 'no_telefon_peribadi', $this->no_telefon_peribadi])
            ->andFilterWhere(['like', 'gambar_personal', $this->gambar_personal])
            ->andFilterWhere(['like', 'katalaluan', $this->katalaluan])
            ->andFilterWhere(['like', 'tahap_akses', $this->tahap_akses]);

        //$query->orderBy('id_personal DESC');

        return $dataProvider;
    }
}
