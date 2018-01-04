<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property int $post_id
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property AdminPost $post
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'user_name', 'password', 'CB', 'UB'], 'required'],
            [['post_id', 'status', 'CB', 'UB'], 'integer'],
            [['address'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['user_name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 300],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminPost::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'user_name' => 'User Name',
            'password' => 'Password',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
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
    public function getPost()
    {
        return $this->hasOne(AdminPost::className(), ['id' => 'post_id']);
    }
}
