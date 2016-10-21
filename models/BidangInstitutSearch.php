<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BidangInstitut;

/**
 * BidangInstitutSearch represents the model behind the search form about `app\models\BidangInstitut`.
 */
class BidangInstitutSearch extends BidangInstitut
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang_institut', 'id_agensi_institut'], 'integer'],
            ['id_bidang', 'safe'],
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
        $query = BidangInstitut::find();

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

        $query->joinWith('idBidang');
        // grid filtering conditions
        $query->andFilterWhere([
            'id_bidang_institut' => $this->id_bidang_institut,
            'id_agensi_institut' =>  $params['idai'],
            //'id_bidang' => $this->id_bidang,
            'bidang.nama_bidang'=>$this->id_bidang,
        ]);

        return $dataProvider;
    }
}
