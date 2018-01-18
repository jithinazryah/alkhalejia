<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentMstSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-mst-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'transaction_type') ?>

    <?= $form->field($model, 'document_no') ?>

    <?= $form->field($model, 'document_date') ?>

    <?= $form->field($model, 'supplier') ?>

    <?php // echo $form->field($model, 'due_amount') ?>

    <?php // echo $form->field($model, 'paid_amount') ?>

    <?php // echo $form->field($model, 'payment_mode') ?>

    <?php // echo $form->field($model, 'cheque_no') ?>

    <?php // echo $form->field($model, 'cheque_due_date') ?>

    <?php // echo $form->field($model, 'reference') ?>

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
