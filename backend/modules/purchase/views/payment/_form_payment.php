<div class="table-responsive form-control-new" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true" style="overflow: visible;">
    <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="bill-receipt">
        <thead>
            <tr>
                <th data-priority="3">Date</th>
                <th data-priority="6" style="">Transaction ID</th>
                <th data-priority="6" style="">Invoice Amount</th>
                <th data-priority="6" style="">Due Amount</th>
                <th data-priority="6" style="">Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($payment_details)) {
                $i = 0;
                $invoice_amount_total = 0;
                $due_amount_total = 0;
                foreach ($payment_details as $value) {
                    $i++;
                    ?>
                    <tr id="<?= $i ?>">
                        <td>
                            <?= $value->transaction_date ?>
                            <input type="hidden" name="sale_date[<?= $i ?>]" value="<?= $value->transaction_date ?>"/>
                        </td>
                        <td>
                            <?= $value->id ?>
                            <input type="hidden" name="invoice_number[<?= $i ?>]" value="<?= $value->id ?>"/>
                        </td>
                        <td>
                            <?= $value->debit_amount ?>
                            <input type="hidden" name="invoice_amount[<?= $i ?>]" value="<?= $value->debit_amount ?>"/>
                        </td>
                        <td>
                            <span id="balance_<?= $i ?>"><?= $value->balance_amount ?></span>
                            <input type="hidden" name="sale_balance[<?= $i ?>]" value="<?= $value->balance_amount ?>"/>
                        </td>
                        <td><input type="text" id="payed_amount-<?= $i ?>" name="payed_amount[<?= $i ?>]" class="payed_amount" value="" autocomplete="off" /></td>
                    </tr>
                    <?php
                    $invoice_amount_total += $value->debit_amount;
                    $due_amount_total += $value->balance_amount;
                }
                ?>
            </tbody>
            <tfoot>
                <tr style="font-weight:bold;">
                    <td colspan="2"><span style="text-align:centre;">Total</span></td>
                    <td><input type="text" value="<?= sprintf('%0.2f', $invoice_amount_total); ?>" name="invoice_amount_total" class="invoice_amount_total" style="border:none;outline: none;" readonly tabindex="-1"/></td>
                    <td><input type="text" value="<?= sprintf('%0.2f', $due_amount_total); ?>" name="due_amount_total" class="due_amount_total" style="border:none;outline: none;" readonly tabindex="-1"/></td>
                    <td><input type="text" value="" name="amount_paid_total" class="amount_paid_total" style="border:none;outline: none;" readonly tabindex="-1"/></td>
                </tr>
            </tfoot>
        <?php }
        ?>
    </table>
</table>
</div>