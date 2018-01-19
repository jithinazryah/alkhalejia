<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "material_use".
 *
 * @property int $id
 * @property int $appointment_id
 * @property int $material_id
 * @property string $quantity
 * @property string $sell_date
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Appointment $appointment
 */
class MaterialUse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_use';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appointment_id'], 'required'],
            [['appointment_id', 'material_id', 'CB', 'UB'], 'integer'],
            [['quantity'], 'number'],
            [['sell_date', 'DOC', 'DOU'], 'safe'],
            [['appointment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Appointment::className(), 'targetAttribute' => ['appointment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'appointment_id' => 'Appointment ID',
            'material_id' => 'Material ID',
            'quantity' => 'Quantity',
            'sell_date' => 'Sell Date',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppointment()
    {
        return $this->hasOne(Appointment::className(), ['id' => 'appointment_id']);
    }
}
