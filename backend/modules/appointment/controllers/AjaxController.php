<?php

namespace backend\modules\appointment\controllers;

use Yii;
use yii\widgets\ActiveForm;
use yii\web\Response;
use common\models\Ships;

class AjaxController extends \yii\web\Controller {

    /**
     * Creates a new Vessel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddVessel() {
        $model = new Ships();

        if (Yii::$app->request->post()) {
            $model->name = Yii::$app->request->post()['name'];
            $model->code = Yii::$app->request->post()['code'];
            $model->registration_number = Yii::$app->request->post()['reg_no'];
            $model->length = Yii::$app->request->post()['ship_length'];
            $model->capacity = Yii::$app->request->post()['capacity'];
            $model->status = Yii::$app->request->post()['status'];
            $model->description = Yii::$app->request->post()['description'];
            Yii::$app->SetValues->Attributes($model);
            if ($model->validate() && $model->save()) {
                echo json_encode(array("con" => "1", 'id' => $model->id, 'name' => $model->name)); //Success
                exit;
            } else {
                $array = $model->getErrors();
                $error = isset($array['name']['0']) ? $array['name']['0'] : 'Internal error';
                echo json_encode(array("con" => "2", 'error' => $error));
                exit;
            }
        }
        return $this->renderAjax('create-vessel', [
                    'model' => $model,
        ]);
    }

}
