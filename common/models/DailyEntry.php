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
 * @property int $image
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Materials $material0
 * @property Contacts $supplier0
 * @property Contacts $transport0
 * @property Yard $yard
 * @property DailyEntryDetails[] $dailyEntryDetails
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
            [['received_date', 'material', 'supplier', 'transport', 'payment_status', 'yard_id'], 'required'],
            [['received_date', 'DOC', 'DOU'], 'safe'],
            [['material', 'supplier', 'transport', 'payment_status', 'yard_id', 'status', 'CB', 'UB'], 'integer'],
            [['material'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['material' => 'id']],
            [['supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['supplier' => 'id']],
            [['transport'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['transport' => 'id']],
            [['yard_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yard::className(), 'targetAttribute' => ['yard_id' => 'id']],
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
            'transport' => 'Transporter',
            'payment_status' => 'Payment Status',
            'yard_id' => 'Yard ID',
            'image' => 'File Upload',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYard()
    {
        return $this->hasOne(Yard::className(), ['id' => 'yard_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDailyEntryDetails()
    {
        return $this->hasMany(DailyEntryDetails::className(), ['daily_entry_id' => 'id']);
    }
}
