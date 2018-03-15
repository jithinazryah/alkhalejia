<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\ModalViewWidget;
use yii\helpers\Url;
use common\models\CertificateType;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\CrewCertificate */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create Crew Certificate';
$this->params['breadcrumbs'][] = ['label' => 'Crew Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::button('<i class="fa-th-list"></i><span> Add Certificate</span>', ['value' => Url::to(['create-certificate', 'id' => $id]), 'class' => 'btn btn-warning  btn-icon btn-icon-standalone modalButton']) ?>
                <?= \common\widgets\Alert::widget(); ?>
                <?= ModalViewWidget::widget() ?>
                <div class="table-responsive" style="border: none">
                    <button class="btn btn-white" id="search-option" style="float: right;">
                        <i class="linecons-search"></i>
                        <span>Search</span>
                    </button>
                    <ul class="nav nav-tabs nav-tabs-justified" style="margin-bottom: 35px;">
                        <li>
                            <?php
                            echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Crew Information</span>', ['crew-information/update', 'id' => $id]);
                            ?>

                        </li>
                        <li class="active">
                            <?php
                            echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Crew Certificate</span>', ['crew-information/add', 'id' => $id]);
                            ?>

                        </li>

                    </ul>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
//                            'crew_id',
                            [
                                'attribute' => 'certificate_id',
                                'format' => 'raw',
                                'filter' => Html::activeDropDownList($searchModel, 'certificate_id', ArrayHelper::map(CertificateType::find()->all(), 'id', 'certificate_name'), ['class' => 'form-control', 'id' => 'certificate_name', 'prompt' => '']),
                                'value' => function ($data) {
                                    return CertificateType::findOne($data->certificate_id)->certificate_name;
                                },
                            ],
                            [
                                'attribute' => 'date_of_issue',
                                'value' => function($model) {
                                    return \Yii::$app->formatter->asDatetime($model->date_of_issue, "php:d-M-Y h:i A");
                                },
                                'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'date_of_issue', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
                            ],
                            [
                                'attribute' => 'date_of_expiry',
                                'value' => function($model) {
                                    return \Yii::$app->formatter->asDatetime($model->date_of_expiry, "php:d-M-Y h:i A");
                                },
                                'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'date_of_expiry', 'pluginOptions' => ['format' => 'd-m-Y', 'autoUpdateInput' => false]]),
                            ],
                            'issuing_authority',
                            [
                                'attribute' => 'image',
                                'attribute' => 'Uploded File',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    $links = common\models\CrewCertificate::getDocuments($data->id);
                                    return $links;
                                },
                            ],
                            'description',
                            // 'status',
                            // 'CB',
                            // 'UB',
                            // 'DOC',
                            // 'DOU',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::button('<i class="fa fa-pencil"></i>', ['value' => Url::to(['update-certificate', 'id' => $model->id]), 'class' => 'modalButton edit-btn']);
                                    },
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(".filters").slideToggle();
        $("#search-option").click(function () {
            $(".filters").slideToggle();
        });
        $(document).on('click', '.modalButton', function () {

            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr("value"));

        });
    });
</script>
