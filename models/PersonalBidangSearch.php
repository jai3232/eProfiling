<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PersonalBidang;

/**
 * PersonalBidangSearch represents the model behind the search form about `app\models\PersonalBidang`.
 */
class PersonalBidangSearch extends PersonalBidang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_personal_bidang', 'id_bidang', 'id_personal_perjawatan', 'is_aktif'], 'integer'],
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
        $query = PersonalBidang::find();

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
            'id_personal_bidang' => $this->id_personal_bidang,
            'id_bidang' => $this->id_bidang,
            'id_personal_perjawatan' => $this->id_personal_perjawatan,
            'is_aktif' => $this->is_aktif,
        ]);

        return $dataProvider;
    }
}
