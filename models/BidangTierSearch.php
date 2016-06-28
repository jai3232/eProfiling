<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BidangTier;

/**
 * BidangTierSearch represents the model behind the search form about `app\models\BidangTier`.
 */
class BidangTierSearch extends BidangTier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_tier', 'id_bidang', 'status_bidang_tier'], 'integer'],
            [['kod_tier', 'tarikh_pembangunan_tier'], 'safe'],
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
        $query = BidangTier::find();

        // add conditions that should always apply here
        if(!isset($params['idbi']))
            $params['idbi'] = 0;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id_bidang_tier' => SORT_DESC,
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
            'id_bidang_tier' => $this->id_bidang_tier,
            'id_bidang' => $params['idbi'],//$this->id_bidang,
            'status_bidang_tier' => $this->status_bidang_tier,
            'tarikh_pembangunan_tier' => $this->tarikh_pembangunan_tier,
        ]);

        $query->andFilterWhere(['like', 'kod_tier', $this->kod_tier]);

        return $dataProvider;
    }
}
