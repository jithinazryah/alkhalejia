<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PurchaseOrderDtl;

/**
 * PurchaseOrderDtlSearch represents the model behind the search form about `common\models\PurchaseOrderDtl`.
 */
class PurchaseOrderDtlSearch extends PurchaseOrderDtl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'purchase_order_mst_id', 'material_id', 'unit', 'qty', 'tax', 'status', 'CB', 'UB'], 'integer'],
            [['material_code', 'material_name', 'description', 'DOC', 'DOU'], 'safe'],
            [['unit_price', 'total', 'tax_amount', 'sub_total'], 'number'],
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
        $query = PurchaseOrderDtl::find();

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
            'purchase_order_mst_id' => $this->purchase_order_mst_id,
            'material_id' => $this->material_id,
            'unit' => $this->unit,
            'unit_price' => $this->unit_price,
            'qty' => $this->qty,
            'total' => $this->total,
            'tax' => $this->tax,
            'tax_amount' => $this->tax_amount,
            'sub_total' => $this->sub_total,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'material_code', $this->material_code])
            ->andFilterWhere(['like', 'material_name', $this->material_name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
