<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_mode".
 *
 * @property int $id
 * @property string $payment_mode
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class PaymentMode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_mode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['payment_mode'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_mode' => 'Payment Mode',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
