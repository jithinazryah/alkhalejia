<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $tax_id
 * @property int $type 1=customer,2=supplier,3=transporter
 * @property int $category
 * @property string $phone
 * @property string $service
 * @property string $email
 * @property string $address
 * @property string $city
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property ContactType $type0
 * @property SupplierCategory $category0
 * @property Purchase[] $purchases
 * @property Purchase[] $purchases0
 */
class Contacts extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'code', 'type', 'phone', 'email', 'service'], 'required'],
            [['type', 'status', 'CB', 'UB', 'service'], 'integer'],
            [['address', 'description'], 'string'],
            [['email'], 'email'],
            [['DOC', 'DOU'], 'safe'],
            [['name', 'tax_id'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 20],
            [['email', 'city'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 15],
            [['phone'], 'match', 'pattern' => '/^[0-9]+$/'],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => ContactType::className(), 'targetAttribute' => ['type' => 'id']],
//            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierCategory::className(), 'targetAttribute' => ['category' => 'id']],
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
            'tax_id' => 'VAT ID',
            'type' => 'Type',
//            'category' => 'Category',
            'phone' => 'Phone',
            'service' => 'Service',
            'email' => 'Email',
            'address' => 'Address',
            'city' => 'City',
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
    public function getType0() {
        return $this->hasOne(ContactType::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0() {
        return $this->hasOne(SupplierCategory::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases() {
        return $this->hasMany(Purchase::className(), ['supplier' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases0() {
        return $this->hasMany(Purchase::className(), ['transport' => 'id']);
    }

}
