<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PaymentMst;

/**
 * PaymentMstSearch represents the model behind the search form about `common\models\PaymentMst`.
 */
class PaymentMstSearch extends PaymentMst
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'transaction_type', 'supplier', 'payment_mode', 'status', 'CB', 'UB'], 'integer'],
            [['document_no', 'document_date', 'cheque_no', 'cheque_due_date', 'reference', 'DOC', 'DOU'], 'safe'],
            [['due_amount', 'paid_amount'], 'number'],
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
        $query = PaymentMst::find();

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
            'document_date' => $this->document_date,
            'supplier' => $this->supplier,
            'due_amount' => $this->due_amount,
            'paid_amount' => $this->paid_amount,
            'payment_mode' => $this->payment_mode,
            'cheque_due_date' => $this->cheque_due_date,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'document_no', $this->document_no])
            ->andFilterWhere(['like', 'cheque_no', $this->cheque_no])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
