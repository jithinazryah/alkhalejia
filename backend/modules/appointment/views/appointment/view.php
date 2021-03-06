<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Appointment */

$this->title = $model->appointment_number;
$this->params['breadcrumbs'][] = ['label' => 'Voyage Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Voyage Details</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="appointment-view">
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
                                // 'id',
                                'vessel',
                                'appointment_number',
                                'date',
                                'port_of_call',
                                'terminal',
                                'berth_number',
                                //   'material',
                                [
                                    'attribute' => 'material',
                                    'value' => function($model) {
                                        $material = common\models\Materials::findOne($model->material);
                                        return $material->name;
                                    },
                                ],
                                'quantity',
                                'eta',
                                'description:ntext',
//                                                        'status',
//                                                        'CB',
//                                                        'UB',
//                                                        'DOC',
//                                                        'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


