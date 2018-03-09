<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CrewInformationDetails;

/**
 * CrewInformationDetailsSearch represents the model behind the search form about `common\models\CrewInformationDetails`.
 */
class CrewInformationDetailsSearch extends CrewInformationDetails {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'CB', 'UB'], 'integer'],
            [['passport_no', 'passport_issue_date', 'passport_expiry_date', 'passport_issued_by', 'seaman_book_no', 'seaman_book_issue_date', 'seaman_book_expiry_date', 'seaman_book_issued_by', 'educational_attainment', 'panama_endorsement_no', 'panama_endorsement_issue_date', 'panama_endorsement_expiry_date', 'DOC', 'DOU', 'crew_id'], 'safe'],
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
        $query = CrewInformationDetails::find();

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
            'passport_issue_date' => $this->passport_issue_date,
            'passport_expiry_date' => $this->passport_expiry_date,
            'seaman_book_issue_date' => $this->seaman_book_issue_date,
            'seaman_book_expiry_date' => $this->seaman_book_expiry_date,
            'panama_endorsement_issue_date' => $this->panama_endorsement_issue_date,
            'panama_endorsement_expiry_date' => $this->panama_endorsement_expiry_date,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'passport_no', $this->passport_no])
                ->andFilterWhere(['like', 'passport_issued_by', $this->passport_issued_by])
                ->andFilterWhere(['like', 'seaman_book_no', $this->seaman_book_no])
                ->andFilterWhere(['like', 'seaman_book_issued_by', $this->seaman_book_issued_by])
                ->andFilterWhere(['like', 'educational_attainment', $this->educational_attainment])
                ->andFilterWhere(['like', 'panama_endorsement_no', $this->panama_endorsement_no]);

        return $dataProvider;
    }

}
