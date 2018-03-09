<?php

namespace backend\modules\hr\controllers;

use Yii;
use common\models\CrewInformation;
use common\models\CrewInformationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CrewInformationDetails;
use yii\web\UploadedFile;
use common\models\CrewCertificateSearch;
use common\models\CrewCertificate;

/**
 * CrewInformationController implements the CRUD actions for CrewInformation model.
 */
class CrewInformationController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CrewInformation models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CrewInformationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CrewInformation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $crew = $this->findModel($id);
        $crew_details = CrewInformationDetails::find()->where(['crew_id' => $id])->one();
        $crew_certificates = CrewCertificate::find()->where(['crew_id' => $id])->all();
        return $this->render('view', [
                    'crew' => $crew,
                    'crew_details' => $crew_details,
                    'crew_certificates' => $crew_certificates,
        ]);
    }

    /**
     * Creates a new CrewInformation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CrewInformation();
        $crew_details = new CrewInformationDetails();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $crew_details->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($crew_details)) {
            $files = UploadedFile::getInstance($model, 'photo');
            if (!empty($files)) {
                $model->photo = $files->extension;
            }
            if ($model->validate() && $crew_details->validate()) {
                if ($model->save()) {
                    $crew_details->crew_id = $model->id;
                    $crew_details->save();
                    $this->Upload($model, $files);
                    Yii::$app->session->setFlash('success', "New Crew Details added Successfully");
                    return $this->redirect(['add', 'id' => $model->id]);
                }
            }
        } return $this->render('create', [
                    'model' => $model,
                    'crew_details' => $crew_details,
        ]);
    }

    /*
     * Add services to appointment
     */

    public function actionAdd($id) {
        $searchModel = new CrewCertificateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['crew_id' => $id]);
        $model = new \common\models\CrewCertificate();
        return $this->render('add', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    '$model' => $model,
                    'id' => $id,
        ]);
    }

    /**
     * Upload Material photos.
     * @return mixed
     */
    public function Upload($model, $files) {
        if (isset($files) && !empty($files)) {
            $files->saveAs(Yii::$app->basePath . '/../uploads/crew_information/profile_picture/' . $model->id . '.' . $files->extension);
        }
        return TRUE;
    }

    /**
     * Updates an existing CrewInformation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $crew_details = CrewInformationDetails::find()->where(['crew_id' => $id])->one();
        $photo_ = $model->photo;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $crew_details->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($crew_details)) {
            $files = UploadedFile::getInstance($model, 'photo');
            if (empty($files)) {
                $model->photo = $photo_;
            } else {
                $model->photo = $files->extension;
            }
            if ($model->validate() && $crew_details->validate()) {
                if ($model->save()) {
                    $crew_details->crew_id = $model->id;
                    $crew_details->save();
                    $this->Upload($model, $files);
                    Yii::$app->session->setFlash('success', "Crew Details Updated Successfully");
                }
            }
        } return $this->render('update', [
                    'model' => $model,
                    'crew_details' => $crew_details,
        ]);
    }

    /**
     * Deletes an existing CrewInformation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CrewInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CrewInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CrewInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new CrewCertificate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateCertificate($id) {
        $model = new CrewCertificate();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstances($model, 'image');
            if ($model->save()) {
                if (!empty($image)) {
                    $root_path = ['crew_information/crew_certificates', $model->id];
                    Yii::$app->UploadFile->UploadSingle($image, $model, $root_path);
                    Yii::$app->session->setFlash('success', "Certificate Added Successfully");
                    return $this->redirect(['add', 'id' => $id]);
                }
            }
        }
        return $this->renderAjax('_form_certificate', [
                    'model' => $model,
                    'id' => $id,
        ]);
    }

    public function actionUpdateCertificate($id) {
        $model = CrewCertificate::findOne($id);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
            $image = UploadedFile::getInstances($model, 'image');
            if ($model->save()) {
                if (!empty($image)) {
                    $root_path = ['crew_information/crew_certificates', $model->id];
                    Yii::$app->UploadFile->UploadSingle($image, $model, $root_path);
                    Yii::$app->session->setFlash('success', "Certificate Added Successfully");
                    return $this->redirect(['add', 'id' => $model->crew_id]);
                }
            }
        }
        return $this->renderAjax('_form_certificate', [
                    'model' => $model,
                    'id' => $model->crew_id,
        ]);
    }

}
