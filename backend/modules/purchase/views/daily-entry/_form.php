<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use common\models\Materials;
use common\models\Contacts;
use common\models\Yard;
use yii\web\UploadedFile;
use yii\helpers\Url;
use common\components\ModalViewWidget;

/* @var $this yii\web\View */
/* @var $model common\models\DailyEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daily-entry-form form-inline">
    <?php
    echo ModalViewWidget::widget();
    ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if ($model->isNewRecord) {
                $model->received_date = date('d-M-Y h:i');
            }
            ?>
            <?=
            $form->field($model, 'received_date')->widget(DateTimePicker::classname(), [
                'type' => DateTimePicker::TYPE_INPUT,
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
            <?php $suppliers = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2, 'service' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'supplier')->dropDownList($suppliers, ['prompt' => '-Choose a Supplier-']) ?>
            <?= Html::button('<span> Add Supplier</span>', ['value' => Url::to('supplier'), 'class' => 'btn btn-icon btn-white extra_btn supplier_add modalButton', 'tabindex' => "-1"]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $transports = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 3, 'service' => 2]), 'id', 'name'); ?>
            <?= $form->field($model, 'transport')->dropDownList($transports, ['prompt' => '-Choose a Transporter-']) ?>
            <?= Html::button('<span> Add Transporter</span>', ['value' => Url::to('transporter'), 'class' => 'btn btn-icon btn-white extra_btn supplier_add modalButton', 'tabindex' => "-1"]) ?>
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
<script>
    $(document).on('click', '.modalButton', function () {
        $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr("value"));

    });
//    $("#w0 input:text, #formId textarea").first().focus();
</script>

