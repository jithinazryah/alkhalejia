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
                        if (isset($appointment->vessel)) {
                                $vessel = common\models\Ships::findOne($appointment->vessel);
                                if (isset($vessel))
                                        echo $vessel->name;
                        }
                        ?>

                </td>
                <td class="labell">PORT OF CALL </td><td class="value">: <?= $appointment->port_of_call; ?> </td>
                <td class="labell">TERMINAL </td><td class="value">: <?= $appointment->terminal; ?> </td>
        </tr>

        <tr>
                <td class="labell">BERTH NO </td><td class="value">: <?= $appointment->berth_number; ?> </td>
                <td class="labell">Material </td><td class="value">: <?= $appointment->material; ?> </td>
                <td class="labell">QUANTITY </td><td class="value">: <?= $appointment->quantity; ?> </td>

        </tr>

</table>

