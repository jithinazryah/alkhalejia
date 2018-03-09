<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\CertificateType;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\CrewCertificate */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create Crew Certificate';
$this->params['breadcrumbs'][] = ['label' => 'Crew Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body">
                    <div class="crew-certificate-create">
                        <div class="crew-certificate-form form-inline">

                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <div class="row">
                                <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
                                    <input type="hidden" id="crewcertificate-crew_id" class="form-control" name="CrewCertificate[crew_id]" value="<?= $id ?>" aria-invalid="false">
                                    <?php $certificates = ArrayHelper::map(CertificateType::findAll(['status' => 1]), 'id', 'certificate_name'); ?>
                                    <?= $form->field($model, 'certificate_id')->dropDownList($certificates, ['prompt' => '--Select Certificate--']) ?>

                                </div>
                                <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
                                    <?php
                                    if ($model->isNewRecord) {
                                        $model->date_of_issue = date('Y-m-d');
                                    }
                                    ?>
                                    <?=
                                    $form->field($model, 'date_of_issue')->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                    ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                    <?php
                                    if ($model->isNewRecord) {
                                        $model->date_of_expiry = date('Y-m-d');
                                    }
                                    ?>
                                    <?=
                                    $form->field($model, 'date_of_expiry')->widget(DatePicker::classname(), [
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                    ?>
                                </div>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'issuing_authority')->textInput(['maxlength' => true]) ?>

                                </div>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                    <?= $form->field($model, 'image[]')->fileInput(['multiple' => TRUE]) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    <div class="form-group">
                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
