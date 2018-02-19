<?php ?>
<div id="print">
    <style type="text/css">
        tfoot{display: table-footer-group;}
        table { page-break-inside:auto;}
        tr{ page-break-inside:avoid; page-break-after:auto; }

        @page {
            size: A4;
        }
        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group}
            /*tfoot {position: absolute;bottom: 0px;}*/
            .main-tabl{width: 100%}
            .footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }
            .main-tabl{
                -webkit-print-color-adjust: exact;
                margin: auto;
                /*tr{ page-break-inside:avoid; page-break-after:auto; }*/
            }

        }
        @media screen{
            .main-tabl{
                width: 60%;
            }
        }
        body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,div{
            color:#525252 !important;
        }
        .main-tabl{
            margin: auto;
        }
        .main-left{
            float: left;
        }
        .main-right{
            float: right;

        }
        .heading{
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
        }
        .print{
            margin-top: 20px;
            margin-left: 530px;
        }
        .footer {
            width: 100%;
            display: inline-block;
            font-size: 15px;
            color: #4e4e4e;
            /*border-top: 1px solid #a09c9c;*/
            padding: 9px 0px 3px 0px;
        }
        .footer p {
            text-align: center;
            font-size: 9px;
            margin: 0px !important;
            color: #525252 !important;
            font-weight: 600;
        }
        .cover-tbl-main{
            width: 100%;
            border: 1px solid #a09c9c;
            border-collapse: collapse;
        }
        .cover-tbl-main h3{
            margin: 8px 0px;
        }
        .cover-tbl-main th{
            border: 1px solid #a09c9c;
        }
        .cover-tbl-main td{
            border: 1px solid #a09c9c;
        }
        .cover-tbl-sub{
            border: none !important;
        }
        .cover-tbl-sub td{
            border: none !important;
            padding: 8px 11px;
            font-size: 13px;
        }
        .cover-tbl-sub th{
            border: none !important;
            padding: 8px 11px;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
        }
        .tbl1-width-10{
            width: 10%;
            padding: 8px 0px;
        }
        .tbl1-width-80{
            width: 80%;
            padding: 8px 0px;
        }
        .item-dtl{
            text-align: center !important;
            font-size: 13px;
        }
        .notes{
            width: 5%;
            padding: 0px 0px opx 0px;
            padding: 2px 20px;
            padding-top: 0px;
            border-bottom: 2px solid;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
    <table class="main-tabl cover-tbl-main" border="0" style="font-family: Roboto, sans-serif !important;">
        <thead>
        </thead>
        <tbody>
            <tr>
                <th colspan="3"><h3>PETCO ENERGY DIESEL L.L.C</h3></th>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="cover-tbl-sub">
                        <tr>
                            <td style="max-width: 405px;">
                                <table>
                                    <tr>
                                        <th>Vessel Name</th>
                                        <th>:</th>
                                        <th>
                                            <?php
                                            if ($order->vessel != '') {
                                                $vessel = common\models\Ships::findOne($order->vessel);
                                                echo $vessel->name;
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Voyage No</th>
                                        <th>:</th>
                                        <td>
                                            <?php
                                            if ($order->appointment_no != '') {
                                                $appointment_no = common\models\Appointment::findOne($order->appointment_no);
                                                echo $appointment_no->appointment_number;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>:</th>
                                        <td><?= $order->invoice_no ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <th>:</th>
                                        <td><?= $order->date ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th class="tbl1-width-80">Statement Payment as the following</th>
                <th class="tbl1-width-10">USD</th>
                <th class="tbl1-width-10">AED</th>
            </tr>
            <?php
            if (!empty($order_details)) {
                $aed_grand_tot = 0;
                $usd_grand_tot = 0;
                foreach ($order_details as $order_detail) {
                    ?>
                    <tr>
                        <td class = "tbl1-width-80 item-dtl"><?= $order_detail->description ?></td>
                        <td class = "tbl1-width-10 item-dtl"></td>
                        <td class = "tbl1-width-10 item-dtl"></td>
                    </tr>
                    <tr>
                        <?php
                        $unit = '';
                        if ($order_detail->unit != '') {
                            $unit = common\models\Units::findOne($order_detail->unit)->unit_symbol;
                        }
                        ?>
                        <td class = "tbl1-width-80 item-dtl">(QTY : <?= $order_detail->qty ?> <?= $unit ?> * RATE : $<?= $order_detail->rate ?>/<?= $unit ?>)</td>
                        <td class = "tbl1-width-10 item-dtl"><?= Yii::$app->SetValues->NumberFormat($order_detail->total) ?></td>
                        <?php
                        $currency = common\models\Currency::findOne(1);
                        $aed_amount = $order_detail->total * $currency->currency_value;
                        ?>
                        <td class = "tbl1-width-10 item-dtl"><?= Yii::$app->SetValues->NumberFormat($aed_amount) ?></td>
                    </tr>
                    <?php
                    $usd_grand_tot += $order_detail->total;
                    $aed_grand_tot += $aed_amount;
                }
            }
            ?>
            <tr>
                <th class="tbl1-width-80">Total</th>
                <th class="tbl1-width-10"><?= Yii::$app->SetValues->NumberFormat($usd_grand_tot) ?></th>
                <th class="tbl1-width-10"><?= Yii::$app->SetValues->NumberFormat($aed_grand_tot) ?></th>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="border-collapse: collapse;margin: 15px 0px;">
                        <tr>
                            <th style="padding: 8px 20px;border-left: none;">DUE AMOUNT</th>
                            <th style="padding: 8px 20px;"><?= Yii::$app->SetValues->NumberFormat($aed_grand_tot) ?></th>
                        </tr>
                    </table>
                    <table style="border: none;margin: 15px 0px;width: 98%;">
                        <tr>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 25%;">PAYMENT MODE </td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 5%;">:</td>
                            <td style="padding: 8px 20px;font-size: 13px;border: none;border-bottom: 1px solid #a09c9c;width: 20%;"></td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 25%;width: 20%;"></td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 5%;"></td>
                            <td style="padding: 8px 20px;font-size: 13px;border: none;width: 20%;"></td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 25%;">PAYMENT DATE </td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 5%;">:</td>
                            <td style="padding: 8px 20px;font-size: 13px;border: none;border-bottom: 1px solid #a09c9c;width: 20%;"></td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 25%;width: 20%;">CHEQUE DATE</td>
                            <td style="padding: 8px 20px;font-size: 13px;border:none;width: 5%;">:</td>
                            <td style="padding: 8px 20px;font-size: 13px;border: none;border-bottom: 1px solid #a09c9c;width: 20%;"></td>
                        </tr>
                    </table>
                    <div class="notes">NOTE</div>
                </td>
            </tr>
            <tr><td colspan="3" style="padding: 10px 11px;"></td></tr>
            <tr><td colspan="3" style="padding: 10px 11px;"></td></tr>
            <tr><td colspan="3" style="padding: 10px 11px;"></td></tr>
            <tr><td colspan="3" style="padding: 10px 11px;"></td></tr>
            <tr><td colspan="3" style="padding: 10px 11px;"></td></tr>

        </tbody>
        <tfoot>
            <tr><td colspan="3">
                    <div class="invoice-details"style="margin-bottom: 10px;margin-top: 90px;">
                        <table style="width:100%;border: none">
                            <tr>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;border: none">Prepared By</th>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;border: none">Checked By</th>
                                <th style="width: 34%;font-size: 10px;padding: 10px 0px;border: none">Approved By</th>
                            </tr>
                            <tr>
                                <th style="width: 33%;font-size: 10px;padding: 20px 0px;border: none"><div style="width:30%;border-bottom: 1px solid #a09c9c;margin: 0 auto;"></div></th>
                                <th style="width: 33%;font-size: 10px;padding: 20px 0px;border: none"><div style="width:30%;border-bottom: 1px solid #a09c9c;margin: 0 auto;"></div></th>
                                <th style="width: 34%;font-size: 10px;padding: 20px 0px;border: none"><div style="width:30%;border-bottom: 1px solid #a09c9c;margin: 0 auto;"></div></th>
                            </tr>
                        </table>
                    </div>
                </td></tr>
        </tfoot>
    </table>
</div>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<div class="print">
    <?php
    if ($print) {
        ?>
        <button onclick="printContent('print')" style="font-weight: bold !important;">Print</button>
        <?php
    }
    ?>
    <button onclick="window.close();" style="font-weight: bold !important;">Close</button>
</div>