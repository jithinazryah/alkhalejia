<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FinancialYears;

/**
 * FinancialYearsSearch represents the model behind the search form about `common\models\FinancialYears`.
 */
class FinancialYearsSearch extends FinancialYears
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'financial_period', 'status', 'CB', 'UB'], 'integer'],
            [['financial_year', 'name', 'start_period', 'end_period', 'reference', 'error_msg', 'DOC', 'DOU'], 'safe'],
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
        $query = FinancialYears::find();

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
            'financial_period' => $this->financial_period,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'financial_year', $this->financial_year])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'start_period', $this->start_period])
            ->andFilterWhere(['like', 'end_period', $this->end_period])
            ->andFilterWhere(['like', 'reference', $this->reference])
            ->andFilterWhere(['like', 'error_msg', $this->error_msg]);

        return $dataProvider;
    }
}
