<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Ships;
use common\models\Ports;
use common\models\Materials;
use kartik\datetime\DateTimePicker;
use common\models\Terminals;

/* @var $this yii\web\View */
/* @var $model common\models\Appointment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appointment-form form-inline">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $vessel = ArrayHelper::map(Ships::findAll(['status' => 1]), 'id', 'name'); ?>
                        <?= $form->field($model, 'vessel')->dropDownList($vessel, ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'appointment_number')->textInput(['maxlength' => true, 'readonly' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $ports = ArrayHelper::map(Ports::findAll(['status' => 1]), 'id', 'port_name'); ?>
                        <?= $form->field($model, 'port_of_call')->dropDownList($ports, ['prompt' => '--Select--']) ?>

                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if ($model->isNewRecord)
                                $model->date = date('d-m-Y');
                        else
                                $model->date = date('d-m-Y', strtotime($model->date));
                        ?>
                        <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

                </div>

        </div>

        <div class="row">
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $terminal = ArrayHelper::map(Terminals::findAll(['status' => 1]), 'id', 'terminal'); ?>
                        <?= $form->field($model, 'terminal')->dropDownList($terminal, ['prompt' => '--Select--']) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'berth_number')->textInput(['maxlength' => true]) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php $vessel = ArrayHelper::map(Materials::findAll(['status' => 1]), 'id', 'name'); ?>
                        <?= $form->field($model, 'material')->dropDownList($vessel, ['prompt' => '--Select--']) ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'quantity')->textInput() ?>

                </div>
        </div>

        <div class="row">
                <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
                        <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                </div>

                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?php
                        if (isset($model->eta)) {
                                $model->eta = date('d-M-Y h:i', strtotime($model->eta));
                        } else {
                                $model->eta = date('d-M-Y h:i');
                        }
                        ?>
                        <?=
                        $form->field($model, 'eta')->widget(DateTimePicker::classname(), [
                            'type' => DateTimePicker::TYPE_INPUT,
                            'value' => $model->eta,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy hh:ii'
                            ]
                        ])
                        ?>

                </div>
                <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

                </div>
        </div>



        <div class="row">
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
                        <?= $form->field($model, 'image[]')->fileInput(['multiple' => TRUE]) ?>

                </div>
        </div>

        <br/>
        <hr class="appoint_history" />
        <div class="row">
                <div class="col-md-12">
                        <br/>
                        <div class="row mgleft-padd">
                                <?php
                                if (!$model->isNewRecord) {
                                        $path = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/appointment/' . $model->id;
                                        if (count(glob("{$path}/*")) > 0) {
                                                ?>
                                                <h4 class="sub-heading" style="margin-bottom: 16px;">Uploaded Files</h4>
                                                <?php
                                                foreach (glob("{$path}/*") as $file) {
                                                        $arry = explode('/', $file);
                                                        $img_nmee = end($arry);
                                                        $img_nmees = explode('.', $img_nmee);
                                                        ?>
                                                        <span class="upload_file_list"><a href="<?= Yii::$app->homeUrl . 'uploads/appointment/' . $model->id . '/' . end($arry) ?>" target="_blank"><?= end($arry); ?></a></span>
                                                        <?php
                                                }
                                        }
                                }
                                ?>
                        </div>
                </div>
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


