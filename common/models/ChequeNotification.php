<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cheque_notification".
 *
 * @property int $id
 * @property int $payment_id
 * @property string $cheque_no
 * @property string $cheque_due_date
 * @property string $cheque_amount
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class ChequeNotification extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cheque_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['payment_id', 'status', 'CB', 'UB', 'type'], 'integer'],
            [['cheque_due_date', 'DOC', 'DOU'], 'safe'],
            [['cheque_amount'], 'number'],
            [['cheque_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'cheque_no' => 'Cheque No',
            'cheque_due_date' => 'Cheque Due Date',
            'cheque_amount' => 'Cheque Amount',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
