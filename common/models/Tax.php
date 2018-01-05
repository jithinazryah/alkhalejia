<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tax".
 *
 * @property int $id
 * @property string $tax
 * @property int $value
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property Materials[] $materials
 */
class Tax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['tax'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Materials::className(), ['tax' => 'id']);
    }
}
