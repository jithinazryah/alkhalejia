<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchase_order_dtl".
 *
 * @property int $id
 * @property int $purchase_order_mst_id
 * @property int $qty
 * @property string $total
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PurchaseOrderMst $purchaseOrderMst
 */
class PurchaseOrderDtl extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'purchase_order_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['purchase_order_mst_id', 'qty', 'status', 'CB', 'UB', 'unit'], 'integer'],
                [['total', 'rate'], 'number'],
                [['description'], 'string'],
                [['DOC', 'DOU'], 'safe'],
                [['purchase_order_mst_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderMst::className(), 'targetAttribute' => ['purchase_order_mst_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'purchase_order_mst_id' => 'Purchase Order Mst ID',
            'qty' => 'Qty',
            'total' => 'Total',
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
    public function getPurchaseOrderMst() {
        return $this->hasOne(PurchaseOrderMst::className(), ['id' => 'purchase_order_mst_id']);
    }

}
