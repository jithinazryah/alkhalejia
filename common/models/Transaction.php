<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $transaction_category
 * @property string $transaction_id
 * @property string $transaction_date
 * @property int $financial_year
 * @property int $supplier_id
 * @property string $supplier_name
 * @property string $supplier_code
 * @property string $credit_amount
 * @property string $debit_amount
 * @property string $balance_amount
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property FinancialYears $financialYear
 * @property TransactionCategory $transactionCategory
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_category', 'financial_year', 'supplier_id', 'status', 'CB', 'UB'], 'integer'],
            [['transaction_id'], 'required'],
            [['transaction_date', 'DOC', 'DOU'], 'safe'],
            [['credit_amount', 'debit_amount', 'balance_amount'], 'number'],
            [['transaction_id'], 'string', 'max' => 500],
            [['supplier_name', 'supplier_code'], 'string', 'max' => 100],
            [['financial_year'], 'exist', 'skipOnError' => true, 'targetClass' => FinancialYears::className(), 'targetAttribute' => ['financial_year' => 'id']],
            [['transaction_category'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionCategory::className(), 'targetAttribute' => ['transaction_category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaction_category' => 'Transaction Category',
            'transaction_id' => 'Transaction ID',
            'transaction_date' => 'Transaction Date',
            'financial_year' => 'Financial Year',
            'supplier_id' => 'Supplier ID',
            'supplier_name' => 'Supplier Name',
            'supplier_code' => 'Supplier Code',
            'credit_amount' => 'Credit Amount',
            'debit_amount' => 'Debit Amount',
            'balance_amount' => 'Balance Amount',
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
    public function getFinancialYear()
    {
        return $this->hasOne(FinancialYears::className(), ['id' => 'financial_year']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionCategory()
    {
        return $this->hasOne(TransactionCategory::className(), ['id' => 'transaction_category']);
    }
}
