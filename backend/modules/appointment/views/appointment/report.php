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
                tr{ page-break-inside:avoid; page-break-after:auto; }
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
            padding-top: 20px;
        }
        .print{
            margin-top: 18px;
            margin-left: 375px;
        }
        .save{
            margin-top: 18px;
            margin-left: 6px !important;
        }
    </style>
    <table class="main-tabl" border="0">
        <thead>
            <tr>
                <td>
                    <div class="heading"><h2>TAX INVOICE</h2></div>
                    <br/>
                    <div class="close-estimate-heading-top" style="margin-bottom:78px;">
                        <div class="main-left">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px"><b>Bill To :</b></td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 15px;">Azryah Networks ,Kakkanad</td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 405px"><b>Bill From :</b></td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 15px;">Azryah Networks ,Kakkanad</td>
                                </tr>
                                <tr>
                                    <td style="max-width: 405px;font-size: 15px;"><b>VAT ID : VAT123</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="close-estimate-attival-sailing" style="margin-bottom: 10px;">
                        <div class="main-left">
                            <table class="tb2">
                                <tr>
                                    <td></td> <td style="width: 50px;"></td>
                                    <td style="max-width: 405px">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right">
                            <table class="tb2">
                                <tr>
                                    <td style="font-size: 15px;">Invoice No</td> <td style="width: 50px;text-align: center;font-size: 15px;">:</td>
                                    <td style="max-width: 200px;font-size: 15px;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="close-estimate-attival-sailing" style="margin-bottom: 10px;">
                        <div class="main-left">
                            <table class="tb2">
                                <tr>
                                    <td style="font-size: 15px;">Vessel</td> <td style="width: 50px;font-size: 15px;">:</td>
                                    <td style="max-width: 405px;font-size: 15px;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="main-right">
                            <table class="tb2">
                                <tr>
                                    <td style="font-size: 15px;">Date</td> <td style="width: 50px;text-align: center;font-size: 15px;">:</td>
                                    <td style="max-width: 200px;font-size: 15px;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br/>
                </td>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="invoice-details"style="margin-top: 26px;">
                        <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                            <tr>
                                <th style="width: 10%;font-size: 10px;border: 1px solid;padding: 10px 0px;">Sl No.<br>.لا</th>
                                <th style="width: 40%;font-size: 10px;border: 1px solid;padding: 10px 0px;">Particulars<br>تفاصيل</th>
                                <th style="width: 13%;font-size: 10px;border: 1px solid;padding: 10px 0px;">QUT<br>الكمية</th>
                                <th style="width: 11%;font-size: 10px;border: 1px solid;padding: 10px 0px;">Price<br>السعر</th>
                                <th style="width: 15%;font-size: 10px;border: 1px solid;padding: 10px 0px;">Amount<br>كمية</th>
                                <th style="width: 11%;font-size: 10px;border: 1px solid;padding: 10px 0px;">Tax Amount<br>قيمة الضريبة</th>
                            </tr>
                            <tr>
                                <td style="width: 10%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;">1</td>
                                <td style="width: 40%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                <td style="width: 13%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                <td style="width: 11%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                <td style="width: 15%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                <td style="width: 11%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="width: 74%;font-size: 10px;border: 1px solid;text-align: left;padding: 10px 0px;"><span style="font-size: 12px;font-weight: 600;text-transform: uppercase;">AED : Four Thousand</span></td>
                                <td style="width: 15%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                                <td style="width: 11%;font-size: 10px;border: 1px solid;text-align: center;padding: 10px 0px;"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="invoice-details"style="margin-bottom: 10px;">
                        <table style="width:100%;border: 1px solid black;border-collapse: collapse;border-top: none;">
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
                    <div class="bank-details">
                        <table style="width:100%;">
                            <tr>
                                <th style="width: 100%;font-size: 12px;padding: 10px 0px;text-align: left;">Please transfer the amount in our <b>AED</b> bank account stated in below details:</th>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">ACCOUNT NAME</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: <b>Accountant</b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">ACCOUNT NO</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: Accountant</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">BANK NAME</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: Accountant</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">BRANCH</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: Accountant</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">IBAN NO</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: Accountant</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;font-size: 11px;padding: 10px 0px;float: left;">SWIFT CODE</td>
                                <td style="font-size: 11px;padding: 10px 0px;float: left;text-transform: uppercase;">: Accountant</td>
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