<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianProfil;

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
            [['id_penilaian_profil', 'id_personal_bidang', 'status_siap'], 'integer'],
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
            'sort'=> ['defaultOrder' => ['id_penilaian_profil'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_penilaian_profil' => $this->id_penilaian_profil,
            'id_personal_bidang' => $this->id_personal_bidang,
            'tarikh_penilaian' => $this->tarikh_penilaian,
            'status_siap' => $this->status_siap,
        ]);

        return $dataProvider;
    }
}
