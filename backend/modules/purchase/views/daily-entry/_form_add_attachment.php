<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<span>
        <div class="row daily-entry-span">
                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd' style="width: 5%;">
                        <div class = "form-group field-staffperviousemployer-hospital_address">
                                <h4 class="serial_no" style="margin-top: 32px;"><?= $srl ?>.</h4>

                        </div>
                </div>
                <div class = 'col-md-1 col-sm-12 col-xs-12 left_padd'>
                        <div class = "form-group field-staffperviousemployer-hospital_address">
                                <label class = "control-label">Ticket No.</label>
                                <input class="form-control" type = "text" required="required" name = "DailyEntryDetails[ticket_no][]">

                        </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Truck No.</label>
                                <input class="form-control" type = "text" required="required" name = "DailyEntryDetails[truck_number][]">
                        </div>
                </div>
                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Net Weight</label>
                                <input type="text" class="form-control netweight" id="netweight_<?= $srl?>" required="required" name="DailyEntryDetails[net_weight][]">
                        </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Rate</label>
                                <input type="text" class="form-control rate" id='rate_<?= $srl?>' required="required" name="DailyEntryDetails[rate][]">
                        </div>
                </div>
                <div class='col-md-1 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Total</label>
                                <input type="text" class="form-control total" id='total_<?= $srl?>' readonly="readonly" required="required" name="DailyEntryDetails[total][]">
                        </div>
                </div>

                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Transporter Amount</label>
                                <input type="text" class="form-control" required="required" name="DailyEntryDetails[transport_amount][]">
                        </div>
                </div>

                <div class='col-md-2 col-sm-12 col-xs-12 left_padd'>
                        <div class="form-group field-staffperviousemployer-designation">
                                <label class="control-label" for="">Description</label>
                                <input type="text" class="form-control" name="DailyEntryDetails[description][]">
                        </div>
                </div>
                <div class = "col-md-1 col-sm-12 col-xs-12 left_padd">
                        <a id="remAttach" class="btn btn-icon btn-red remAttach" style="margin-top: 27px;"><i class="fa-remove"></i></a>
                </div>
        </div>
        <div style="clear:both"></div>
</span>

