<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'transaction_type') ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'material_id') ?>

    <?= $form->field($model, 'material_code') ?>

    <?php // echo $form->field($model, 'yard_id') ?>

    <?php // echo $form->field($model, 'yard_code') ?>

    <?php // echo $form->field($model, 'material_cost') ?>

    <?php // echo $form->field($model, 'quantity_in') ?>

    <?php // echo $form->field($model, 'quantity_out') ?>

    <?php // echo $form->field($model, 'weight_in') ?>

    <?php // echo $form->field($model, 'weight_out') ?>

    <?php // echo $form->field($model, 'total_cost') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
