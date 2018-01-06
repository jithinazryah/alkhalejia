<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tax".
 *
 * @property int $id
 * @property string $tax
 * @property string $value
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Tax extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'tax';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['tax', 'value'], 'required'],
                        [['status', 'value','CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['tax'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'tax' => 'Tax',
                    'value' => 'Value',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

        public static function Tax() {
                $data = static::find()->where(['status' => 1])->all();
                $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'tax');
                return $value;
        }

}
