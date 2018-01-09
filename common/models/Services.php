<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $category
 * @property string $service
 * @property int $supplier_option 1-Yes,2=N0
 * @property string $supplier
 * @property int $unit
 * @property string $unit_rate
 * @property int $tax
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property ServiceCategory $category0
 * @property Tax $tax0
 * @property Units $unit0
 */
class Services extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category', 'service', 'supplier_option'], 'required'],
            [['category', 'supplier_option', 'unit', 'tax', 'status', 'CB', 'UB'], 'integer'],
            [['unit_rate'], 'number'],
            [['description'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['service', 'supplier'], 'string', 'max' => 200],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionCategory::className(), 'targetAttribute' => ['category' => 'id']],
            [['tax'], 'exist', 'skipOnError' => true, 'targetClass' => Tax::className(), 'targetAttribute' => ['tax' => 'id']],
            [['unit'], 'exist', 'skipOnError' => true, 'targetClass' => Units::className(), 'targetAttribute' => ['unit' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'service' => 'Service',
            'supplier_option' => 'Supplier',
            'supplier' => 'Supplier',
            'unit' => 'Unit',
            'unit_rate' => 'Unit Rate',
            'tax' => 'Tax',
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
    public function getCategory0() {
        return $this->hasOne(TransactionCategory::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTax0() {
        return $this->hasOne(Tax::className(), ['id' => 'tax']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit0() {
        return $this->hasOne(Units::className(), ['id' => 'unit']);
    }

}
