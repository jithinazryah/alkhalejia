<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MaterialsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'size') ?>

    <?= $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'purchase_price') ?>

    <?php // echo $form->field($model, 'selling_price') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'description') ?>

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
