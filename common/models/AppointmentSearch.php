<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Appointment;

/**
 * AppointmentSearch represents the model behind the search form about `common\models\Appointment`.
 */
class AppointmentSearch extends Appointment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vessel', 'material', 'quantity', 'status', 'CB', 'UB'], 'integer'],
            [['appointment_number', 'date', 'port_of_call', 'terminal', 'berth_number', 'eta', 'description', 'DOC', 'DOU'], 'safe'],
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
        $query = Appointment::find();

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
            'vessel' => $this->vessel,
            'date' => $this->date,
            'material' => $this->material,
            'quantity' => $this->quantity,
            'eta' => $this->eta,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'appointment_number', $this->appointment_number])
            ->andFilterWhere(['like', 'port_of_call', $this->port_of_call])
            ->andFilterWhere(['like', 'terminal', $this->terminal])
            ->andFilterWhere(['like', 'berth_number', $this->berth_number])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
