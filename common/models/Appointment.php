<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointment".
 *
 * @property int $id
 * @property int $vessel
 * @property string $appointment_number
 * @property string $date
 * @property string $port_of_call
 * @property string $terminal
 * @property string $berth_number
 * @property int $material
 * @property int $quantity
 * @property string $eta
 * @property string $description
 * @property int $status
 * @property int $image
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Appointment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'appointment';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['vessel', 'appointment_number', 'date', 'material'], 'required'],
            [['vessel', 'material', 'quantity', 'status', 'CB', 'UB'], 'integer'],
            [['date', 'eta', 'DOC', 'DOU'], 'safe'],
            [['description'], 'string'],
            [['appointment_number', 'port_of_call', 'terminal', 'berth_number'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'vessel' => 'Vessel Name',
            'appointment_number' => 'Voyage  Number',
            'date' => 'Date',
            'port_of_call' => 'Port Of Call',
            'terminal' => 'Terminal',
            'berth_number' => 'Berth Number',
            'material' => 'Material',
            'quantity' => 'Quantity',
            'eta' => 'ETA',
            'description' => 'Description',
            'status' => 'Status',
            'image' => 'Choose files to upload',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
