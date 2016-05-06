<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AgensiInstitut;

/**
 * AgensiInstitutSearch represents the model behind the search form about `app\models\AgensiInstitut`.
 */
class AgensiInstitutSearch extends AgensiInstitut
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_agensi_institut', 'id_agensi', 'poskod'], 'integer'],
            [['kod_institut', 'nama_institut', 'alamat', 'bandar', 'negeri', 'no_tel', 'no_faks', 'email', 'portal'], 'safe'],
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
        $query = AgensiInstitut::find();
        //print_r($params['idag']);
        // add conditions that should always apply here

        if(!isset($params['idag']))
            $params['idag'] = 0;

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
            'id_agensi_institut' => $this->id_agensi_institut,
            'id_agensi' => $params['idag'],//$this->id_agensi,
            'poskod' => $this->poskod,
        ]);

        $query->andFilterWhere(['like', 'kod_institut', $this->kod_institut])
            ->andFilterWhere(['like', 'nama_institut', $this->nama_institut])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'bandar', $this->bandar])
            ->andFilterWhere(['like', 'negeri', $this->negeri])
            ->andFilterWhere(['like', 'no_tel', $this->no_tel])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'portal', $this->portal]);

        return $dataProvider;
    }
}
