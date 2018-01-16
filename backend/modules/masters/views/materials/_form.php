<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Tax;
use common\models\Units;

/* @var $this yii\web\View */
/* @var $model common\models\Materials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-form form-inline">
    <?= \common\widgets\Alert::widget(); ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?php
            $tax = ArrayHelper::map(Tax::find()->where(['status' => 1])->all(), 'id', function($model) {
                        return $model['tax'] . ' ( ' . $model['value'] . ' % )';
                    }
            );
            ?>
            <?= $form->field($model, 'tax')->dropDownList($tax, ['prompt' => '-Choose a Tax-']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?php $units = ArrayHelper::map(Units::findAll(['status' => 1]), 'id', 'unit_name'); ?>
            <?= $form->field($model, 'unit')->dropDownList($units, ['prompt' => '-Choose a Unit-']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'selling_price')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'image')->fileInput() ?>
            <?php
            if ($model->isNewRecord)
                echo "";
            else {
                if (!empty($model->image)) {
                    ?>

                    <img src="<?= Yii::$app->homeUrl ?>uploads/materials/<?= $model->image; ?>" width="125" height="100"/>
                    <?php
                }
            }
            ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

        </div>
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
