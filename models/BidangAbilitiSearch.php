<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BidangAbiliti;

/**
 * BidangAbilitiSearch represents the model behind the search form about `app\models\BidangAbiliti`.
 */
class BidangAbilitiSearch extends BidangAbiliti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_abiliti', 'id_bidang_duti', 'nombor_abiliti', 'status_bidang_abiliti'], 'integer'],
            [['nama_abiliti', 'jenis_abiliti', 'importance', 'tarikh_daftar', 'tarikh_mati'], 'safe'],
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
        $query = BidangAbiliti::find();

        // add conditions that should always apply here
        if(!isset($params['idbd']))
            $params['idbd'] = 0;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_bidang_abiliti' => SORT_DESC,
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
        $query->andFilterWhere([
            'id_bidang_abiliti' => $this->id_bidang_abiliti,
            'id_bidang_duti' => $params['idbd'],//$this->id_bidang_duti,
            'nombor_abiliti' => $this->nombor_abiliti,
            'status_bidang_abiliti' => $this->status_bidang_abiliti,
            'tarikh_daftar' => $this->tarikh_daftar,
            'tarikh_mati' => $this->tarikh_mati,
        ]);

        $query->andFilterWhere(['like', 'nama_abiliti', $this->nama_abiliti])
            ->andFilterWhere(['like', 'jenis_abiliti', $this->jenis_abiliti])
            ->andFilterWhere(['like', 'importance', $this->importance]);

        return $dataProvider;
    }
}
