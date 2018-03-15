<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int $notification_type 1->payment,2->passport,3->seaman,4->panama,5->certificate
 * @property int $table_id
 * @property string $content
 * @property string $message
 * @property int $status 1=>open.2=>closed
 * @property int $sort_order
 * @property string $expiry_date
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_type'], 'required'],
            [['notification_type', 'table_id', 'status', 'sort_order'], 'integer'],
            [['content', 'message'], 'string'],
            [['expiry_date'], 'safe'],
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
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'expiry_date' => 'Expiry Date',
        ];
    }
}
