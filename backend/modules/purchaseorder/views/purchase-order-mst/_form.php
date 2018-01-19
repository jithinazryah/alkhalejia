<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Ships;
use kartik\date\DatePicker;
use common\models\Contacts;

/* @var $this yii\web\View */
/* @var $model common\models\PurchaseOrderMst */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-mst-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            $model->date = date('d-M-Y');
            ?>
            <?=
            $form->field($model, 'date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy'
                ]
            ]);
            ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $vessel = ArrayHelper::map(Ships::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'vessel')->dropDownList($vessel, ['prompt' => '--Select--']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'appointment_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $suppliers = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2, 'service' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'attenssion')->dropDownList($suppliers, ['prompt' => '-Choose a Supplier-']) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'invoice_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'eta')->textInput() ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'port')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
        <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
            <?= $form->field($model, 'payment_terms')->textarea(['rows' => 3]) ?>
        </div>
        <div class='col-md-4 col-sm-4 col-xs-12 left_padd'>
            <?= $form->field($model, 'agent_details')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'invoice')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'email_confirmation')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'delivery_note')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
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
