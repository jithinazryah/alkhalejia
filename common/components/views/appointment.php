<?php

use yii\helpers\Html;
use common\models\Vessel;
?>
<style>
        .appoint{
                width: 100%;
        }
        .appoint .value{
                font-weight: bold;
                text-align: left;
        }
        .appoint .labell{
                text-align: left;
                width:10%;
        }
        .appoint .colen{

        }
        .appoint td{
                padding: 10px;

        }
</style>
<table class="appoint">
        <tr>
                <td class="labell">VESSEL-NAME </td><td class="value">:
                        <?php
                        if (isset($appointment->vessel) && $appointment->vessel != '') {
                                $vessel = common\models\Ships::findOne($appointment->vessel);
                                if (isset($vessel))
                                        echo $vessel->name;
                        } else {
                                ?>
                                <?= Html::a('(Not set click here to add)', ['update', 'id' => $appointment->id], ['style' => 'color: #008cbd;font-weight:normal']); ?>
                                </span>
                        <?php }
                        ?>

                </td>
                <td class="labell">PORT OF CALL </td><td class="value">:
                        <?php
                        if (isset($appointment->port_of_call) && $appointment->port_of_call != '') {
                                $ports = common\models\Ports::findOne($appointment->port_of_call);
                                if (isset($ports))
                                        echo $ports->port_name;
                        } else {
                                ?>
                                <?= Html::a('(Not set click here to add)', ['update', 'id' => $appointment->id], ['style' => 'color: #008cbd;font-weight:normal']); ?>
                                </span>
                        <?php }
                        ?>
                </td>
                <td class="labell">TERMINAL </td><td class="value">:
                        <?php
                        if (isset($appointment->terminal) && $appointment->terminal != '') {
                                echo $appointment->terminal;
                        } else {
                                ?>
                                <?= Html::a('(Not set click here to add)', ['update', 'id' => $appointment->id], ['style' => 'color: #008cbd;font-weight:normal']); ?>
                                </span>
                        <?php }
                        ?>
                </td>
        </tr>

        <tr>
                <td class="labell">BERTH NO </td><td class="value">:
                        <?php
                        if (isset($appointment->berth_number) && $appointment->berth_number != '') {
                                echo $appointment->berth_number;
                        } else {
                                ?>
                                <?= Html::a('(Not set click here to add)', ['update', 'id' => $appointment->id], ['style' => 'color: #008cbd;font-weight:normal']); ?>
                                </span>
                        <?php }
                        ?>
                </td>
                <td class="labell">Material </td><td class="value">:
                        <?php
                        if (isset($appointment->material) && $appointment->material != '') {
                                $material = common\models\Materials::findOne($appointment->material);
                                if (isset($material))
                                        echo $material->name;
                        }
                        ?>
                </td>
                <td class="labell">QUANTITY </td><td class="value">:
                        <?php
                        if (isset($appointment->quantity) && $appointment->quantity != '') {
                                echo $appointment->quantity;
                        } else {
                                ?>
                                <?= Html::a('(Not set click here to add)', ['update', 'id' => $appointment->id], ['style' => 'color: #008cbd;font-weight:normal']); ?>
                                </span>
                        <?php }
                        ?>
                </td>

        </tr>

</table>

