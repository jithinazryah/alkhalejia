<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "crew_information".
 *
 * @property int $id
 * @property int $vessel
 * @property int $port
 * @property string $agent
 * @property string $full_name
 * @property string $rank
 * @property string $nationality
 * @property string $date_of_birth
 * @property string $place_of_birth
 * @property string $residential_address
 * @property string $phone_number
 * @property int $marital_status
 * @property string $mothers_name
 * @property string $fathers_name
 * @property string $joining_date
 * @property string $religion
 * @property string $first_language
 * @property string $photo
 * @property int $sex
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class CrewInformation extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'crew_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['vessel', 'port', 'agent', 'sex', 'full_name'], 'required'],
            [['vessel', 'port', 'marital_status', 'sex', 'status', 'CB', 'UB', 'nationality'], 'integer'],
            [['date_of_birth', 'joining_date', 'DOC', 'DOU'], 'safe'],
            [['residential_address'], 'string'],
            [['agent', 'full_name', 'place_of_birth', 'mothers_name', 'fathers_name', 'religion', 'first_language', 'photo'], 'string', 'max' => 100],
            [['rank'], 'string', 'max' => 50],
            [['phone_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'vessel' => 'Vessel',
            'port' => 'Port',
            'agent' => 'Agent',
            'full_name' => 'Full Name',
            'rank' => 'Rank',
            'nationality' => 'Nationality',
            'date_of_birth' => 'Date Of Birth',
            'place_of_birth' => 'Place Of Birth',
            'residential_address' => 'Residential Address',
            'phone_number' => 'Phone Number',
            'marital_status' => 'Marital Status',
            'mothers_name' => 'Mothers Name',
            'fathers_name' => 'Fathers Name',
            'joining_date' => 'Joining Date',
            'religion' => 'Religion',
            'first_language' => 'First Language',
            'photo' => 'Photo',
            'sex' => 'Sex',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
