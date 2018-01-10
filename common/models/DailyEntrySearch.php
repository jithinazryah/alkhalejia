<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DailyEntry;

/**
 * DailyEntrySearch represents the model behind the search form about `common\models\DailyEntry`.
 */
class DailyEntrySearch extends DailyEntry {

    /**
     * @inheritdoc
     */
    public $ticket;

    public function rules() {
        return [
            [['id', 'material', 'supplier', 'transport', 'payment_status', 'yard_id', 'status', 'CB', 'UB'], 'integer'],
            [['received_date', 'ticket', 'DOC', 'DOU'], 'safe'],
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
        $query = DailyEntry::find();
        $query->joinWith(['dailyEntryDetails']);

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
            'received_date' => $this->received_date,
            'material' => $this->material,
            'supplier' => $this->supplier,
            'transport' => $this->transport,
            'payment_status' => $this->payment_status,
            'yard_id' => $this->yard_id,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);
        $query->andFilterWhere(['like', 'daily_entry_details.ticket_no', $this->ticket]);

        return $dataProvider;
    }

}
