<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class CrusherReport extends Model {

    public $crusher;
    public $date;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['crusher', 'date'], 'required'],
        ];
    }

}
