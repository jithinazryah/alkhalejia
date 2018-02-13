<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Materials;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Wise Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <div class="row" style="margin-left: 0px;border-bottom: 2px solid rgba(39, 41, 42, 0.46);">


                                                <div class="col-md-3">
                                                        <?php
                                                        $form = ActiveForm::begin([
                                                        ]);
                                                        ?>
                                                        <?=
                                                        $form->field($model, 'DOC')->widget(DatePicker::className(), [
                                                            'options' => ['class' => 'form-control'], 'pluginOptions' => [
                                                                'autoclose' => true,
                                                                'format' => 'dd-mm-yyyy',
                                                            ]
                                                        ])->label('Date');
                                                        ?>

                                                </div>

                                                <div class="col-md-3">

                                                        <?php
                                                        $materials = Materials::findAll(['status' => 1]);
                                                        ?>
                                                        <?=
                                                        $form->field($model, 'material_id')->dropDownList(ArrayHelper::map($materials, 'id', 'name'), ['prompt' => 'Select', 'multiple' => true]);
                                                        ?>

                                                </div>

                                                <div class="col-md-4" style="margin-top: 31px;">
                                                        <div class="form-group">
                                                                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                                                        </div>
                                                </div>
                                                <?php ActiveForm::end(); ?>



                                        </div>


                                        <table class='table-responsive table table-small-font table-bordered table-striped'>
                                                <tr>
                                                        <th>Crusher</th>
                                                        <th>Material 1</th>
                                                        <th>Material 2</th>
                                                </tr>
                                                <tr>
                                                        <td colspan="3"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;">Crusher 1</h5></td>
                                                </tr>
                                                <tr>
                                                        <td>Trips</td>
                                                        <td>10</td>
                                                        <td>10</td>
                                                </tr>

                                                <tr>
                                                        <td>Net Weight</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                </tr>
                                                <tr>
                                                        <td colspan="3"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;">Crusher 2</h5></td>
                                                </tr>

                                                <tr>
                                                        <td>Trips</td>
                                                        <td>5</td>
                                                        <td>5</td>
                                                </tr>

                                                <tr>
                                                        <td>Net Weight</td>
                                                        <td>50</td>
                                                        <td>50</td>
                                                </tr>

                                                <tr>
                                                        <td>18-11-2018</td>
                                                        <td>20</td>
                                                        <td>20</td>
                                                </tr>

                                                <tr>
                                                        <td>19-11-2018</td>
                                                        <td>170</td>
                                                        <td>170</td>
                                                </tr>

                                                <tr>
                                                        <td>Export</td>
                                                        <td>20</td>
                                                        <td>20</td>
                                                </tr>

                                                <tr style="font-weight: bold">
                                                        <td>Net</td>
                                                        <td>150</td>
                                                        <td>150</td>
                                                </tr>
                                        </table>


                                </div>
                        </div>
                </div>
        </div>
</div>


<script>
        $(document).ready(function () {

                $("#stock-material_id").select2({
                        //   placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>