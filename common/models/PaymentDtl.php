<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_dtl".
 *
 * @property int $id
 * @property int $payment_mst_id
 * @property int $transaction_id
 * @property string $document_no
 * @property string $document_date
 * @property string $total_amount
 * @property string $due_amount
 * @property string $paid_amount
 * @property string $reference
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property PaymentMst $paymentMst
 */
class PaymentDtl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_dtl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_mst_id', 'transaction_id', 'status', 'CB', 'UB'], 'integer'],
            [['document_date', 'DOC', 'DOU'], 'safe'],
            [['total_amount', 'due_amount', 'paid_amount'], 'number'],
            [['CB', 'UB'], 'required'],
            [['document_no', 'reference'], 'string', 'max' => 100],
            [['payment_mst_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMst::className(), 'targetAttribute' => ['payment_mst_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_mst_id' => 'Payment Mst ID',
            'transaction_id' => 'Transaction ID',
            'document_no' => 'Document No',
            'document_date' => 'Document Date',
            'total_amount' => 'Total Amount',
            'due_amount' => 'Due Amount',
            'paid_amount' => 'Paid Amount',
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
    public function getPaymentMst()
    {
        return $this->hasOne(PaymentMst::className(), ['id' => 'payment_mst_id']);
    }
}
