<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_adj_dtl".
 *
 * @property int $id
 * @property int $master_id
 * @property int $transaction 1-Opening,2=Addition,3=Deduction
 * @property string $document_no
 * @property string $document_date
 * @property string $location_code
 * @property int $material_id
 * @property string $material_code
 * @property string $material_name
 * @property string $rate
 * @property int $qty
 * @property string $weight
 * @property string $total_cost
 * @property string $reference
 * @property int $status 0-Open,2=Approved
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property StockAdjMst $master
 */
class StockAdjDtl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'stock_adj_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction', 'document_date'], 'required'],
            [['master_id', 'transaction', 'material_id', 'qty', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'DOC', 'DOU'], 'safe'],
            [['rate', 'weight', 'total_cost'], 'number'],
            [['reference'], 'string'],
            [['CB', 'UB'], 'required'],
            [['document_no', 'material_code', 'material_name'], 'string', 'max' => 100],
            [['location_code'], 'string', 'max' => 20],
            [['master_id'], 'exist', 'skipOnError' => true, 'targetClass' => StockAdjMst::className(), 'targetAttribute' => ['master_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'transaction' => 'Transaction',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'location_code' => 'Location Code',
            'material_id' => 'Material ID',
            'material_code' => 'Material Code',
            'material_name' => 'Material Name',
            'rate' => 'Rate',
            'qty' => 'Qty',
            'weight' => 'Weight',
            'total_cost' => 'Total Cost',
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
    public function getMaster() {
        return $this->hasOne(StockAdjMst::className(), ['id' => 'master_id']);
    }

}
