<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notifications;

/**
 * NotificationsSearch represents the model behind the search form about `common\models\Notifications`.
 */
class NotificationsSearch extends Notifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'notification_type', 'table_id', 'status', 'sort_order'], 'integer'],
            [['content', 'message', 'expiry_date'], 'safe'],
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
        $query = Notifications::find();

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
            'notification_type' => $this->notification_type,
            'table_id' => $this->table_id,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'expiry_date' => $this->expiry_date,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
