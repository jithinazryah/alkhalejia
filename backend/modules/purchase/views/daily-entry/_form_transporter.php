<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ContactType;
use common\models\Services;
use common\models\TransactionCategory;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form form-inline">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true, 'validationUrl' => 'validate',]); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'service')->dropDownList(['2' => 'Transporter'], ['readonly' => TRUE]) ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'type')->dropDownList(['3' => 'Transporter'], ['readonly' => TRUE]) ?>

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
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'add_transporter', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#add_transporter').click(function (event) {
        event.preventDefault();
        if (valid()) {
            var service = $('#contacts-service').val();
            var name = $('#contacts-name').val();
            var code = $('#contacts-code').val();
            var tax_id = $('#contacts-tax_id').val();
            var type = $('#contacts-type').val();
            var phone = $('#contacts-phone').val();
            var email = $('#contacts-email').val();
            var city = $('#contacts-city').val();
            var status = $('#contacts-status').val();
            var address = $('#contacts-address').val();
            var description = $('#contacts-description').val();
            $.ajax({
                url: homeUrl + 'purchase/daily-entry/supplier',
                type: "post",
                data: {service: service, name: name, code: code, tax_id: tax_id, type: type, phone: phone, email: email, city: city, status: status, address: address, description: description},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.con === "1") {
                        $('#dailyentry-transport').append($('<option value="' + $data.id + '" selected="selected" >' + $data.name + '</option>'));
//                        $('#s2id_products-main_category').select2('data', {id: $data.id, text: $data.name});
                        $('#modal').modal('hide');
                    } else {
                        alert($data.error);
                    }

                }, error: function () {

                }
            });
        } else {
//            alert('Please fill the Field');
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
        });
        if (valid !== false) {
            return true;
        } else {
            return false;
        }
    }
</script>
