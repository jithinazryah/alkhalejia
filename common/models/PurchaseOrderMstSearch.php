<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PurchaseOrderMst;

/**
 * PurchaseOrderMstSearch represents the model behind the search form about `common\models\PurchaseOrderMst`.
 */
class PurchaseOrderMstSearch extends PurchaseOrderMst {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'vessel', 'attenssion', 'port', 'status', 'CB', 'UB', 'payment_mode', 'currency'], 'integer'],
            [['date', 'reference_no', 'appointment_no', 'invoice_no', 'address', 'invoice', 'email_confirmation', 'delivery_note', 'eta', 'payment_terms', 'agent_details', 'DOC', 'DOU', 'payment_date', 'cheque_number', 'cheque_date'], 'safe'],
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
        $query = PurchaseOrderMst::find();

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
            'date' => $this->date,
            'vessel' => $this->vessel,
            'attenssion' => $this->attenssion,
            'eta' => $this->eta,
            'port' => $this->port,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'reference_no', $this->reference_no])
                ->andFilterWhere(['like', 'appointment_no', $this->appointment_no])
                ->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'invoice', $this->invoice])
                ->andFilterWhere(['like', 'email_confirmation', $this->email_confirmation])
                ->andFilterWhere(['like', 'delivery_note', $this->delivery_note])
                ->andFilterWhere(['like', 'payment_terms', $this->payment_terms])
                ->andFilterWhere(['like', 'agent_details', $this->agent_details]);

        return $dataProvider;
    }

}
