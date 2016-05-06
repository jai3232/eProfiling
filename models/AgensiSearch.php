<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agensi;

/**
 * AgensiSearch represents the model behind the search form about `app\models\Agensi`.
 */
class AgensiSearch extends Agensi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_agensi'], 'integer'],
            [['kod_agensi', 'nama_agensi'], 'safe'],
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
        $query = Agensi::find();

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
            'id_agensi' => $this->id_agensi,
        ]);

        $query->andFilterWhere(['like', 'kod_agensi', $this->kod_agensi])
            ->andFilterWhere(['like', 'nama_agensi', $this->nama_agensi]);

        return $dataProvider;
    }
}
