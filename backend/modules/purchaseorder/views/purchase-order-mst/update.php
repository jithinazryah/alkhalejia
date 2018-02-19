<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PurchaseOrderMst */

$this->title = 'Update Purchase Order';
$this->params['breadcrumbs'][] = ['label' => 'Purchase Order Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Purchase Order</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa-th-list"></i><span> Create Purchase Order</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>

                <ul class="nav nav-tabs nav-tabs-justified">
                    <li  class="active">
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Purchase Order</span>', ['purchase-order-mst/create', 'id' => $model->id]);
                        ?>

                    </li>
                    <li>
                        <?php
                        echo Html::a('<span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Order Details</span>', ['purchase-order-mst/add', 'id' => $model->id]);
                        ?>

                    </li>

                </ul>
                <div class="panel-body"><div class="purchase-order-mst-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'model_additional' => $model_additional,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
