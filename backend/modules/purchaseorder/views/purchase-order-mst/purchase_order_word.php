<htlml>
    <head>
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
            .order-details-tbl{
                border:1px solid #a09c9c;
                border-collapse: collapse;
                text-align: center;
            }
            .order-details-tbl th{
                border:1px solid #a09c9c;
            }
            .order-details-tbl td{
                border:1px solid #a09c9c;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%; float: left;"><img src="http://esl-da.com/alkhalejia/images/logo.png" alt="image"/></td>
                            <td style="width: 50%; float: right;text-align: center;">
                                <div style="margin-bottom:20px;">
                                    <strong style="text-transform:uppercase;font-size:11px;">ALKHALEJIA AGGREGATES fZE</strong>
                                    <p style="margin: 5px;font-size: 14px;">Phone No: 07-204-1315</p>
                                    <p  style="margin: 5px;font-size: 14px;">Email: alkhalejia@rakfzbc.ae</p>
                                    <p style="padding-top: 15px;font-weight: 700;font-size:11px;">VAT ID : 100234434700003</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; float: left;">
                                <table>
                                    <tr style="font-size: 11px;">
                                        <td><strong>ATTENTION</strong></td>
                                        <td style="padding: 3px 10px;">:</td>
                                        <td>
                                            <p>
                                                <?php
                                                if ($order->attenssion != '') {
                                                    $attenssion = common\models\Contacts::findOne($order->attenssion);
                                                    echo $attenssion->name;
                                                } else {
                                                    $attenssion;
                                                }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 11px;">
                                        <td></td>
                                        <td style="padding: 3px 10px;"></td>
                                        <td>
                                            <p style="line-height:18px;"><?= $order->address ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 50%; float: right;text-align: center;">
                                <table>
                                    <tr style="font-size: 11px;">
                                        <td>Date</td>
                                        <td style="padding: 1px 10px;">:</td>
                                        <td><?= $order->date ?></td>
                                    </tr>
                                    <tr style="font-size: 11px;">
                                        <td>LPO No</td>
                                        <td style="padding: 1px 10px;">:</td>
                                        <td><?= $order->reference_no ?></td>
                                    </tr>
                                    <tr style="font-size: 11px;">
                                        <td>Quotation Ref No</td>
                                        <td style="padding: 1px 10px;">:</td>
                                        <td><?= $order->invoice_no ?></td>
                                    </tr>
                                    <tr style="font-size: 11px;">
                                        <td>Vessel</td>
                                        <td style="padding: 1px 10px;">:</td>
                                        <td>
                                            <?php
                                            if ($order->vessel != '') {
                                                $vessel = common\models\Ships::findOne($order->vessel);
                                                echo $vessel->name;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table style="width:100%;">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="heading"><h2 style="font-size:17px;letter-spacing: 4px;padding-top: 35px;margin-top: 20px;">PURCHASE ORDER</h2></div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="invoice-details">
                                        <table style="width:100%;" class="order-details-tbl">
                                            <tr>
                                                <th style="width: 10%;font-size: 12px;padding: 10px 5px;">Sl No.</th>
                                                <th style="width: 60%;font-size: 12px;padding: 10px 2px;">Description</th>
                                                <th style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;">Qty</th>
                                                <th style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;">Amount</th>
                                            </tr>
                                            <?php
                                            $qty_tot = 0;
                                            $amount_tot = 0;
                                            if (!empty($order_details)) {
                                                $i = 0;
                                                foreach ($order_details as $order_detail) {
                                                    $i++;
                                                    ?>
                                                    <tr>
                                                        <td style="width: 10%;font-size: 12px;padding: 10px 5px;"><?= $i ?></td>
                                                        <td style="width: 60%;font-size: 12px;padding: 10px 2px;"><?= $order_detail->description ?></td>
                                                        <td style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;"><?= $order_detail->qty ?></td>
                                                        <td style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;"><?= $order_detail->total ?></td>
                                                    </tr>
                                                    <?php
                                                    $qty_tot += $order_detail->qty;
                                                    $amount_tot += $order_detail->total;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td style="width: 10%;font-size: 12px;padding: 10px 5px;"></td>
                                                <td style="width: 60%;font-size: 12px;padding: 10px 2px;">Total</td>
                                                <td style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;"><?= $qty_tot ?></td>
                                                <td style="width: 15%;font-size: 12px;padding: 10px 5px;text-align: right;"><?= sprintf('%0.2f', $amount_tot); ?></td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="invoice-details"style="margin-top: 30px;">
                                        <table style="width:100%;text-align: left;font-weight:600;text-transform: uppercase;" class="order-details-tbl">
                                            <?php if ($order->eta != '') { ?>
                                                <tr>
                                                    <td style="width: 10%;font-size: 11px;padding: 7px 5px;">Vessel ETA : <?= $order->eta ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                            <?php if ($order->port != '') { ?>
                                                <tr>
                                                    <td style="width: 10%;font-size: 11px;padding: 7px 5px;">PORT :
                                                        <?php
                                                        echo \common\models\Ports::findOne($order->port)->port_name;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                            <?php if ($order->payment_terms != '') { ?>
                                                <tr>
                                                    <td style="width: 10%;font-size: 11px;padding: 7px 5px;">PAYMENT TERMS : <?= $order->payment_terms ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                            <?php if ($order->agent_details != '') { ?>
                                                <tr>
                                                    <td style="width: 10%;font-size: 11px;padding: 7px 5px;">AGENCY DETAILS : <?= $order->agent_details ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                            <?php
                                            if (!empty($order_additional)) {
                                                foreach ($order_additional as $additional) {
                                                    if ($additional->label != '' && $additional->value != '') {
                                                        ?>
                                                        <tr>
                                                            <td style="width: 10%;font-size: 11px;padding: 7px 5px;"><?= $additional->label ?> : <?= $additional->value ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </table>

                                    </div>
                                    <div style="margin-top: 75px;margin-bottom: 35px;">
                                        <p style="font-weight: 600;font-size: 12px;">Al Khalejia Aggregates</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="width:100%">
                                    <div class="footer">
                                        <span>
                                            <p style="font-size:11px;font-weight: 600;">Office 304-305-306-A, BC-4 RAKFZ, P.O.Box 30381 Nakheel RAK UAE</p>
                                            <p>Email : alkhalejia@rakfzbc.ae, FAX No : 072041317, Mobile No : 050-5300331</p>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
</htlml>