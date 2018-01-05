<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ports".
 *
 * @property int $id
 * @property string $port_name
 * @property string $code
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Ports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port_name'], 'required'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['port_name', 'code'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'port_name' => 'Port Name',
            'code' => 'Code',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
