<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ChequeNotification;

/**
 * ChequeNotificationSearch represents the model behind the search form about `common\models\ChequeNotification`.
 */
class ChequeNotificationSearch extends ChequeNotification
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_id', 'status', 'CB', 'UB'], 'integer'],
            [['cheque_no', 'cheque_due_date', 'DOC', 'DOU'], 'safe'],
            [['cheque_amount'], 'number'],
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
        $query = ChequeNotification::find();

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
            'payment_id' => $this->payment_id,
            'cheque_due_date' => $this->cheque_due_date,
            'cheque_amount' => $this->cheque_amount,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'cheque_no', $this->cheque_no]);

        return $dataProvider;
    }
}
