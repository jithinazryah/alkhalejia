<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Ships;
use kartik\date\DatePicker;
use common\models\Contacts;
Use common\models\Ports;

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
            <?php
            $model->eta = date('d-M-Y');
            ?>
            <?=
            $form->field($model, 'eta')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy'
                ]
            ]);
            ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $ports = ArrayHelper::map(Ports::findAll(['status' => 1]), 'id', 'port_name'); ?>
            <?= $form->field($model, 'port')->dropDownList($ports, ['prompt' => '--Select--']) ?>
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
            <?= $form->field($model, 'invoice')->fileInput() ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'email_confirmation')->fileInput() ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'delivery_note')->fileInput() ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>
        </div>
    </div>
    <hr class="appoint_history" />
    <div class="row">
        <div class = 'col-md-4'>
            <div class = "form-group field-staffperviousemployer-hospital_address">
                <label class="control-label port-assign_to" for="">Label</label>
            </div>
        </div>
        <div class = 'col-md-7'>
            <div class = "form-group field-staffperviousemployer-hospital_address">
                <label class="control-label port-assign_to" for="">Value</label></div>
        </div>
    </div>
    <div id="p_scents">
        <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">
        <?php
        if (!empty($model_additional)) {

            foreach ($model_additional as $data) {
                ?>
                <span>
                    <div class="row">
                        <div class = 'col-md-4'>
                            <div class = "form-group field-staffperviousemployer-hospital_address">
                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                            </div>
                        </div>
                        <div class = 'col-md-7'>
                            <div class = "form-group field-staffperviousemployer-hospital_address">
                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][value][]" value="<?= $data->value; ?>" required>
                            </div>
                        </div>
                        <div class = 'col-md-1'>
                            <div class = "form-group field-staffperviousemployer-hospital_address">
                                <a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" style="padding: 4px 12px;float:right;margin-right: 25px;"><i class="fa-remove"></i></a>
                            </div>
                        </div>
                    </div>
                </span>
                <?php
            }
        }
        ?>
        <span>
            <div class="row">
                <div class = "col-md-4">
                    <div class = "form-group field-staffperviousemployer-hospital_address">
                        <input type="text" class="form-control" name="create[label][]">
                    </div>
                </div>
                <div class = "col-md-7">
                    <div class = "form-group field-staffperviousemployer-hospital_address">
                        <input type="text" class="form-control" name="create[valuee][]">
                    </div>
                </div>
            </div>
        </span>
    </div>
    <div class="row">
        <div class = "col-md-12">
            <div class = "form-group field-staffperviousemployer-hospital_address">
                <a id="addScnt" class="btn btn-icon btn-blue addScnt" style="float:right;margin-right: 25px;"><i class="fa-plus"></i></a>
            </div>
        </div>
    </div>
    <hr class="appoint_history" />
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script>
    $(document).ready(function () {
        $('#purchaseordermst-attenssion').on('change', function () {
            $.ajax({
                type: 'POST',
                cache: false,
                data: {id: $(this).val()},
                url: '<?= Yii::$app->homeUrl; ?>purchaseorder/purchase-order-mst/supplier-address',
                success: function (data) {
                    $('#purchaseordermst-address').val(data);
                }
            });


        });

        /*
         * Add more bnutton function
         */
        var scntDiv = $('#p_scents');
        var i = $('#p_scents span').size() + 1;
        $('#addScnt').on('click', function () {
            var ver = '<span>\n\
            <div class="row"><div class = "col-md-4">\n\
                <div class = "form-group field-staffperviousemployer-hospital_address">\n\
                    <input type="text" class="form-control" name="create[label][]">\n\
                </div>\n\
            </div>\n\
            <div class = "col-md-7">\n\
                <div class = "form-group field-staffperviousemployer-hospital_address">\n\
                    <input type="text" class="form-control" name="create[valuee][]">\n\
                </div>\n\
            </div>\n\
            <div class = "col-md-1">\n\
                <div class = "form-group field-staffperviousemployer-hospital_address">\n\
                    <a id="remScnt" class="btn btn-icon btn-red remScnt" style="padding: 4px 12px;float:right;margin-right: 25px;"><i class="fa-remove"></i></a>\n\
                </div>\n\
            </div></div>\n\
        </span>';
            $(ver).appendTo(scntDiv);
            i++;
            return false;
        });
        $('#p_scents').on('click', '.remScnt', function () {
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
