<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Materials;

/**
 * MaterialsSearch represents the model behind the search form about `common\models\Materials`.
 */
class MaterialsSearch extends Materials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tax', 'unit', 'status', 'CB', 'UB'], 'integer'],
            [['name', 'code', 'size', 'image', 'description', 'DOC', 'DOU'], 'safe'],
            [['purchase_price', 'selling_price'], 'number'],
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
        $query = Materials::find();

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
            'tax' => $this->tax,
            'unit' => $this->unit,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
