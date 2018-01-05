<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ships".
 *
 * @property int $id
 * @property string $name
 * @property string $registration_number
 * @property string $length
 * @property string $capacity
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Ships extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ships';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'registration_number', 'length', 'capacity'], 'required'],
            [['description'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['registration_number', 'length', 'capacity'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'registration_number' => 'Registration Number',
            'length' => 'Length',
            'capacity' => 'Capacity',
            'description' => 'Description',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
