<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yard".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $capacity
 * @property string $field_1
 * @property string $field_2
 * @property string $description
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Stock[] $stocks
 */
class Yard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['name', 'code', 'field_1', 'field_2'], 'string', 'max' => 200],
            [['capacity'], 'string', 'max' => 20],
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
            'code' => 'Code',
            'capacity' => 'Capacity',
            'field_1' => 'Field 1',
            'field_2' => 'Field 2',
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
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['yard_id' => 'id']);
    }
}
