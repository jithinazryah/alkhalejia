<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FinancialYearsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="financial-years-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'financial_year') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'financial_period') ?>

    <?= $form->field($model, 'start_period') ?>

    <?php // echo $form->field($model, 'end_period') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'error_msg') ?>

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
