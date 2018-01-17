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
        .save{
            margin-top: 18px;
            margin-left: 6px !important;
        }
        .heading p{
            font-size: 11px;
            line-height: 5px;
        }
        .left-address p{
            font-size: 11px;
            line-height: 5px;
        }
        .footer {
            width: 100%;
            display: inline-block;
            font-size: 15px;
            color: #4e4e4e;
        }
        .footer p {
            text-align: center;
            font-size: 8px;
            margin: 0px !important;
            color: #525252 !important;
        }
    </style>
    <table class="main-tabl" border="0" style="font-family: Roboto, sans-serif !important;">
        <thead>
            <tr>
                <th style="width:100%">
                    <div class="header">
                        <div class="main-left">
                            <?php
                            if (!empty($epda_template)) {
                                if ($epda_template->left_logo != '') {
                                    $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/report_template/' . $epda_template->id . '/' . $epda_template->left_logo;
                                    if (file_exists($dirPath)) {
                                        $img = '<img width="90px" height="75px" src="' . Yii::$app->homeUrl . 'uploads/report_template/' . $epda_template->id . '/' . $epda_template->left_logo . '"/>';
                                    } else {
                                        $img = '<img width="90px" height="75px" src="' . Yii::$app->homeUrl . 'images/logoleft.jpg"/>';
                                    }
                                } else {
                                    $img = '<img width="90px" height="75px" src="' . Yii::$app->homeUrl . 'images/logoleft.jpg"/>';
                                }
                            } else {
                                $img = '<img width="90px" height="75px" src="' . Yii::$app->homeUrl . 'images/logoleft.jpg"/>';
                            }
                            echo $img;
                            ?>
                        </div>
                        <div class="main-right">
                            <div class="heading" style="font-weight:normal">
                                <strong style="text-transform:uppercase;font-size:11px;">Alkhalejia For Aggregates</strong>
                                <p>Trading,import and export</p>
                                <p>TEL: 072041315</p>
                                <p>POST BOX: 072041315</p>
                                <p style="padding-top: 15px;font-weight: 700;font-size:11px;">VAT ID : 12356</p>
                            </div>
                        </div>
                        <br/>
                    </div>
                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="heading"><h2 style="font-size:13px;">TAX INVOICE</h2></div>
                    <br/>
                    <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                        <div class="main-left left-address" style="padding-top: 10px;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p>Azryah Networks ,Kakkanad</p>
                                        <p>Kerala</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <p style="padding-top: 15px;font-weight: 700;">VAT ID : 12356</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right" style="">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;">
                                        <table>
                                            <tr style="font-size: 11px;">
                                                <td>Invoice No</td>
                                                <td style="padding: 8px 10px;">:</td>
                                                <td>INV0001</td>
                                            </tr>
                                            <tr style="font-size: 11px;">
                                                <td>Date</td>
                                                <td style="padding: 8px 10px;">:</td>
                                                <td><?= date('d-m-Y') ?></td>
                                            </tr>
                                            <tr style="font-size: 11px;">
                                                <td>Voyage No</td>
                                                <td style="padding: 8px 10px;">:</td>
                                                <td><?= $appointment->appointment_number ?></td>
                                            </tr>
                                            <tr style="font-size: 11px;">
                                                <td>Vessel</td>
                                                <td style="padding: 8px 10px;">:</td>
                                                <td>
                                                    <?php
                                                    $vessel = common\models\Ships::findOne($appointment->vessel);
                                                    echo $vessel->name;
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="invoice-details"style="margin-top: 10px;min-height: 300px;">
                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                            <tr style="background: #607D8B;color: white !important;">
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;">Sl No.</th>
                                <th style="width: 40%;font-size: 12px;padding: 10px 2px;">Particulars</th>
                                <th style="width: 13%;font-size: 12px;padding: 10px 2px;">QUT</th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;">Price</th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;">Amount</th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;">Tax Amount</th>
                            </tr>
                            <?php
                            $p = 0;
                            $total_amount = 0;
                            $total_tax = 0;
                            $grand_total = 0;
                            $count = count($appointment_details);
                            foreach ($appointment_details as $value) {
                                $p++;
                                $particulars = '';
                                $total_amount += $value->total;
                                $total_tax += $value->tax_amount;
                                $grand_total += $value->sub_total;
                                if ($value->service_id == 1) {
                                    $particulars = \common\models\Materials::findOne($value->supplier);
                                    if (isset($particulars->description) && $particulars->description != '')
                                        $particulars = $particulars->description;
                                    else
                                        $particulars = '';
                                }

                                if ($particulars == '') {
                                    $particulars = common\models\Services::findOne($value->service_id);
                                }
                                ?>
                                <tr style="<?= $count != $p ? 'border-bottom: 1px solid #a09c9c;' : '' ?>">
                                    <td style="width: 10%;font-size: 11px;padding: 10px 2px;"><?= $p ?></td>
                                    <td style="width: 40%;font-size: 11px;padding: 10px 2px;"><?= $value->description ?></td>
                                    <td style="width: 13%;font-size: 11px;padding: 10px 2px;"><?= $value->quantity ?></td>
                                    <td style="width: 11%;font-size: 11px;padding: 10px 2px;"><?= $value->unit_price ?></td>
                                    <td style="width: 15%;font-size: 11px;padding: 10px 2px;"><?= $value->total ?></td>
                                    <td style="width: 11%;font-size: 11px;padding: 10px 2px;"><?= $value->tax_amount ?></td>
                                </tr>

                            <?php } ?>

                            <?php
//                            if (isset($appointment_details) && $appointment_details != '') {
//                                $count = count($appointment_details);
//                                $loop_count = 3 - $count;
//                                if ($loop_count > 0) {
//                                    for ($i = 0; $i <= $loop_count; $i++) {
                            ?>
<!--                                        <tr style="border-bottom: 1px solid #a09c9c;">
                                            <td style="width: 10%;font-size: 11px;;padding: 10px 2px;"></td>
                                            <td style="width: 40%;font-size: 11px;padding: 10px 2px;"></td>
                                            <td style="width: 13%;font-size: 11px;padding: 10px 2px;"></td>
                                            <td style="width: 11%;font-size: 11px;padding: 10px 2px;"></td>
                                            <td style="width: 15%;font-size: 11px;padding: 10px 2px;"></td>
                                            <td style="width: 11%;font-size: 11px;padding: 10px 2px;"></td>
                                        </tr>-->
                            <?php
//                                    }
//                                }
//                            }
                            ?>

                        </table>
                    </div>
                    <br/>
                    <div class="invoice-details"style="margin-top: 10px;">
                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                            <tr style="border-top: 1px solid #a09c9c;">
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 40%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 13%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;text-align: right;">Sub Total</th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;text-align: right;"><?= Yii::$app->SetValues->NumberFormat(round($total_amount, 2)); ?></th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;text-align: right;"><?= Yii::$app->SetValues->NumberFormat(round($total_tax, 2)); ?></th>
                            </tr>
                            <tr style="">
                                <th style="width: 10%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 40%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 13%;font-size: 12px;padding: 10px 2px;"></th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;background: #f35a8e;color: white;text-align: right;">Total</th>
                                <th style="width: 15%;font-size: 12px;padding: 10px 2px;background: #f35a8e;"></th>
                                <th style="width: 11%;font-size: 12px;padding: 10px 2px;background: #f35a8e;color: white;text-align: right;"><?= Yii::$app->SetValues->NumberFormat(round(($total_amount + $total_tax), 2)); ?></th>
                            </tr>
                            <tr style="">
                                <th colspan="6" style="width: 100%;font-size: 12px;padding: 10px 2px;text-align: right;"><?php echo ucwords(Yii::$app->NumToWord->ConvertNumberToWords(round($grand_total, 2))) . ' Only'; ?></th>
                            </tr>
                        </table>
                    </div>
                    <div style="clear:both"></div>
                    <br/>


                    <div class="invoice-details"style="margin-bottom: 10px;">
                        <table style="width:100%;">
                            <tr>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;">Signed By</th>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;">Signed By</th>
                                <th style="width: 34%;font-size: 10px;padding: 10px 0px;">Signed By</th>
                            </tr>
                            <tr>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;">Finance Manager</th>
                                <th style="width: 33%;font-size: 10px;padding: 10px 0px;">Accountant</th>
                                <th style="width: 34%;font-size: 10px;padding: 10px 0px;">Manager</th>
                            </tr>
                        </table>
                    </div>

                </td></tr>
            <tr><td>
                    <div class="bank-details">
                        <table style="width:100%;">
                            <tr>
                                <th style="width: 100%;font-size: 12px;text-align: left;">Please transfer the amount in our <b>AED</b> bank account stated in below details:</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">ACCOUNT NAME</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: <b>Alkhalejia</b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">ACCOUNT NO</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: 1234567890123456</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">BANK NAME</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: United Emirates Bank</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">BRANCH</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: UAE</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">IBAN NO</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: 34535454</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;float: left;">SWIFT CODE</td>
                                <td style="font-size: 11px;float: left;text-transform: uppercase;">: 546546</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="width:100%">
                    <div class="footer">
                        <span>
                            <p style="text-transform:uppercase;font-size:12px;">Alkhalejia For Aggregates</p>
                            <p>Trading,import and export</p>
                            <p>TEL: 072041315</p>
                            <p>POST BOX: 072041315</p>
                        </span>
                    </div>
                </td>
            </tr>
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
    <?php
    if ($save) {
        ?>
        <a href="<?= Yii::$app->homeUrl ?>appointment/close-estimate/save-report?estid=<?php echo implode('_', $est_id) ?>"><button onclick="" style="font-weight: bold !important;">Save</button></a>
        <?php
    }
    ?>
</div>