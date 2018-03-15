<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class TransporterReport extends Model {

    public $transporter;
    public $date;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['transporter', 'date'], 'required'],
        ];
    }

}
