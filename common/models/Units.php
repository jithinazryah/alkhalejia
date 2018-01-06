<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "units".
 *
 * @property int $id
 * @property string $unit_name
 * @property string $unit_symbol
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Units extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'units';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['unit_name', 'unit_symbol'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['unit_name', 'unit_symbol'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'unit_name' => 'Unit Name',
                    'unit_symbol' => 'Unit Symbol',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public static function Units() {
                $data = static::find()->where(['status' => 1])->all();
                $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'unit_name');
                return $value;
        }

}
