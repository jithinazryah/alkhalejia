/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(function () {

        $(document).on('click', '.modalButton', function () {

                $('#modal').modal('show')
                        .find('#modalContent')
                        .load($(this).attr("value"));
        });

    /***************Daily Entry**********************/
    $('body').on('change', '.netweight', function () {
        var ids = $(this).attr('id');
        var id = ids.split("_");
        $('#total_' + id[1]).val('');
        var netweight = $('#' + ids).val();
        var rate = $('#rate_' + id[1]).val();
        if (rate != "") {
            var total = rate * netweight;
            $('#total_' + id[1]).val(total);
        }
//            alert(rate);
        });
    $('body').on('change', '.rate', function () {
        var ids = $(this).attr('id');
        var id = ids.split("_");
        $('#total_' + id[1]).val('');
        var rate = $('#' + ids).val();
        var netweight = $('#netweight_' + id[1]).val();
        if (netweight != "") {
            var total = rate * netweight;
            $('#total_' + id[1]).val(total);
                        }
//            alert(rate);
                });
//            

        //----------------Appointment service-----------------//
        $('#appointmentdetails-service_id').change(function () {
                var service_id = $(this).val();
                $.ajax({
                        type: 'POST',
                        cache: false,
                        data: {service_id: service_id},
                        url: homeUrl + 'appointment/appointment/supplier',
                        success: function (data) {
                                if (data != '') {
                                        $("#appointmentdetails-supplier").html(data);
                                        $("#appointmentdetails-unit_price").val('');
                                        $("#appointmentdetails-tax").val('');
                                } else {
                                        $("#appointmentdetails-supplier").prop('disabled', true);
                                }
                        }
                });
        });

        $('#appointmentdetails-supplier').change(function () {

                var supplier = $(this).val();
                var service = $('#appointmentdetails-service_id').val();
                if (service && supplier) {

                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {service_id: service, supplier_id: supplier},
                                url: homeUrl + 'appointment/appointment/rate',
                                success: function (data) {
                                        if (data != '') {

                                                var res = $.parseJSON(data);
                                                $("#appointmentdetails-unit_price").val(res['rate']);
                                                $("#appointmentdetails-tax").val(res['tax']);
                                                Total();
                                                Tax();
                                                SubTotal();
                                        } else {
                                                $("#appointmentdetails-supplier").prop('disabled', true);
                                        }
                                }
                        });

                } else {
                        $('#appointmentdetails-supplier').val('');
                        alert('Please select a service');
                }
        });


        $('#appointmentdetails-quantity').keyup(function () {
                Total();
                Tax();
                SubTotal();
        });
        $('#appointmentdetails-unit_price').keyup(function () {
                Total();
                SubTotal();
        });
        $('#appointmentdetails-tax').change(function () {

                Tax();
                SubTotal();
        });
        function Total() {
                var quantity = $('#appointmentdetails-quantity').val();
                var rate = $('#appointmentdetails-unit_price').val();
                if (quantity && rate) {
                        var total = quantity * rate;
                        var total = total.toFixed(2);
                        $('#appointmentdetails-total').val(total);
                }
        }

        function Tax() {

                var tax = $('#appointmentdetails-tax').val();
                var total = $('#appointmentdetails-total').val();
                var tax_amount = (total * tax) / 100;
                var tax_amount = tax_amount.toFixed(2);
                $('#appointmentdetails-tax_amount').val(tax_amount);
        }
        function SubTotal() {
                var subtotal = 0;
                var total = $('#appointmentdetails-total').val();
                var tax = $('#appointmentdetails-tax_amount').val();
                if (tax == '') {
                        tax = 0;
                }
                if (total != '')
                        var subtotal = parseFloat(total) + parseFloat(tax);

                $('#appointmentdetails-sub_total').val(subtotal.toFixed(2));
        }


});
function showLoader() {
        $('.page-loading-overlay').removeClass('loaded');
}
function hideLoader() {
        $('.page-loading-overlay').addClass('loaded');
}


