<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\Services;
use common\models\Employee;
use common\models\Appointment;
use common\models\Contacts;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use common\components\AppointmentWidget;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Create Estimated Proforma';
$this->params['breadcrumbs'][] = ['label' => 'Estimated Proformas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . ' # <b style="color: #008cbd;">' . $appointment->appointment_number . '</b>' ?></h2>

            </div>
            <?php //Pjax::begin();     ?>
            <div class="panel-body">
                <?= AppointmentWidget::widget(['id' => $appointment->id]) ?>

                <hr class="appoint_history" />


                <ul class="estimat nav nav-tabs nav-tabs-justified">
                    <li>
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Appointment</span>', ['appointment/update', 'id' => $appointment->id]);
                        ?>

                    </li>
                    <li class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Estimated Proforma</span>', ['appointment/add', 'id' => $appointment->id]);
                        ?>

                    </li>

                </ul>
                <div class="outterr">

                    <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">#</th>
                                    <th data-priority="1">SERVICES</th>
                                    <th data-priority="3">SUPPLIER</th>
                                    <th data-priority="1">RATE</th>
                                    <th data-priority="1">QUANTITY</th>
                                    <th data-priority="1">TOTAL</th>
                                    <th data-priority="1">VAT</th>
                                    <th data-priority="1">VAT AMOUNT</th>
                                    <th data-priority="1">SUB TOTAL</th>
                                    <th data-priority="1">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 0;
                                $epdatotal = 0;
                                $tot_subtoatl = 0;
                                foreach ($estimates as $estimate):
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td class="" drop_id="estimatedproforma-service_id" id="<?= $estimate->id ?>-service_id" val="<?= $estimate->service_id ?>"><?= $estimate->service->service ?></td>
                                        <?php
                                        if ($estimate->supplier != '') {

                                            if (isset($estimate->service_id) && $estimate->service_id == 1) {
                                                $selected = common\models\Materials::findOne($estimate->service_id);
                                            } else {
                                                $selected = common\models\Contacts::findOne($estimate->service_id);
                                            }
                                        }
                                        ?>
                                        <td class="" drop_id="estimatedproforma-supplier" id="<?= $estimate->id ?>-supplier" val="<?= $estimate->supplier ?>"> <?= $selected->name ?></td>
                                        <td class="edit_text" id="<?= $estimate->id ?>-unit_rate"  val="<?= $estimate->unit_price ?>">
                                            <?php
                                            if ($estimate->unit_price == '') {
                                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                            } else {
                                                echo Yii::$app->SetValues->NumberFormat($estimate->unit_price);
                                            }
                                            ?>
                                        </td>
                                        <td  id="<?= $estimate->id ?>-quantity" val="<?= $estimate->quantity ?>"><?php if ($estimate->quantity != '') { ?> <?= $estimate->quantity ?><?php } ?></td>
                                        <td  id="<?= $estimate->id ?>-total" val="<?= $estimate->total ?>"><?php if ($estimate->total != '') { ?> <?= $estimate->total ?><?php } ?></td>
                                        <td  id="<?= $estimate->id ?>-tax" val="<?= $estimate->tax ?>"><?php if ($estimate->tax != '') { ?> <?= $estimate->tax ?><?php } ?></td>
                                        <td  id="<?= $estimate->id ?>-tax_amount" val="<?= $estimate->tax_amount ?>"><?php if ($estimate->tax_amount != '') { ?> <?= $estimate->tax_amount ?><?php } ?></td>
                                        <td id="<?= $estimate->id ?>-sub_total" val="<?= $estimate->sub_total ?>"><?php if ($estimate->sub_total != '') { ?> <?= $estimate->sub_total ?><?php } ?></td>

                                        <td>
                                            <?= Html::a('<i class="fa fa-pencil"></i>', ['/appointment/appointment/add', 'id' => $id, 'prfrma_id' => $estimate->id], ['class' => '', 'tittle' => 'Edit']) ?>
                                            <?= Html::a('<i class="fa fa-remove"></i>', ['/appointment/appointment/delete-detail', 'id' => $estimate->id], ['class' => '', 'tittle' => 'Edit', 'data-confirm' => 'Are you sure you want to delete this item?']) ?>
                                        </td>
                                        <?php
                                        $epdatotal += $estimate->total;
                                        $tot_subtoatl += $estimate->sub_total;
                                        ?>
                                    </tr>

                                    <?php
                                endforeach;
                                ?>


                                <tr>
                                    <td></td>
                                    <td colspan="4"> <b>TOTAL</b></td>
                                    <td style="font-weight: bold;"><?php echo Yii::$app->SetValues->NumberFormat($epdatotal) . '/-'; ?></td>
                                    <td colspan=""></td>
                                    <td colspan=""></td>
                                    <td style="font-weight: bold;" colspan=""><?php echo Yii::$app->SetValues->NumberFormat($tot_subtoatl) . '/-'; ?></td>
                                    <td colspan=""></td>
                                </tr>

                                <tr class="formm">
                                    <?php $form = ActiveForm::begin(); ?>
                                    <td></td>
                                    <td><?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map(Services::findAll(['status' => 1]), 'id', 'service'), ['prompt' => '-Service-'])->label(false); ?></td>
                                    <?php
                                    $contacts = Contacts::find()->where(['status' => 1])->all();

                                    if (isset($model->service_id) && $model->service_id == 1) {
                                        $contacts = common\models\Materials::find()->where(['status' => 1])->all();
                                    }
                                    ?>
                                    <td><?= $form->field($model, 'supplier')->dropDownList(ArrayHelper::map($contacts, 'id', 'name'), ['prompt' => '-Select-'])->label(false); ?></td>
                                    <td><?= $form->field($model, 'unit_price')->textInput(['placeholder' => ' Rate'])->label(false) ?></td>
                                    <td><?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity'])->label(false) ?></td>
                                    <td><?= $form->field($model, 'total')->textInput(['placeholder' => 'Total'])->label(false) ?></td>
                                    <td><?= $form->field($model, 'tax')->dropDownList(ArrayHelper::map(common\models\Tax::findAll(['status' => 1]), 'id', 'tax'), ['prompt' => '-VAT-'])->label(false); ?></td>
                                    <td><?= $form->field($model, 'tax_amount')->textInput(['placeholder' => 'Vat Amount'])->label(false) ?></td>
                                    <td><?= $form->field($model, 'sub_total')->textInput(['placeholder' => 'Sub Total'])->label(false) ?></td>
                                    <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?>
                                    </td>
                                    <?php ActiveForm::end(); ?>
                                </tr>
                                <tr></tr>


                            </tbody>

                        </table>
                    </div>

                </div>
                <script>
                    $("document").ready(function () {
                        $('#appointmentdetails-service_id').change(function () {
                            var service_id = $(this).val();
                            $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {service_id: service_id},
                                url: '<?= Yii::$app->homeUrl; ?>appointment/appointment/supplier',
                                success: function (data) {
                                    if (data != '') {
                                        $("#appointmentdetails-supplier").html(data);
                                    } else {
                                        $("#appointmentdetails-supplier").prop('disabled', true);
                                    }
                                }
                            });
                        });



                    });
                </script>



                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2.css">
                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2-bootstrap.css">
                <script src="<?= Yii::$app->homeUrl; ?>js/select2/select2.min.js"></script>

                <script>
                    $(document).ready(function () {
                        $("#estimatedproforma-unit_rate").keyup(function () {
                            multiply();
                        });
                        $("#estimatedproforma-unit").keyup(function () {
                            multiply();
                        });
                    });
                    function multiply() {
                        var rate = $("#estimatedproforma-unit_rate").val();
                        var unit = $("#estimatedproforma-unit").val();
                        if (rate != '' && unit != '') {
                            $("#estimatedproforma-epda").val(rate * unit);
                        }

                    }
                    $("#estimatedproforma-epda").prop("disabled", true);
                </script>
            </div>
            <?php //Pjax::end();                ?>
        </div>



    </div>
</div>

<div class="modal fade" id="add-sub">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Dynamic Content</h4>
            </div>

            <div class="modal-body">

                Content is loading...

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info">Save changes</button>
            </div>
        </div>
    </div>
    <style>
        .filter{
            background-color: #b9c7a7;
        }
        table.table tr td:last-child a {
            padding: inherit;padding: 0px 4px;
        }
        .error{
            color: #0553b1;
            padding-bottom: 5px;
            font-size: 18px;
            font-weight: bold;
        }

    </style>
    <script>
        $("document").ready(function () {

            /*
             * Double click enter function
             * */

            $('.edit_text').on('dblclick', function () {

                var val = $(this).attr('val');
                var idd = this.id;
                var res_data = idd.split("-");
                if (res_data[1] == 'comments' || res_data[1] == 'rate_to_category') {
                    $(this).html('<textarea class="' + idd + '" value="' + val + '">' + val + '</textarea>');

                } else {
                    $(this).html('<input class="' + idd + '" type="text" value="' + val + '"/>');

                }

                $('.' + idd).focus();
            });
            $('.edit_text').on('focusout', 'input,textarea', function () {
                var thiss = $(this).parent('.edit_text');
                var data_id = thiss.attr('id');
                var update = thiss.attr('update');
                var res_id = data_id.split("-");
                var res_val = $(this).val();
                $.ajax({
                    type: 'POST',
                    cache: false,
                    data: {id: res_id[0], name: res_id[1], valuee: res_val},
                    url: '<?= Yii::$app->homeUrl; ?>appointment/estimated-proforma/edit-estimate',
                    success: function (data) {
                        if (data == '') {
                            data = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        thiss.html(res_val);
                    }
                });

            });

            /*
             * Double click Dropdown
             * */

            $('.edit_dropdown').on('dblclick', function () {
                var val = $(this).attr('val');
                var drop_id = $(this).attr('drop_id');
                var idd = this.id;
                var option = $('#' + drop_id).html();
                $(this).html('<select class="' + drop_id + '" value="' + val + '">' + option + '</select>');
                $('.' + drop_id + ' option[value="' + val + '"]').attr("selected", "selected");
                $('.' + drop_id).focus();

            });
            $('.edit_dropdown').on('focusout', 'select', function () {
                var thiss = $(this).parent('.edit_dropdown');
                var data_id = thiss.attr('id');
                var res_id = data_id.split("-");
                var res_val = $(this).val();
                $.ajax({
                    type: 'POST',
                    cache: false,
                    data: {id: res_id[0], name: res_id[1], valuee: res_val},
                    url: '<?= Yii::$app->homeUrl; ?>appointment/estimated-proforma/edit-estimate-service',
                    success: function (data) {
                        if (data == '') {
                            data = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        thiss.html(data);
                    }
                });

            });


        });
    </script>
</div>
