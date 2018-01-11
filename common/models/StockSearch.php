<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Stock;

/**
 * StockSearch represents the model behind the search form about `common\models\Stock`.
 */
class StockSearch extends Stock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_type', 'transaction_id', 'material_id', 'yard_id', 'quantity_in', 'quantity_out', 'weight_in', 'weight_out', 'status', 'CB', 'UB'], 'integer'],
            [['material_code', 'yard_code', 'DOC', 'DOU'], 'safe'],
            [['material_cost', 'total_cost'], 'number'],
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
        $query = Stock::find();

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
            'transaction_type' => $this->transaction_type,
            'transaction_id' => $this->transaction_id,
            'material_id' => $this->material_id,
            'yard_id' => $this->yard_id,
            'material_cost' => $this->material_cost,
            'quantity_in' => $this->quantity_in,
            'quantity_out' => $this->quantity_out,
            'weight_in' => $this->weight_in,
            'weight_out' => $this->weight_out,
            'total_cost' => $this->total_cost,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'material_code', $this->material_code])
            ->andFilterWhere(['like', 'yard_code', $this->yard_code]);

        return $dataProvider;
    }
}
