<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bidang;

/**
 * BidangSearch represents the model behind the search form about `app\models\Bidang`.
 */
class BidangSearch extends Bidang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bidang', 'status_bidang', 'id_jenis_kompetensi'], 'integer'],
            [['kod_noss', 'nama_bidang'], 'safe'],
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
        $query = Bidang::find();

        // if(!isset($params['idag']))
        //     $params['idag'] = 0;

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
            'id_bidang' => $this->id_bidang,
            //'id_agensi' =>  $params['idag'],//$this->id_agensi,
            'status_bidang' => $this->status_bidang,
            'id_jenis_kompetensi' => $this->id_jenis_kompetensi,
        ]);

        $query->andFilterWhere(['like', 'kod_noss', $this->kod_noss])
            ->andFilterWhere(['like', 'nama_bidang', $this->nama_bidang]);

        return $dataProvider;
    }
}
