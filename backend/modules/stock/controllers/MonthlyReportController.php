<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class MonthlyReportController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->groupBy('material_id')->all();
        if (isset($_GET['StockSearch']['DOC'])) {
//            $date = date('Y-m', strtotime($_GET['StockSearch']['DOC']));
            $date1= $_GET['StockSearch']['DOC'].'-01';
            $date2= $_GET['StockSearch']['DOC'].'-31';
            $dataProvider->query->where(['between', 'DOC', $date1, $date2]);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
