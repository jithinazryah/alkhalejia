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
            <?php $vessel = ArrayHelper::map(ContactType::findAll(['status' => 1]), 'id', 'type'); ?>
            <?= $form->field($model, 'type')->dropDownList($vessel, ['prompt' => '-Select-']) ?>


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
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'address')->textarea(['rows' => 5]) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>

        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
