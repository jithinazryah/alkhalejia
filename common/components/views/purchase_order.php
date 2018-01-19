<?php

use yii\helpers\Html;
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
    .appoint  .labell{
        width:10% !important;
    }
</style>
<table class="appoint">
    <tr>
        <td class="labell">Received Date </td><td class="value">:
            <?= $Order->date; ?>
        </td>
        <td class="labell">Reference No </td><td class="value">:
            <?= $Order->reference_no; ?>
        </td>
        <td class="labell">Invoice No </td><td class="value">:
            <?= $Order->invoice_no; ?>
        </td>
    </tr>

</table>

