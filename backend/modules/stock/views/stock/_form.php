<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'transaction_type')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'transaction_id')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'material_id')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'material_code')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'yard_id')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'yard_code')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'material_cost')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'quantity_in')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'quantity_out')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'weight_in')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'weight_out')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'total_cost')->textInput(['maxlength' => true]) ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'CB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'UB')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'DOC')->textInput() ?>

</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'DOU')->textInput() ?>

</div>        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
