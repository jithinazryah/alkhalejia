<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_details".
 *
 * @property int $id
 * @property string $account_name
 * @property string $account_no
 * @property string $bank_name
 * @property string $branch
 * @property string $iban_no
 * @property string $swift_code
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class BankDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'bank_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['account_name', 'account_no', 'bank_name', 'branch', 'iban_no', 'swift_code'], 'required'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['account_name', 'account_no', 'bank_name', 'branch', 'iban_no', 'swift_code'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'account_name' => 'Account Name',
            'account_no' => 'Account No',
            'bank_name' => 'Bank Name',
            'branch' => 'Branch',
            'iban_no' => 'Iban No',
            'swift_code' => 'Swift Code',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
