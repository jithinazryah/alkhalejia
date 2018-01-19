<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchase_order_dtl".
 *
 * @property int $id
 * @property int $purchase_order_mst_id
 * @property int $material_id
 * @property string $material_code
 * @property string $material_name
 * @property int $unit
 * @property string $unit_price
 * @property int $qty
 * @property string $total
 * @property int $tax
 * @property string $tax_amount
 * @property string $sub_total
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PurchaseOrderMst $purchaseOrderMst
 */
class PurchaseOrderDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_order_mst_id', 'material_id', 'unit', 'qty', 'tax', 'status', 'CB', 'UB'], 'integer'],
            [['unit_price', 'total', 'tax_amount', 'sub_total'], 'number'],
            [['CB', 'UB'], 'required'],
            [['DOC', 'DOU'], 'safe'],
            [['material_code', 'material_name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
            [['purchase_order_mst_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderMst::className(), 'targetAttribute' => ['purchase_order_mst_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase_order_mst_id' => 'Purchase Order Mst ID',
            'material_id' => 'Material ID',
            'material_code' => 'Material Code',
            'material_name' => 'Material Name',
            'unit' => 'Unit',
            'unit_price' => 'Unit Price',
            'qty' => 'Qty',
            'total' => 'Total',
            'tax' => 'Tax',
            'tax_amount' => 'Tax Amount',
            'sub_total' => 'Sub Total',
            'description' => 'Description',
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
    public function getPurchaseOrderMst()
    {
        return $this->hasOne(PurchaseOrderMst::className(), ['id' => 'purchase_order_mst_id']);
    }
}
