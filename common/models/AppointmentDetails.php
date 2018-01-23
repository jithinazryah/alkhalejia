<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointment_details".
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $service_id
 * @property int $supplier
 * @property string $unit_price
 * @property int $quantity
 * @property string $total
 * @property int $tax
 * @property string $tax_amount
 * @property string $sub_total
 *
 * @property Appointment $appointment
 * @property Services $service
 */
class AppointmentDetails extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'appointment_details';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['appointment_id', 'service_id', 'supplier'], 'required'],
                        [['appointment_id', 'service_id', 'supplier', 'quantity', 'tax', 'unit'], 'integer'],
                        [['unit_price', 'total', 'tax_amount', 'sub_total'], 'number'],
                        [['description'], 'string'],
                        [['appointment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appointment::className(), 'targetAttribute' => ['appointment_id' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'appointment_id' => 'Appointment ID',
                    'service_id' => 'Service ID',
                    'supplier' => 'Supplier',
                    'unit_price' => 'Unit Price',
                    'quantity' => 'Quantity',
                    'unit' => 'Unit',
                    'total' => 'Total',
                    'tax' => 'Tax',
                    'tax_amount' => 'Tax Amount',
                    'sub_total' => 'Sub Total',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getAppointment() {
                return $this->hasOne(Appointment::className(), ['id' => 'appointment_id']);
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getService() {
                return $this->hasOne(Services::className(), ['id' => 'service_id']);
        }

}
