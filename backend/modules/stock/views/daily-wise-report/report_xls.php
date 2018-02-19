<?php
$contacts = \common\models\Contacts::find()->where(['status' => 1, 'type' => 2, 'service' => 1])->all();
?>
<table class='' style="border: 1px solid;border-collapse: collapse;">
    <caption><h4 style="color: #1c5382;margin-bottom: 15px;">Report <?= date('d-m-Y', strtotime($data['report_date'])) ?> :</h4></caption>
    <tr>
        <th style="border: 1px solid;">Crusher</th>
        <?php
        $material_data = explode(',', $data['material_id']);
        foreach ($material_data as $value) {
            $material_detail = common\models\Materials::findOne($value);
            ?>
            <th style="border: 1px solid;"><?= $material_detail->name ?></th>
        <?php } ?>
        <th style="border: 1px solid;">Total</th>
    </tr>
    <?php
    $c = 0;
    foreach ($contacts as $crusher) {



        $crusher_detail = \common\models\Contacts::findOne($crusher->id);

        $total_material_entry_count = 0;
        foreach ($material_data as $material_trip) {
            $materials_entry = \common\models\DailyEntry::find()->where(['material' => $material_trip, 'supplier' => $crusher->id, 'DOC' => $model->DOC])->all();

            $materials_entry_count = 0;
            foreach ($materials_entry as $materials_entry_per) {
                $materials_entry_count = \common\models\DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
            }
            $total_material_entry_count += $materials_entry_count;
        }

        if ($total_material_entry_count > 0) {
            $c++;
            ?>


            <tr>
                <td colspan="3"><h5 style="font-weight:bold;color: #008cbd;text-align: left;text-transform: uppercase;border: 1px solid;"><?= $crusher_detail->name ?></h5></td>
            </tr>



            <tr>
                <td style="border: 1px solid;">Trips</td>
                <?php
                $total_mat_count_net = 0;
                foreach ($material_data as $material_trip) {
                    $materials_entry = \common\models\DailyEntry::find()->where(['material' => $material_trip, 'supplier' => $crusher->id, 'DOC' => $model->DOC])->all();
                    $materials_entry_count = 0;
                    $total_mat_count = 0;
                    $j = 0;
                    foreach ($materials_entry as $materials_entry_per) {
                        $j++;

                        $materials_entry_count = \common\models\DailyEntryDetails::find()->where(['daily_entry_id' => $materials_entry_per->id])->count();
                        $total_mat_count += $materials_entry_count;
                    }
                    $total_mat_count_net += $total_mat_count;
                    ?>
                    <td style="border: 1px solid;"><?php
                        if ($total_mat_count > 0) {
                            echo $total_mat_count;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>
                    <?php
                }
                ?>
                <td style="border: 1px solid;"><?= $total_mat_count_net ?></td>
            </tr>

            <tr>
                <td style="border: 1px solid;">Net Weight</td>
                <?php
                $total_materials_entry_weight_net = 0;
                foreach ($material_data as $material_weight) {
                    $total_materials_entry_weight = 0;
                    $materials_entry_weight = \common\models\DailyEntry::find()->where(['material' => $material_weight, 'supplier' => $crusher->id, 'DOC' => $model->DOC])->all();
                    $materials_weight_count = 0;
                    foreach ($materials_entry_weight as $materials_weight_per) {
                        $materials_weight_count = \common\models\DailyEntryDetails::find()->where(['daily_entry_id' => $materials_weight_per->id])->sum('net_weight');
                        $total_materials_entry_weight += $materials_weight_count;
                    }
                    $total_materials_entry_weight_net += $total_materials_entry_weight;
                    ?>

                    <td style="border: 1px solid;"><?php
                        if ($total_materials_entry_weight > 0) {
                            echo Yii::$app->SetValues->NumberFormat($total_materials_entry_weight);
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>


                <?php } ?>
                <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_materials_entry_weight_net); ?></td>
            </tr>


            <?php
        }
    }
    ?>


    <?php
    $previous_date = date('Y-m-d', strtotime($model->DOC . "-1 days"));
    ?>
    <tr>
        <td style="border: 1px solid;"><b><?= date('d-m-Y', strtotime($previous_date)) ?></b></td>
        <?php
        $previous_stock = 0;
        $total_previous_stock_net = 0;
        foreach ($material_data as $material_previous) {
            $total_previous_stock = 0;
            $previous_stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_previous])->andWhere(['<>', 'DOC', $model->DOC])->andWhere(['<', 'DOC', $model->DOC])->sum('quantity_in');

            $total_previous_stock += $previous_stock;
            $total_previous_stock_net += $total_previous_stock;
            ?>

            <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_previous_stock); ?></td>
        <?php } ?>
        <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_previous_stock_net); ?></td>
    </tr>


    <tr>
        <td style="border: 1px solid;"><b><?= date('d-m-Y', strtotime($model->DOC)) ?></b></td>
        <?php
        $stock = 0;
        $total_stock_net = 0;
        foreach ($material_data as $material_stock) {
            $total_stock = 0;
            $stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_stock])->sum('quantity_in');

            $total_stock += $stock;
            $total_stock_net += $total_stock;
            ?>

            <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_stock); ?></td>
        <?php } ?>
        <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_stock_net); ?></td>

    </tr>

    <tr>
        <td style="border: 1px solid;"><b>Export</b></td>
        <?php
        $material_exported = 0;
        $total_material_exported_net = 0;
        foreach ($material_data as $material_exported) {
            $total_material_exported = 0;
            $material_exported = common\models\MaterialUse::find()->where(['sell_date' => $model->DOC])->andWhere(['material_id' => $material_exported])->sum('quantity');
            $total_material_exported += $material_exported;
            $total_material_exported_net += $total_material_exported;
            ?>
            <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_material_exported); ?></td>
        <?php } ?>
        <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total_material_exported_net); ?></td>
    </tr>

    <tr style="font-weight: bold;color: #000">
        <td style="border: 1px solid;">TOTAL NET</td>
        <?php
        $total_net_material_exported = 0;
        $total__net_material_stock = 0;
        $net_material_exported = 0;
        $net_material_stock = 0;
        foreach ($material_data as $material_net) {
            $net_material_exported = common\models\MaterialUse::find()->where(['sell_date' => $model->DOC])->andWhere(['material_id' => $material_net])->sum('quantity');
            $total_net_material_exported += $net_material_exported;
            $net_material_stock = \common\models\Stock::find()->where(['transaction_type' => 3])->andWhere(['material_id' => $material_net])->sum('quantity_in');
            $total__net_material_stock += $net_material_stock;
            ?>
            <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($net_material_stock - $net_material_exported); ?></td>
        <?php } ?>
        <td style="border: 1px solid;"><?= Yii::$app->SetValues->NumberFormat($total__net_material_stock - $total_net_material_exported); ?></td>
    </tr>




</table>