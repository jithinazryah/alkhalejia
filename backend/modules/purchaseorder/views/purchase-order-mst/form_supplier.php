<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ContactType;
use common\models\TransactionCategory;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */

$this->title = 'Create Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <div class="panel-body"><div class="contacts-create">
                        <div class="contacts-form form-inline">

                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                    <?php $transaction_categories = ArrayHelper::map(TransactionCategory ::findAll(['status' => 1]), 'id', 'category'); ?>
                                    <?= $form->field($model, 'service')->dropDownList($transaction_categories, ['prompt' => '-Select-']) ?>


                                </div>
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true]) ?>

                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                                    <?php $vessel = ArrayHelper::map(ContactType::findAll(['status' => 1, 'id' => 2]), 'id', 'type'); ?>
                                    <?= $form->field($model, 'type')->dropDownList($vessel) ?>


                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

                                </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                                </div>
                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    <div class="form-group">
                                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;', 'id' => 'add_supplier']) ?>
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
<script>

    $('#add_supplier').click(function (event) {
        event.preventDefault();
        if (valid()) {
            var contacts_service = $('#contacts-service').val();
            var contacts_name = $('#contacts-name').val();
            var contacts_code = $('#contacts-code').val();
            var contacts_tax_id = $('#contacts-tax_id').val();
            var contacts_type = $('#contacts-type').val();
            var contacts_phone = $('#contacts-phone').val();
            var contacts_email = $('#contacts-email').val();
            var contacts_city = $('#contacts-city').val();
            var contacts_status = $('#contacts-status').val();
            var contacts_address = $('#contacts-address').val();
            var contacts_description = $('#contacts-description').val();
            $.ajax({
                url: homeUrl + 'purchaseorder/purchase-order-mst/add-supplier',
                type: "post",
                data: {contacts_service: contacts_service, contacts_name: contacts_name, contacts_code: contacts_code, contacts_tax_id: contacts_tax_id, contacts_type: contacts_type, contacts_phone: contacts_phone, contacts_email: contacts_email, contacts_city: contacts_city, contacts_status: contacts_status, contacts_address: contacts_address, contacts_description: contacts_description},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.con === "1") {
                        $('#purchaseordermst-attenssion').append($('<option value="' + $data.id + '" selected="selected" >' + $data.name + '</option>'));
//                        $('#s2id_products-main_category').select2('data', {id: $data.id, text: $data.name});
                        $('#modal').modal('hide');
                        $('#purchaseordermst-attenssion').trigger("change");
                    } else {
                        alert($data.error);
                    }

                }, error: function () {

                }
            });
        }
    });
    var valid = function () { //Validation Function - Sample, just checks for empty fields
        var valid;
        $("input").each(function () {
            if (!$('#contacts-service').val()) {
                $('#contacts-service').focus();
                valid = false;
            }
            if (!$('#contacts-name').val()) {
                $('#contacts-name').focus();
                valid = false;
            }
            if (!$('#contacts-code').val()) {
                $('#contacts-code').focus();
                valid = false;
            }
            if (!$('#contacts-type').val()) {
                $('#contacts-type').focus();
                valid = false;
            }
            if (!$('#contacts-phone').val()) {
                $('#contacts-phone').focus();
                valid = false;
            }
            if (!$('#contacts-email').val()) {
                $('#contacts-email').focus();
                valid = false;
            }
            if (!$('#contacts-address').val()) {
                $('#contacts-address').focus();
                valid = false;
            }
        });
        if (valid !== false) {
            return true;
        } else {
            return false;
        }
    }
</script>

