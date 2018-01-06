<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Services */

$this->title = $model->service;
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Services</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="services-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?=
                                                        Html::a('Delete', ['delete', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'data' => [
                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                'method' => 'post',
                                                            ],
                                                        ])
                                                        ?>
                                                </p>

                                                <?=
                                                DetailView::widget([
                                                    'model' => $model,
                                                    'attributes' => [
                                                        //   'id',
                                                        'category0.category_name',
                                                        'service',
                                                        //'supplier_option',
                                                        [
                                                            'attribute' => 'supplier_option',
                                                            'value' => function($model) {
                                                                    if ($model->supplier_option == '1')
                                                                            return 'Yes';
                                                                    else if ($model->supplier_option == '0')
                                                                            return 'No';
                                                                    else
                                                                            return '';
                                                            },
                                                        ],
//                                                        'supplier',
                                                        'unit',
                                                        'unit_rate',
                                                        'tax0.tax',
                                                        'description:ntext',
                                                            [
                                                            'attribute' => 'status',
                                                            'value' => function($model) {
                                                                    if ($model->status == '1')
                                                                            return 'Enabled';
                                                                    else if ($model->status == '0')
                                                                            return 'Disabled';
                                                                    else
                                                                            return '';
                                                            },
                                                        ],
                                                    ],
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


