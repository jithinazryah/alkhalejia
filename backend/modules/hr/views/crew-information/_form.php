<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Ships;
use common\models\Ports;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\CrewInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="crew-information-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <?= \common\widgets\Alert::widget(); ?>
    <h4 class="crew-sub-head">Personal Information</h4>
    <hr/>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $vessel = ArrayHelper::map(Ships::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'vessel')->dropDownList($vessel, ['prompt' => '--Select--']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $ports = ArrayHelper::map(Ports::findAll(['status' => 1]), 'id', 'port_name'); ?>
            <?= $form->field($model, 'port')->dropDownList($ports, ['prompt' => '--Select--']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'agent')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'rank')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($model->isNewRecord) {
                $model->date_of_birth = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'place_of_birth')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'residential_address')->textarea(['rows' => 2]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($model->isNewRecord) {
                $model->joining_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($model, 'joining_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'marital_status')->dropDownList(['1' => 'Married', '2' => 'Single', '3' => 'Divorced'], ['prompt' => '- Select -']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'mothers_name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'fathers_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'first_language')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'sex')->dropDownList(['1' => 'Male', '2' => 'Female'], ['prompt' => '- Select -']) ?>

        </div>
    </div>
    <h4 class="crew-sub-head">Passport Details</h4>
    <hr/>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'passport_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($crew_details->isNewRecord) {
                $crew_details->passport_issue_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($crew_details, 'passport_issue_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($crew_details->isNewRecord) {
                $crew_details->passport_expiry_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($crew_details, 'passport_expiry_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'passport_issued_by')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <h4 class="crew-sub-head">Seaman Book Details</h4>
    <hr/>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'seaman_book_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($crew_details->isNewRecord) {
                $crew_details->seaman_book_issue_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($crew_details, 'seaman_book_issue_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($crew_details->isNewRecord) {
                $crew_details->seaman_book_expiry_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($crew_details, 'seaman_book_expiry_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'seaman_book_issued_by')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <hr/>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'educational_attainment')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($crew_details, 'panama_endorsement_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($crew_details->isNewRecord) {
                $crew_details->panama_endorsement_expiry_date = date('Y-m-d');
            }
            ?>
            <?=
            $form->field($crew_details, 'panama_endorsement_expiry_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'photo')->fileInput() ?>
            <?php
            if ($model->photo != '') {
                $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/crew_information/profile_picture/' . $model->id . '.' . $model->photo;
                if (file_exists($dirPath)) {
                    $img = '<img width="120px" src="' . Yii::$app->homeUrl . '/uploads/crew_information/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                    echo $img;
                }
            }
            ?>
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
