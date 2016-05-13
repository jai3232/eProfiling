<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BidangDuti;

/**
 * BidangDutiSearch represents the model behind the search form about `app\models\BidangDuti`.
 */
class BidangDutiSearch extends BidangDuti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_duti', 'id_bidang_tier', 'nombor_duti', 'status_bidang_duti'], 'integer'],
            [['nama_duti'], 'safe'],
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
        $query = BidangDuti::find();

        // add conditions that should always apply here
        if(!isset($params['idbt']))
            $params['idbt'] = 0;

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
            'id_bidang_duti' => $this->id_bidang_duti,
            'id_bidang_tier' => $params['idbt'],//$this->id_bidang_tier,
            'nombor_duti' => $this->nombor_duti,
            'status_bidang_duti' => $this->status_bidang_duti,
        ]);

        $query->andFilterWhere(['like', 'nama_duti', $this->nama_duti]);

        return $dataProvider;
    }
}
