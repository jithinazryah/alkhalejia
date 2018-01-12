<?php

namespace backend\modules\stock\controllers;

use Yii;
use common\models\StockSearch;

class DailyWiseReportController extends \yii\web\Controller {

    public function actionIndex() {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->groupBy('material_id')->all();
//        var_dump(Yii::$app->request->queryParams['StockSearch']);exit;
//        echo $_GET['StockSearch']['DOC'];exit;
        if (isset($_GET['StockSearch']['DOC'])) {
            $date= date('Y=m-d', strtotime($_GET['StockSearch']['DOC']));
            $dataProvider->query->where(['DOC' => $date]);
        }

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOrderReport() {
        
    }

}
