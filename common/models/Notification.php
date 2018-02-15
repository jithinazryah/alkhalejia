<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int $notification_type 1-appointment 2-daily entry,3-Purchase Order
 * @property int $table_id
 * @property string $content
 * @property string $message
 * @property string $cheque_no
 * @property string $due_date
 * @property int $status '1=>'Open','2'=>'Ignore','3'=>'close'
 * @property string $date
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_type', 'table_id', 'status'], 'integer'],
            [['content', 'message'], 'string'],
            [['due_date', 'date'], 'safe'],
            [['cheque_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_type' => 'Notification Type',
            'table_id' => 'Table ID',
            'content' => 'Content',
            'message' => 'Message',
            'cheque_no' => 'Cheque No',
            'due_date' => 'Due Date',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
