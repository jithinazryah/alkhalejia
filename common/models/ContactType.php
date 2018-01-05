<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_type".
 *
 * @property int $id
 * @property string $type
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Contacts[] $contacts
 */
class ContactType extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'contact_type';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type'], 'required'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['type'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
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
                return $this->hasMany(Contacts::className(), ['type' => 'id']);
        }

        public static function Types() {
                $data = static::find()->where(['status' => 1])->all();
                $value = (count($data) == 0) ? ['' => ''] : \yii\helpers\ArrayHelper::map($data, 'id', 'type');
                return $value;
        }

}
