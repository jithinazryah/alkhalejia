<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "daily_entry_details".
 *
 * @property int $id
 * @property int $daily_entry_id
 * @property string $ticket_no
 * @property string $truck_number
 * @property string $gross_weight
 * @property string $tare_weight
 * @property string $net_weight
 * @property string $rate
 * @property string $total
 * @property string $description
 * @property string $transport_amount
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property DailyEntry $dailyEntry
 */
class DailyEntryDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'daily_entry_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['daily_entry_id', 'ticket_no', 'truck_number', 'gross_weight', 'tare_weight', 'net_weight', 'rate', 'total', 'transport_amount'], 'required'],
            [['daily_entry_id', 'status', 'CB', 'UB'], 'integer'],
            [['rate', 'total', 'transport_amount'], 'number'],
            [['description'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['ticket_no'], 'string', 'max' => 20],
            [['truck_number', 'gross_weight', 'tare_weight', 'net_weight'], 'string', 'max' => 255],
            [['daily_entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => DailyEntry::className(), 'targetAttribute' => ['daily_entry_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'daily_entry_id' => 'Daily Entry ID',
            'ticket_no' => 'Ticket No',
            'truck_number' => 'Truck Number',
            'gross_weight' => 'Gross Weight',
            'tare_weight' => 'Tare Weight',
            'net_weight' => 'Net Weight',
            'rate' => 'Rate',
            'total' => 'Total',
            'description' => 'Description',
            'transport_amount' => 'Transport Amount',
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
    public function getDailyEntry() {
        return $this->hasOne(DailyEntry::className(), ['id' => 'daily_entry_id']);
    }

}
