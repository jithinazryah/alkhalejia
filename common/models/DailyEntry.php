<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "daily_entry".
 *
 * @property int $id
 * @property string $received_date
 * @property int $material
 * @property int $supplier
 * @property int $transport
 * @property int $payment_status
 * @property int $yard_id
 * @property string $ticket_no
 * @property string $truck_number
 * @property string $gross_weight
 * @property string $tare_weight
 * @property string $net_weight
 * @property string $rate
 * @property string $total
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Materials $material0
 * @property Contacts $supplier0
 * @property Contacts $transport0
 */
class DailyEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daily_entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['received_date', 'DOC', 'DOU'], 'safe'],
            [['material', 'supplier', 'transport', 'payment_status', 'yard_id', 'status', 'CB', 'UB'], 'integer'],
            [['rate', 'total'], 'number'],
            [['description'], 'string'],
            [['ticket_no'], 'string', 'max' => 20],
            [['truck_number', 'gross_weight', 'tare_weight', 'net_weight'], 'string', 'max' => 255],
            [['material'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['material' => 'id']],
            [['supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['supplier' => 'id']],
            [['transport'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['transport' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'received_date' => 'Received Date',
            'material' => 'Material',
            'supplier' => 'Supplier',
            'transport' => 'Transport',
            'payment_status' => 'Payment Status',
            'yard_id' => 'Yard ID',
            'ticket_no' => 'Ticket No',
            'truck_number' => 'Truck Number',
            'gross_weight' => 'Gross Weight',
            'tare_weight' => 'Tare Weight',
            'net_weight' => 'Net Weight',
            'rate' => 'Rate',
            'total' => 'Total',
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
    public function getMaterial0()
    {
        return $this->hasOne(Materials::className(), ['id' => 'material']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier0()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'supplier']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransport0()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'transport']);
    }
}
