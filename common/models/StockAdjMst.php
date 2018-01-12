<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_adj_mst".
 *
 * @property int $id
 * @property int $transaction 1-Opening,2=Addition,3=Deduction
 * @property string $document_no
 * @property string $document_date
 * @property string $location_code
 * @property string $reference
 * @property int $status 0-Open,2=Approved
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property StockAdjDtl[] $stockAdjDtls
 */
class StockAdjMst extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_adj_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'DOC', 'DOU'], 'safe'],
            [['reference'], 'string'],
            [['document_no'], 'string', 'max' => 100],
            [['location_code'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction' => 'Transaction',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'location_code' => 'Location Code',
            'reference' => 'Reference',
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
    public function getStockAdjDtls()
    {
        return $this->hasMany(StockAdjDtl::className(), ['master_id' => 'id']);
    }
}
