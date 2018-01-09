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
                        <?php $transports = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 3]), 'id', 'name'); ?>
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

        </div>
        <hr/>
        <div id = "p_attach">
                <input type = "hidden" id = "delete_port_vals" name = "delete_port_vals" value = "">


                <span>
                        <div class="row daily-entry-span">
                                <!--                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                                                    <label class = "control-label"></label>
                                                    <label class = "control-label">1</label>
                                                </div>-->
                                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd' style="width: 5%;">
                                        <div class = "form-group field-staffperviousemployer-hospital_address">
                                                <h4 class="serial_no" style="margin-top: 32px;">1.</h4>
                                        </div>
                                </div>
                                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                                        <div class = "form-group field-staffperviousemployer-hospital_address">
                                                <label class = "control-label">Ticket No.</label>
                                                <?= $form->field($model_details, 'ticket_no[]')->textInput()->label(FALSE) ?>

                                        </div>
                                </div>
                                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Truck No.</label>
                                                <?= $form->field($model_details, 'truck_number[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>
                                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Net Weight</label>
                                                <?= $form->field($model_details, 'net_weight[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>
                                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Rate</label>
                                                <?= $form->field($model_details, 'rate[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>

                                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Total</label>
                                                <?= $form->field($model_details, 'total[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>

                                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Transporter Amount</label>
                                                <?= $form->field($model_details, 'transport_amount[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>



                                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                                        <div class="form-group field-staffperviousemployer-designation">
                                                <label class="control-label" for="">Description</label>
                                                <?= $form->field($model_details, 'description[]')->textInput()->label(FALSE) ?>
                                        </div>
                                </div>
                        </div>
                        <div style="clear:both"></div>
                </span>

        </div>
        <div class="row">
                <div class="col-md-12">
                        <a id="addAttach" title="Add More Attachment" last_sl="1" class="btn btn-blue btn-icon btn-icon-standalone addAttach" style="float:right;margin-right: 15px;"><i class="fa-plus"></i></a>
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
        $("document").ready(function () {
                var scntDiv = $('#p_attach');
                var i = $('#p_attach span').size() + 1;

                $('#addAttach').on('click', function () {
                        var srl = $('#addAttach').attr('last_sl');
//            parseFloat(total) + parseFloat(price);
                        var newsrl = parseInt(srl) + 1;
                        $('#addAttach').attr('last_sl', newsrl);
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {srl: newsrl},
                                url: '<?= Yii::$app->homeUrl; ?>purchase/daily-entry/attachment',
                                success: function (data) {
                                        $(data).appendTo(scntDiv);
                                        i++;
                                        return false;

                                }
                        });


                });
                $('#p_attach').on('click', '.remAttach', function () {
                        if (i > 2) {
                                $(this).parents('span').remove();
                                i--;
                        }
                        if (this.hasAttribute("val")) {
                                var valu = $(this).attr('val');
                                $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                                var value = $('#delete_port_vals').val();
                        }
                        return false;
                });
        });
</script>
