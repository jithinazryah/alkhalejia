<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PurchaseOrderMst */

$this->title = 'Add Purchase Order';
$this->params['breadcrumbs'][] = ['label' => 'Purchase Order Msts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Purchase Order</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <ul class="nav nav-tabs nav-tabs-justified">
                    <li class="active">
                        <a><span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Purchase Order</span></a>

                    </li>
                    <li>
                        <a><span class="visible-xs"><i class="fa-home"></i></span><span class="hidden-xs">Order Details</span></a>

                    </li>

                </ul>
                <div class="panel-body"><div class="purchase-order-mst-create">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

