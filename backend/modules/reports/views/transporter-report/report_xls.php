<table style="border: 1px solid;border-collapse: collapse;">
    <thead>
        <tr>
            <th colspan="10" style="border: 1px solid;"><?= common\models\Contacts::findOne($transport)->name; ?> ( <?= date('M Y', strtotime($year . $month . '-01')); ?> )</th>
        </tr>
        <tr>
            <th rowspan="2" style="border: 1px solid;">Date</th>
            <th colspan="4" style="border: 1px solid;">Limestone</th>
            <th colspan="4" style="border: 1px solid;">Gabbro</th>
            <th rowspan="2" style="border: 1px solid;">Total Material</th>
        </tr>
        <tr>
            <th style="border: 1px solid;">LS3/4</th>
            <th style="border: 1px solid;">LS3/8</th>
            <th style="border: 1px solid;">LS3/16</th>
            <th style="border: 1px solid;">Total</th>
            <th style="border: 1px solid;">G3/4</th>
            <th style="border: 1px solid;">G3/8</th>
            <th style="border: 1px solid;">G3/16</th>
            <th style="border: 1px solid;">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($list as $value) {
            $reports = \common\models\DailyEntryDetails::find()->where(['>=', 'received_date', $value . ' 00:00:00'])->andWhere(['<=', 'received_date', $value . ' 60:60:60'])->andWhere(['transporter' => $transport])->all();
            $material_grand_tot = 0;
            $material1_34 = 0;
            $material1_38 = 0;
            $material1_316 = 0;
            $material1_tot = 0;
            $material2_34 = 0;
            $material2_38 = 0;
            $material2_316 = 0;
            $material2_tot = 0;
            if (!empty($reports)) {
                foreach ($reports as $val) {
                    if ($val->material == 1) {
                        $material1_34 += $val->transport_amount;
                        $material1_tot += $val->transport_amount;
                    }
                    if ($val->material == 2) {
                        $material1_38 += $val->transport_amount;
                        $material1_tot += $val->transport_amount;
                    }
                    if ($val->material == 3) {
                        $material1_316 += $val->transport_amount;
                        $material1_tot += $val->transport_amount;
                    }
                    if ($val->material == 4) {
                        $material2_34 += $val->transport_amount;
                        $material2_tot += $val->transport_amount;
                    }
                    if ($val->material == 5) {
                        $material2_38 += $val->transport_amount;
                        $material2_tot += $val->transport_amount;
                    }
                    if ($val->material == 6) {
                        $material2_316 += $val->transport_amount;
                        $material2_tot += $val->transport_amount;
                    }
                }
                $material_grand_tot += $material1_tot;
                $material_grand_tot += $material2_tot;
            }
            ?>
            <tr>
                <td style="border: 1px solid;"><?= $value ?></td>
                <td style="border: 1px solid;"><?= $material1_34 > 0 ? $material1_34 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material1_38 > 0 ? $material1_38 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material1_316 > 0 ? $material1_316 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material1_tot > 0 ? $material1_tot : '-' ?></td>
                <td style="border: 1px solid;"><?= $material2_34 > 0 ? $material2_34 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material2_38 > 0 ? $material2_38 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material2_316 > 0 ? $material2_316 : '-' ?></td>
                <td style="border: 1px solid;"><?= $material2_tot > 0 ? $material2_tot : '-' ?></td>
                <td style="border: 1px solid;"><?= $material_grand_tot > 0 ? $material_grand_tot : '-' ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>