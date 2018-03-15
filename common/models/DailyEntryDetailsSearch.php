<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DailyEntryDetails;

/**
 * DailyEntryDetailsSearch represents the model behind the search form about `common\models\DailyEntryDetails`.
 */
class DailyEntryDetailsSearch extends DailyEntryDetails {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'daily_entry_id', 'status', 'CB', 'UB', 'tax_id'], 'integer'],
            [['ticket_no', 'truck_number', 'gross_weight', 'tare_weight', 'net_weight', 'description', 'DOC', 'DOU', 'per_ton'], 'safe'],
            [['rate', 'total', 'transport_amount', 'tax_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = DailyEntryDetails::find();

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
            'daily_entry_id' => $this->daily_entry_id,
            'rate' => $this->rate,
            'total' => $this->total,
            'tax_id' => $this->tax_id,
            'tax_amount' => $this->tax_amount,
            'transport_amount' => $this->transport_amount,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'ticket_no', $this->ticket_no])
                ->andFilterWhere(['like', 'truck_number', $this->truck_number])
                ->andFilterWhere(['like', 'gross_weight', $this->gross_weight])
                ->andFilterWhere(['like', 'tare_weight', $this->tare_weight])
                ->andFilterWhere(['like', 'net_weight', $this->net_weight])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
