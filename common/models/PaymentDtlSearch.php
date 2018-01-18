<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PaymentDtl;

/**
 * PaymentDtlSearch represents the model behind the search form about `common\models\PaymentDtl`.
 */
class PaymentDtlSearch extends PaymentDtl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_mst_id', 'transaction_id', 'status', 'CB', 'UB'], 'integer'],
            [['document_no', 'document_date', 'reference', 'DOC', 'DOU'], 'safe'],
            [['total_amount', 'due_amount', 'paid_amount'], 'number'],
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
        $query = PaymentDtl::find();

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
            'payment_mst_id' => $this->payment_mst_id,
            'transaction_id' => $this->transaction_id,
            'document_date' => $this->document_date,
            'total_amount' => $this->total_amount,
            'due_amount' => $this->due_amount,
            'paid_amount' => $this->paid_amount,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'document_no', $this->document_no])
            ->andFilterWhere(['like', 'reference', $this->reference]);

        return $dataProvider;
    }
}
