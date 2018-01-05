<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $size
 * @property int $tax
 * @property int $unit
 * @property string $purchase_price
 * @property string $selling_price
 * @property string $image
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Tax $tax0
 * @property Units $unit0
 * @property Purchase[] $purchases
 * @property Stock[] $stocks
 */
class Materials extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'materials';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'code', 'size', 'tax', 'unit', 'purchase_price', 'selling_price'], 'required'],
            [['tax', 'unit', 'status', 'CB', 'UB'], 'integer'],
            [['purchase_price', 'selling_price'], 'number'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['description'], 'string'],
            [['DOC', 'DOU', 'image'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['code', 'size'], 'string', 'max' => 20],
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
            'name' => 'Name',
            'code' => 'Code',
            'size' => 'Size',
            'tax' => 'Tax',
            'unit' => 'Unit',
            'purchase_price' => 'Purchase Price',
            'selling_price' => 'Selling Price',
            'image' => 'Image',
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
    public function getTax0() {
        return $this->hasOne(Tax::className(), ['id' => 'tax']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit0() {
        return $this->hasOne(Units::className(), ['id' => 'unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases() {
        return $this->hasMany(Purchase::className(), ['material' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks() {
        return $this->hasMany(Stock::className(), ['material_id' => 'id']);
    }

}
