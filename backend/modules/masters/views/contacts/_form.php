<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ContactType;
use common\models\SupplierCategory;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?php
                        echo $form->field($model, 'type')->widget(Select2::classname(), [
                            'data' => ContactType::Types(),
                            'language' => 'en',
                            'options' => ['placeholder' => '--Select--'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>     <?php
                        echo $form->field($model, 'category')->widget(Select2::classname(), [
                            'data' => SupplierCategory::Category(),
                            'language' => 'en',
                            'options' => ['placeholder' => '--Select--'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 5]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

                </div>     </div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>

<style>
        .left_padd{
                min-height: 120px;
        }
</style>