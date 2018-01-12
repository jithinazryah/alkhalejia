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
        body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,th,div{
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
            width: 98%;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
        }
        .print{
            margin-top: 18px;
            margin-left: 375px;
        }
        .save{
            margin-top: 18px;
            margin-left: 6px !important;
        }
        .heading p{
            font-size: 14px;
            line-height: 5px;
        }
    </style>
    <table class="main-tabl" border="0" style="font-family: Roboto, sans-serif !important;">
        <thead>
            <tr>
                <td colspan="2" style="padding-bottom: 1em;">
                    <div class="heading" style="font-weight:normal">
                        <strong style="text-transform:uppercase;font-size:22px;">Alkhalejia For Aggregates</strong>
                        <p>Trading,import and export</p>
                        <p>TEL: 072041315 FAX: 072041317</p>
                        <p>Sales- Purchases : 0505300331</p>
                    </div>
                </td>



            </tr>


            <tr>
                <td>
                    <div class="heading"><h2 style="font-size:13px;">TAX INVOICE</h2></div>
                    <br/>
                    <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                        <div class="main-left">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;"><b>Bill To :</b></td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">Azryah Networks ,Kakkanad</td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right" style="margin-right: 21px;">
                                <!--<table class="tb2">
                                        <tr>
                                                <td style="max-width: 405px"><b>Bill From :</b></td>
                                        </tr>
                                        <tr>
                                                <td style="max-width: 405px;font-size: 15px;">Alkhalejia For Aggregates</td>
                                        </tr>
                                        <tr>
                                                <td style="max-width: 405px;font-size: 15px;"><b>VAT ID : VAT123</td>
                                        </tr>
                                </table>-->
                        </div>
                    </div>
                    <br/>
                    <div class="close-estimate-heading-top" style="margin-bottom:25px;">
                        <div class="main-left">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px;font-size: 11px;">
                                        <table>
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
                        <div class="main-right">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px"><b></b></td>
                                </tr>
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
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <br/>
                </td>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="invoice-details"style="margin-top: 10px;">
                        <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                            <tr>
                                <th style="width: 10%;font-size: 12px;border: 1px solid;padding: 10px 0px;">Sl No.<br>.Ù„Ø§</th>
                                <th style="width: 40%;font-size: 12px;border: 1px solid;padding: 10px 0px;">Particulars<br>ØªÙ�Ø§ØµÙŠÙ„</th>
                                <th style="width: 13%;font-size: 12px;border: 1px solid;padding: 10px 0px;">QUT<br>Ø§Ù„ÙƒÙ…ÙŠØ©</th>
                                <th style="width: 11%;font-size: 12px;border: 1px solid;padding: 10px 0px;">Price<br>Ø§Ù„Ø³Ø¹Ø±</th>
                                <th style="width: 15%;font-size: 12px;border: 1px solid;padding: 10px 0px;">Amount<br>ÙƒÙ…ÙŠØ©</th>
                                <th style="width: 11%;font-size: 12px;border: 1px solid;padding: 10px 0px;">Tax Amount<br>Ù‚ÙŠÙ…Ø© Ø§Ù„Ø¶Ø±ÙŠØ¨Ø©</th>
                            </tr>
                            <?php
                            $p = 0;
                            $total_amount = 0;
                            $total_tax = 0;
                            $grand_total = 0;
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
                                <tr>
                                    <td style="width: 10%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $p ?></td>
                                    <td style="width: 40%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $value->description ?></td>
                                    <td style="width: 13%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $value->quantity ?></td>
                                    <td style="width: 11%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $value->unit_price ?></td>
                                    <td style="width: 15%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $value->total ?></td>
                                    <td style="width: 11%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"><?= $value->tax_amount ?></td>
                                </tr>

                            <?php } ?>

                            <?php
                            if (isset($appointment_details) && $appointment_details != '') {
                                $count = count($appointment_details);
                                $loop_count = 3 - $count;
                                if ($loop_count > 0) {
                                    for ($i = 0; $i <= $loop_count; $i++) {
                                        ?>
                                        <tr>
                                            <td style="width: 10%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                            <td style="width: 40%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                            <td style="width: 13%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                            <td style="width: 11%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                            <td style="width: 15%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                            <td style="width: 11%;font-size: 11px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="4" style="width: 74%;font-size: 10px;border: 1px solid;text-align: left;padding: 10px 0px;"><span style="font-size: 12px;font-weight: 600;text-transform: uppercase;"></span></td>
                                <td style="width: 15%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;font-weight: 600;"><?= Yii::$app->SetValues->NumberFormat(round($total_amount, 2)); ?><br><br><?= Yii::$app->SetValues->NumberArabic($total_amount); ?></td>
                                <td style="width: 11%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;font-weight: 600;"><?= Yii::$app->SetValues->NumberFormat(round($total_tax, 2)); ?><br><br><?= Yii::$app->SetValues->NumberArabic($total_tax); ?></td>
                            </tr>

                        </table>
                    </div>
                    <br/>
                    <div class="invoice-details"style="margin-bottom: 10px;">
                        <table style="width:75%;border: 1px solid black;border-collapse: collapse;float: right;">
                            <tr>
                                <td style="width:40%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">Total Amount(Excl VAT)</td>
                                <td style="width:10%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">AED</td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberFormat(round($total_amount, 2)); ?></td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberArabic($total_amount); ?></td>
                            </tr>
                            <tr>
                                <td style="width:40%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">Total VAT Amount</td>
                                <td style="width:10%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">AED</td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberFormat(round($total_tax, 2)); ?></td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberArabic($total_tax); ?></td>
                            </tr>
                            <tr style="border-top: 1px solid;">
                                <td style="width:40%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">Total Amount</td>
                                <td style="width:10%;text-align: left;padding: 15px 10px;font-size: 12px;font-weight: 600;">AED</td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberFormat(round($grand_total, 2)); ?></td>
                                <td style="width:25%;text-align: right;padding: 15px 10px;font-size: 12px;font-weight: 600;"><?= Yii::$app->SetValues->NumberArabic($grand_total); ?></td>
                            </tr>
                            <tr style="border-top: 1px solid;">
                                <td colspan="4" style="width:40%;text-align: left;padding: 15px 10px;"><span style="font-size: 12px;font-weight: 600;text-transform: uppercase;">AED : <?php echo ucwords(Yii::$app->NumToWord->ConvertNumberToWords(round($grand_total, 2))) . ' Only'; ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div style="clear:both"></div>
                    <br/>


                    <div class="invoice-details"style="margin-bottom: 10px;">
                        <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
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