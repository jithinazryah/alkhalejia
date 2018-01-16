<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Materials;
use common\models\Contacts;
use common\models\Yard;
use yii\web\UploadedFile;

/* @var $this yii\web\View */
/* @var $model common\models\DailyEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daily-entry-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'received_date')->widget(DateTimePicker::classname(), [
                'type' => DateTimePicker::TYPE_INPUT,
                'value' => '23-Feb-1982 10:10',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy hh:ii'
                ]
            ])
            ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $materials = ArrayHelper::map(Materials::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'material')->dropDownList($materials, ['prompt' => '-Choose a Material-']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $suppliers = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2]), 'id', 'name'); ?>
            <?= $form->field($model, 'supplier')->dropDownList($suppliers, ['prompt' => '-Choose a Supplier-']) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            $transports = array();
            $services = \common\models\Services::find()->select(['id'])->where(['category' => 2])->asArray()->all();
            if (!empty($services)) {
                foreach ($services as $service) {
                    $service_[] = $service['id'];
                }
//            print_r($service_);exit;
//            $transports = Contacts::find()->where(['in', 'service', $service_])->all();
                $transports = ArrayHelper::map(Contacts::find()->where(['in', 'service', $service_])->all(), 'id', 'name');
            }
            ?>

            <?= $form->field($model, 'transport')->dropDownList($transports, ['prompt' => '-Choose a Transport-']) ?>
        </div>
    </div>
    <div class="row">

        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'payment_status')->dropDownList(['1' => 'Due', '2' => 'Paid']) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $yards = ArrayHelper::map(Yard::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'yard_id')->dropDownList($yards, ['prompt' => '-Choose a Yard-']) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'image')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12' >
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
