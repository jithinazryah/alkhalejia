<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "financial_years".
 *
 * @property int $id
 * @property string $financial_year
 * @property string $name
 * @property int $financial_period
 * @property string $start_period
 * @property string $end_period
 * @property string $reference
 * @property string $error_msg
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Transaction[] $transactions
 */
class FinancialYears extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'financial_years';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['financial_period', 'financial_year', 'name', 'start_period', 'end_period'], 'required'],
            [['financial_period', 'status', 'CB', 'UB'], 'integer'],
            [['error_msg'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['financial_year', 'name'], 'string', 'max' => 15],
            [['start_period', 'end_period'], 'string', 'max' => 30],
            [['reference'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'financial_year' => 'Financial Year',
            'name' => 'Name',
            'financial_period' => 'Financial Period',
            'start_period' => 'Start Period',
            'end_period' => 'End Period',
            'reference' => 'Reference',
            'error_msg' => 'Error Msg',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions() {
        return $this->hasMany(Transaction::className(), ['financial_year' => 'id']);
    }

}
