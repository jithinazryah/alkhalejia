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
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?php $materials = ArrayHelper::map(Materials::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'material')->dropDownList($materials, ['prompt' => '-Choose a Material-']) ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?php $suppliers = ArrayHelper::map(Contacts::findAll(['status' => 1, 'type' => 2]), 'id', 'name'); ?>
            <?= $form->field($model, 'supplier')->dropDownList($suppliers, ['prompt' => '-Choose a Supplier-']) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $transports = ArrayHelper::map(Contacts::findAll(['status' => 1 ]), 'id', 'name'); ?>
            <?= $form->field($model, 'transport')->dropDownList($transports, ['prompt' => '-Choose a Transport-']) ?>
        </div>
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
    <div id = "p_attach">
        <input type = "hidden" id = "delete_port_vals" name = "delete_port_vals" value = "">
        <?php if (!empty($model_upload)) { ?>
            <table class="table table-hover">
                <tr>
                    <th>Document Name</th>
                    <th>Document</th>
                    <th>Expiry Date</th>
                    <th>Description</th>
                    <th></th>
                </tr>
                <?php foreach ($model_upload as $val) { ?>
                    <tr>
                        <td><?= $val->document_title ?></td>
                        <td><a href="<?= Yii::$app->homeUrl ?>uploads/employee/documents/<?= $val->id ?>/<?= $val->file ?>" target="_blank"><?= $val->file ?></a></td>
                        <td><?= $val->expiry_date ?></td>
                        <td><?= $val->description ?></td>
                        <td><?= Html::a('<i class="fa fa-trash" style="color:red;"></i>', ['attachment-delete', 'id' => $val->id], ['onClick' => 'return confirm("Are you sure you want to remove?")']) ?></td>
                    </tr>
                <?php }
                ?>
            </table>
        <?php }
        ?>

        <span>
            <div class="row">
                <!--                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                                    <label class = "control-label"></label>
                                    <label class = "control-label">1</label>
                                </div>-->
                <?php $entry= \common\models\DailyEntry::findOne($id);?>
                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class = "form-group field-staffperviousemployer-hospital_address">
                        <span class="serial_no">1</span>

                    </div>
                </div>
                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class = "form-group field-staffperviousemployer-hospital_address">
                        <label class = "control-label">Ticket No.</label>
                        <input class="form-control" type = "text" name = "creates[ticket_no][]" value="<?= $entry->ticket_no?>">

                    </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Truck No.</label>
                        <input class="form-control" type = "text" name = "creates[truck_no][]" value="<?= $entry->truck_number?>">
                    </div>
                </div>
                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Net Weight</label>
                        <input type="text" class="form-control" name="creates[net_weight][]" value="<?= $entry->net_weight?>">
                    </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Rate</label>
                        <input type="text" class="form-control" name="creates[rate][]" value="<?= $entry->rate?>">
                    </div>
                </div>
                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Transport Amount</label>
                        <input type="text" class="form-control" name="creates[transport_amount][]" value="<?= $entry->transport_amount?>">
                    </div>
                </div>

                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Total</label>
                        <input type="text" class="form-control" name="creates[total][]" value="<?= $entry->total?>">
                    </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Amount Paid</label>
                        <input type="text" class="form-control" name="creates[amount_paid][]" value="<?= $entry->amount_paid?>">
                    </div>
                </div>

                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                    <div class="form-group field-staffperviousemployer-designation">
                        <label class="control-label" for="">Description</label>
                        <input type="text" class="form-control" name="creates[description][]" value="<?= $entry->description?>">
                    </div>
                </div>
            </div>
            <div style="clear:both"></div>
        </span>

    </div>


<!--    <div class="row">
        <div class="col-md-12">
            <a id="addAttach" title="Add More Attachment" last_sl="1" class="btn btn-blue btn-icon btn-icon-standalone addAttach" style="float:right;margin-right: 15px;"><i class="fa-plus"></i></a>
        </div>
    </div>-->
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
    $("document").ready(function () {
        var scntDiv = $('#p_attach');
        var i = $('#p_attach span').size() + 1;

        $('#addAttach').on('click', function () {
            var srl = $('#addAttach').attr('last_sl');
//            parseFloat(total) + parseFloat(price);
            var newsrl = parseInt(srl)+1;
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
