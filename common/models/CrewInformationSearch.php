<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CrewInformation;

/**
 * CrewInformationSearch represents the model behind the search form about `common\models\CrewInformation`.
 */
class CrewInformationSearch extends CrewInformation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vessel', 'port', 'marital_status', 'sex', 'status', 'CB', 'UB'], 'integer'],
            [['agent', 'full_name', 'rank', 'nationality', 'date_of_birth', 'place_of_birth', 'residential_address', 'phone_number', 'mothers_name', 'fathers_name', 'joining_date', 'religion', 'first_language', 'photo', 'DOC', 'DOU'], 'safe'],
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
        $query = CrewInformation::find();

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
            'id' => $this->id,
            'vessel' => $this->vessel,
            'port' => $this->port,
            'date_of_birth' => $this->date_of_birth,
            'marital_status' => $this->marital_status,
            'joining_date' => $this->joining_date,
            'sex' => $this->sex,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'agent', $this->agent])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'rank', $this->rank])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'place_of_birth', $this->place_of_birth])
            ->andFilterWhere(['like', 'residential_address', $this->residential_address])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'mothers_name', $this->mothers_name])
            ->andFilterWhere(['like', 'fathers_name', $this->fathers_name])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'first_language', $this->first_language])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        return $dataProvider;
    }
}
