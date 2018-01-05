<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "supplier_category".
 *
 * @property int $id
 * @property string $category_name
 * @property string $category_code
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Contacts[] $contacts
 */
class SupplierCategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'supplier_category';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category_name'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['category_name'], 'string', 'max' => 200],
                        [['category_code'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'category_name' => 'Category Name',
                    'category_code' => 'Category Code',
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
        public function getContacts() {
                return $this->hasMany(Contacts::className(), ['category' => 'id']);
        }

        public static function Category() {
                $data = static::find()->where(['status' => 1])->all();
                $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'category_name');
                return $value;
        }

}
