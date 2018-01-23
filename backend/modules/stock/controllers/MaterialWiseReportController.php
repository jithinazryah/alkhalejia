<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class MaterialWiseReportController extends \yii\web\Controller {

        public function actionIndex() {


                return $this->render('report', [
                ]);
        }

}
