<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CrewCertificate;

/**
 * CrewCertificateSearch represents the model behind the search form about `common\models\CrewCertificate`.
 */
class CrewCertificateSearch extends CrewCertificate {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'crew_id', 'certificate_id', 'status', 'CB', 'UB'], 'integer'],
            [['date_of_issue', 'date_of_expiry', 'issuing_authority', 'DOC', 'DOU', 'image'], 'safe'],
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
        $query = CrewCertificate::find();

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
        if (!empty($this->date_of_expiry) && strpos($this->date_of_expiry, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->date_of_expiry);

            $query->andFilterWhere(['between', 'date(date_of_expiry)', $start_date, $end_date]);
            $this->date_of_expiry = "";
        }
        if (!empty($this->date_of_issue) && strpos($this->date_of_issue, '-') !== false) {
            list($start_date, $end_date) = explode(' - ', $this->date_of_issue);

            $query->andFilterWhere(['between', 'date(date_of_issue)', $start_date, $end_date]);
            $this->date_of_issue = "";
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'crew_id' => $this->crew_id,
            'certificate_id' => $this->certificate_id,
            'date_of_issue' => $this->date_of_issue,
            'date_of_expiry' => $this->date_of_expiry,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'issuing_authority', $this->issuing_authority]);

        return $dataProvider;
    }

}
