<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "crew_certificate".
 *
 * @property int $id
 * @property int $crew_id
 * @property int $certificate_id
 * @property string $date_of_issue
 * @property string $date_of_expiry
 * @property string $issuing_authority
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class CrewCertificate extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'crew_certificate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['certificate_id', 'date_of_issue', 'date_of_expiry', 'issuing_authority'], 'required'],
            [['crew_id', 'certificate_id', 'status', 'CB', 'UB'], 'integer'],
            [['date_of_issue', 'date_of_expiry', 'DOC', 'DOU', 'description'], 'safe'],
            [['issuing_authority'], 'string', 'max' => 100],
            [['image'], 'file', 'extensions' => 'pdf,txt,doc,docx,xls,xlsx,msg,zip,eml, jpg, jpeg, png', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'crew_id' => 'Crew ID',
            'certificate_id' => 'Certificate',
            'date_of_issue' => 'Date Of Issue',
            'date_of_expiry' => 'Date Of Expiry',
            'issuing_authority' => 'Issuing Authority',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public function getDocuments($id) {
        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/crew_information/crew_certificates/' . $id;
        $link = '';
        if (count(glob("{$path}/*")) > 0) {
?>
            <?php

            $i = 0;
            foreach (glob("{$path}/*") as $file) {
                $arry = explode('/', $file);
                $img_nmee = end($arry);
                $img_nmees = explode('.', $img_nmee);
                if ($i != 0) {
                    $link .= '<br/>';
                }
                $link .= '<a href="' . Yii::$app->homeUrl . 'uploads/crew_information/crew_certificates/' . $id . '/' . end($arry) . '" target="_blank" style="color: #3F51B5;">' . end($arry) . '</a>';
                $i++;
            }
        }
        return $link;
    }

}
