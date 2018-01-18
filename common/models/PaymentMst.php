<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_mst".
 *
 * @property int $id
 * @property int $transaction_type 1-Receipt,2=Payment
 * @property string $document_no
 * @property string $document_date
 * @property int $supplier
 * @property string $due_amount
 * @property string $paid_amount
 * @property int $payment_mode 1-Cash,2=Cheque
 * @property string $cheque_no
 * @property string $cheque_due_date
 * @property string $reference
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PaymentDtl[] $paymentDtls
 */
class PaymentMst extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'payment_mst';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['supplier', 'payment_mode', 'paid_amount', 'document_date', 'document_no'], 'required'],
            [['transaction_type', 'supplier', 'payment_mode', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'cheque_due_date', 'DOC', 'DOU'], 'safe'],
            [['due_amount', 'paid_amount'], 'number'],
            [['document_no', 'cheque_no', 'reference'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'transaction_type' => 'Transaction Type',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'supplier' => 'Supplier',
            'due_amount' => 'Due Amount',
            'paid_amount' => 'Paid Amount',
            'payment_mode' => 'Payment Mode',
            'cheque_no' => 'Cheque No',
            'cheque_due_date' => 'Cheque Due Date',
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
    public function getPaymentDtls() {
        return $this->hasMany(PaymentDtl::className(), ['payment_mst_id' => 'id']);
    }

}
