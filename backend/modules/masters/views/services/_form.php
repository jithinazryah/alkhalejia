<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?php $category = ArrayHelper::map(common\models\TransactionCategory::findAll(['status' => 1]), 'id', 'category'); ?>
                        <?= $form->field($model, 'category')->dropDownList($category, ['prompt' => '-Select-']) ?>


                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'service')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'supplier_option')->dropDownList(['1' => 'Yes', '2' => 'No']) ?>

                </div>
        </div>

        <div class="row">
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $unit = ArrayHelper::map(common\models\Units::findAll(['status' => 1]), 'id', 'unit_name'); ?>
                        <?= $form->field($model, 'unit')->dropDownList($unit, ['prompt' => '-Select-']) ?>
                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'unit_rate')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $tax = ArrayHelper::map(common\models\Tax::findAll(['status' => 1]), 'id', 'tax'); ?>
                        <?= $form->field($model, 'tax')->dropDownList($tax, ['prompt' => '-Select-']) ?>
                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>
                <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
                        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

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
<style>
        .left_padd{
                min-height: 120px;
        }
</style>