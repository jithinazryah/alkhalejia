<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DailyEntryDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="daily-entry-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'daily_entry_id') ?>

    <?= $form->field($model, 'ticket_no') ?>

    <?= $form->field($model, 'truck_number') ?>

    <?= $form->field($model, 'gross_weight') ?>

    <?php // echo $form->field($model, 'tare_weight') ?>

    <?php // echo $form->field($model, 'net_weight') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'transport_amount') ?>

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
