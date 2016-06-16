<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PersonalKelulusan;

/**
 * PersonalKelulusanSearch represents the model behind the search form about `app\models\PersonalKelulusan`.
 */
class PersonalKelulusanSearch extends PersonalKelulusan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal_kelulusan', 'id_personal', 'id_ref_tahap_kelulusan', 'tahun_dapat_sijil', 'tahun_lupus_sijil'], 'integer'],
            [['institusi_kelulusan', 'pengkhususan_kelulusan'], 'safe'],
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
        $query = PersonalKelulusan::find();

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
            'id_personal_kelulusan' => $this->id_personal_kelulusan,
            'id_personal' => $this->id_personal,
            'id_ref_tahap_kelulusan' => $this->id_ref_tahap_kelulusan,
            'tahun_dapat_sijil' => $this->tahun_dapat_sijil,
            'tahun_lupus_sijil' => $this->tahun_lupus_sijil,
        ]);

        $query->andFilterWhere(['like', 'institusi_kelulusan', $this->institusi_kelulusan])
            ->andFilterWhere(['like', 'pengkhususan_kelulusan', $this->pengkhususan_kelulusan]);

        return $dataProvider;
    }
}
