<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchase_order_mst".
 *
 * @property int $id
 * @property string $date
 * @property int $vessel
 * @property string $reference_no
 * @property string $appointment_no
 * @property string $invoice_no
 * @property int $attenssion
 * @property string $address
 * @property string $invoice
 * @property string $email_confirmation
 * @property string $delivery_note
 * @property string $eta
 * @property int $port
 * @property string $payment_terms
 * @property string $agent_details
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PurchaseOrderDtl[] $purchaseOrderDtls
 */
class PurchaseOrderMst extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'purchase_order_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['date', 'eta', 'DOC', 'DOU', 'payment_terms', 'agent_details', 'category', 'other'], 'safe'],
            [['vessel', 'attenssion', 'port', 'status', 'CB', 'UB', 'appointment_no'], 'integer'],
            [['address'], 'string'],
            [['reference_no', 'invoice_no', 'invoice', 'email_confirmation', 'delivery_note'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'vessel' => 'Vessel',
            'reference_no' => 'Reference No',
            'appointment_no' => 'Appointment No',
            'invoice_no' => 'Invoice No',
            'attenssion' => 'Supplier',
            'address' => 'Address',
            'category' => 'Category',
            'other' => 'Other',
            'invoice' => 'Invoice',
            'email_confirmation' => 'Email Confirmation',
            'delivery_note' => 'Delivery Note',
            'eta' => 'ETA',
            'port' => 'Port',
            'payment_terms' => 'Payment Terms',
            'agent_details' => 'Agent Details',
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
    public function getPurchaseOrderDtls() {
        return $this->hasMany(PurchaseOrderDtl::className(), ['purchase_order_mst_id' => 'id']);
    }

}
