<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "crew_information_details".
 *
 * @property int $id
 * @property string $passport_no
 * @property string $passport_issue_date
 * @property string $passport_expiry_date
 * @property string $passport_issued_by
 * @property string $seaman_book_no
 * @property string $seaman_book_issue_date
 * @property string $seaman_book_expiry_date
 * @property string $seaman_book_issued_by
 * @property string $educational_attainment
 * @property string $panama_endorsement_no
 * @property string $panama_endorsement_issue_date
 * @property string $panama_endorsement_expiry_date
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class CrewInformationDetails extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'crew_information_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['passport_issue_date', 'passport_expiry_date', 'seaman_book_issue_date', 'seaman_book_expiry_date', 'panama_endorsement_issue_date', 'panama_endorsement_expiry_date', 'DOC', 'DOU', 'crew_id'], 'safe'],
            [['status', 'CB', 'UB'], 'integer'],
            [['passport_no', 'seaman_book_no', 'panama_endorsement_no'], 'string', 'max' => 100],
            [['passport_issued_by', 'seaman_book_issued_by', 'educational_attainment'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'passport_no' => 'Passport No',
            'passport_issue_date' => 'Passport Issue Date',
            'passport_expiry_date' => 'Passport Expiry Date',
            'passport_issued_by' => 'Passport Issued By',
            'seaman_book_no' => 'Seaman Book No',
            'seaman_book_issue_date' => 'Seaman Book Issue Date',
            'seaman_book_expiry_date' => 'Seaman Book Expiry Date',
            'seaman_book_issued_by' => 'Seaman Book Issued By',
            'educational_attainment' => 'Educational Attainment',
            'panama_endorsement_no' => 'Panama Endorsement No',
            'panama_endorsement_issue_date' => 'Panama Endorsement Issue Date',
            'panama_endorsement_expiry_date' => 'Panama Endorsement Expiry Date',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
