<?php

namespace backend\modules\reports\controllers;

use Yii;
use common\models\CrusherReport;

class CrusherReportController extends \yii\web\Controller {

    public function actionIndex() {
        $model = new CrusherReport();
        $start_date = '';
        $end_date = '';
        $transport = '';
        $numberDays = '';
        $model->date = '';
        $list = array();
        if ($model->load(Yii::$app->request->post())) {
            $crusher = $model->crusher;
            $dateArray = explode('-', $model->date);
            $month = $dateArray[0];
            $year = $dateArray[1];
            $numberDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $start_date = $year . '-' . $month . '-' . 1;
            $end_date = $year . '-' . $month . '-' . $numberDays;
            for ($d = 1; $d <= $numberDays; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month)
                    $list[] = date('Y-m-d', $time);
            }
//            $report = \common\models\DailyEntryDetails::find()->where(['>=', 'received_date', $start_date . ' 00:00:00'])->andWhere(['<=', 'received_date', $end_date . ' 60:60:60'])->andWhere(['transport' => $transport])->all();
        }
        return $this->render('index', [
                    'model' => $model,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'crusher' => $crusher,
                    'numberDays' => $numberDays,
                    'list' => $list,
                    'dates' => $model->date,
        ]);
    }

    public function actionExports() {
        $start_date = '';
        $end_date = '';
        $transport = '';
        $numberDays = '';
        $list = array();
        $test = '';
        if (Yii::$app->request->post()) {
            $crusher = Yii::$app->request->post('crusher');
            $dateArray = explode('-', Yii::$app->request->post('month_year'));
            $month = $dateArray[0];
            $year = $dateArray[1];
            $numberDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $start_date = $year . '-' . $month . '-' . 1;
            $end_date = $year . '-' . $month . '-' . $numberDays;
            for ($d = 1; $d <= $numberDays; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month)
                    $list[] = date('Y-m-d', $time);
            }
            $test = $this->renderPartial('report_xls', [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'crusher' => $crusher,
                'numberDays' => $numberDays,
                'list' => $list,
            ]);
            $file = "crusher-report.xls";
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$file");
            return $test;
        }
    }

}
