<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_category".
 *
 * @property int $id
 * @property string $category_name
 * @property string $category_code
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class ServiceCategory extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'service_category';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['category_name', 'category_code'], 'required'],
                        [['description'], 'string'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['category_name', 'category_code'], 'string', 'max' => 200],
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
                    'description' => 'Description',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public static function Category() {
                $data = static::find()->where(['status' => 1])->all();
                $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'category_name');
                return $value;
        }

}
