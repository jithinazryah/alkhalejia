<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PurchaseOrderMstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchase-order-mst-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'vessel') ?>

    <?= $form->field($model, 'reference_no') ?>

    <?= $form->field($model, 'appointment_no') ?>

    <?php // echo $form->field($model, 'invoice_no') ?>

    <?php // echo $form->field($model, 'attenssion') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'invoice') ?>

    <?php // echo $form->field($model, 'email_confirmation') ?>

    <?php // echo $form->field($model, 'delivery_note') ?>

    <?php // echo $form->field($model, 'eta') ?>

    <?php // echo $form->field($model, 'port') ?>

    <?php // echo $form->field($model, 'payment_terms') ?>

    <?php // echo $form->field($model, 'agent_details') ?>

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
