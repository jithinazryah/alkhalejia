<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "serial_numbers".
 *
 * @property int $id
 * @property int $transaction
 * @property string $prefix
 * @property int $sequence_no
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class SerialNumbers extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'serial_numbers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transaction', 'sequence_no', 'prefix'], 'required'],
            [['transaction', 'sequence_no', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['prefix'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'transaction' => 'Transaction',
            'prefix' => 'Prefix',
            'sequence_no' => 'Sequence No',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
