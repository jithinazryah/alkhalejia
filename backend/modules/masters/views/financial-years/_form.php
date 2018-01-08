<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\FinancialYears */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="financial-years-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'financial_year')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'financial_period')->textInput() ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'start_period')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'value' => '23-Feb-1982',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])
            ?>
            <?php // $form->field($model, 'start_period')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'end_period')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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
<script type="text/javascript">
    $(document).ready(function ()
    {
        $('body').on('change', '#financialyears-start_period', function () {
            var start_date = $('#financialyears-start_period').val();
            var no_of_period = $('#financialyears-financial_period').val();
            if (start_date != '' && no_of_period != '') {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    data: {date: start_date, period: no_of_period},
                    url: '<?= Yii::$app->homeUrl; ?>masters/financial-years/get-date',
                    success: function (data) {
                        $('#financialyears-end_period').val(data);
                    }
                });
            }
        });
        $('body').on('keyup', '#financialyears-financial_period', function () {
            var start_date = $('#financialyears-start_period').val();
            var no_of_period = $('#financialyears-financial_period').val();
            if (start_date != '' && no_of_period != '') {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    data: {date: start_date, period: no_of_period},
                    url: '<?= Yii::$app->homeUrl; ?>masters/financial-years/get-date',
                    success: function (data) {
                        $('#financialyears-end_period').val(data);
                    }
                });
            }
        });
    });
</script>
