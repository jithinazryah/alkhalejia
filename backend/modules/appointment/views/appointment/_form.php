<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Ships;
use common\models\Materials;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Appointment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appointment-form form-inline">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $vessel = ArrayHelper::map(Ships::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'vessel')->dropDownList($vessel, ['prompt' => '-Choose a Vessel-']) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'port_of_call')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'terminal')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'berth_number')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $vessel = ArrayHelper::map(Materials::findAll(['status' => 1]), 'id', 'name'); ?>
            <?= $form->field($model, 'material')->dropDownList($vessel, ['prompt' => '-Choose a Material-']) ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'quantity')->textInput() ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'eta')->widget(DateTimePicker::classname(), [
                'type' => DateTimePicker::TYPE_INPUT,
                'value' => '23-Feb-1982 10:10',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy hh:ii'
                ]
            ])
            ?>

        </div><div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

        </div> <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'image[]')->fileInput(['multiple' => TRUE]) ?>

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
