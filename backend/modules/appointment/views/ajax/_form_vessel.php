<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ships */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ships-form form-inline">
    <?= \common\widgets\Alert::widget(); ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'capacity')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['id' => 'add_vessel', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>

    $('#add_vessel').click(function (event) {
        event.preventDefault();
        if (valid()) {
            var name = $('#ships-name').val();
            var code = $('#ships-code').val();
            var reg_no = $('#ships-registration_number').val();
            var ship_length = $('#ships-length').val();
            var capacity = $('#ships-capacity').val();
            var status = $('#ships-status').val();
            var description = $('#ships-description').val();
            $.ajax({
                url: homeUrl + 'appointment/ajax/add-vessel',
                type: "post",
                data: {name: name, code: code, reg_no: reg_no, ship_length: ship_length, capacity: capacity, status: status, description: description},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.con === "1") {
                        $('#appointment-vessel').append($('<option value="' + $data.id + '" selected="selected" >' + $data.name + '</option>'));
//                        $('#s2id_products-main_category').select2('data', {id: $data.id, text: $data.name});
                        $('#modal').modal('hide');
                        $('#appointment-vessel').trigger("change");
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
            if (!$('#ships-name').val()) {
                $('#ships-name').focus();
                valid = false;
            }
            if (!$('#ships-code').val()) {
                $('#ships-code').focus();
                valid = false;
            }
            if (!$('#ships-registration_number').val()) {
                $('#ships-registration_number').focus();
                valid = false;
            }
            if (!$('#ships-length').val()) {
                $('#ships-length').focus();
                valid = false;
            }
            if (!$('#ships-capacity').val()) {
                $('#ships-capacity').focus();
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