<main class="page-content">
    <div class="container-fluid">
        <?php $date = date_create($this->uri->segment(4)); ?>
        <h2>Summary Feereport</h2>
        <p>
            (<?= date_format($date, "F - Y") ?>)
        </p>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <a href="<?= site_url() ?>portal/feereport" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Back
                </a>
                <span class="ml-2 mr-2 pembatas">|</span>
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
        <div id="convert" class="row">
            <div class="col-lg-6 col-6">
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Dollar</h5>
                            <?php if (count($dollar) > 0) { ?>
                                <p>Periode: <strong><?= date_format(date_create($dollar[0]['created_at']), "j M Y") ?></strong> - Now</p>
                            <?php } ?>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">IDR</span>
                                <input type="text" class="form-control" id="dollar_to_rupiah" />
                                <button class="btn btn-primary" type="button" id="btn_convert_dollar">Update</button>
                            </div>
                            <input type="hidden" class="form-control" id="price_dollar" name="value" value='<?= count($dollar) > 0 ? $dollar[0]['value'] : "0" ?>' placeholder="Input Your Nominal">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <div class="mt-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Euro</h5>
                            <?php if (count($euro) > 0) { ?>
                                <p>Periode: <strong><?= date_format(date_create($euro[0]['created_at']), "j M Y") ?></strong> - Now</p>
                            <?php } ?>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">IDR</span>
                                <input type="text" class="form-control" id="euro_to_rupiah" />
                                <button class="btn btn-primary" type="button" id="btn_convert_euro">Update</button>
                            </div>
                            <input type="hidden" class="form-control" id="price_euro" name="value" value='<?= count($euro) > 0 ? $euro[0]['value'] : "0" ?>' placeholder="Input Your Nominal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="invoice row" style="font-size:12px">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <br>

            <!-- <?= print_r($feereport_temp_lesson) ?>
            <br><br><br>
            <?= print_r($course_temp) ?>
            <br><br><br>
            <?= var_dump($course_temp2) ?> -->
            <div class="col-lg-12">
                <h5 class="text-center">Offline Lesson</h5>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>ID Teacher</th>
                                <th>Teacher</th>
                                <th>Instrument</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Package</th>
                                <th>Tuition</th>
                                <th>Total Tuition (invoice)</th>
                                <th style="width: 10%;">Total Feereport</th>
                                <th style="width: 10%;">Payment</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                        <span style="display:none;" id="total_offline"></span>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="col-lg-12 mt-4">
                <h5 class="text-center">Online Lesson</h5>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>ID Teacher</th>
                                <th>Teacher</th>
                                <th>Instrument</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Package</th>
                                <th>Tuition</th>
                                <th>Total Tuition (invoice)</th>
                                <th style="width: 10%;">Total Feereport</th>
                                <th style="width: 10%;">Payment</th>
                            </tr>
                        </thead>
                        <tbody id="show_data2">

                        </tbody>
                        <span style="display:none;" id="total_online"></span>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="col-lg-12 pt-4">
                <h5 class="text-center">Other(s)</h5>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Teacher</th>
                                <th>Teacher</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th style="width: 10%;">Total Other(s)</th>
                                <th style="width: 10%;">Payment</th>
                            </tr>
                        </thead>
                        <tbody id="show_data3">
                            <?php $temp_data_other_teacher = '' ?>
                            <?php $tot_other_full = []; ?>
                            <?php $tot_invoice_full = []; ?>
                            <?php if (count($data_other_teacher) > 0) { ?>
                                <?php for ($i = 0; $i < count($data_other_teacher); $i++) : ?>
                                    <?php $data_other_teacher_ex = explode("-", $data_other_teacher[$i]); ?>
                                    <tr>
                                        <?php if ($data_other_teacher_ex[0] != $temp_data_other_teacher) : ?>
                                            <td style="width: 10%;" rowspan="<?= count($data_other_teacher_count[$data_other_teacher_ex[0]]); ?>">
                                                <?= $data_other_teacher_ex[0] ?>
                                            </td>
                                            <td style="width: 10%;" rowspan="<?= count($data_other_teacher_count[$data_other_teacher_ex[0]]); ?>">
                                                <?= $data_other_teacher_ex[5] ?>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?= $data_other_teacher_ex[1] ?><br>
                                            <small><?= $data_other_teacher_ex[2] ?></small>
                                        </td>
                                        <td>
                                            <?php $tot_invoice[$data_other_teacher_ex[0]][] = $data_other_teacher_ex[3]; ?>
                                            <?php $tot_other_full[] = $data_other_teacher_ex[3]; ?>
                                            Rp <?= number_format($data_other_teacher_ex[3], 0, ".", ".") ?>
                                        </td>
                                        <?php if ($data_other_teacher_ex[0] != $temp_data_other_teacher) : ?>
                                            <td style="width: 10%;" rowspan="<?= count($data_other_teacher_count[$data_other_teacher_ex[0]]); ?>">
                                                Rp <?= number_format(array_sum($data_other_teacher_count[$data_other_teacher_ex[0]]), 0, ".", ".") ?>
                                            </td>
                                            <td style="width: 10%;" rowspan="<?= count($data_other_teacher_count[$data_other_teacher_ex[0]]); ?>">
                                                <div>
                                                    <input name="date" value="<?= $get_payment_date[$data_other_teacher_ex[0]] ?>" id="payment_date_other<?= $data_other_teacher_ex[0] ?>" type="date" onchange="handler<?= $data_other_teacher_ex[0] ?>(event);">
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                        <?php $temp_data_other_teacher = $data_other_teacher_ex[0] ?>
                                    </tr>
                                <?php endfor; ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="10" class="text-center bg-light"><small>Data Not Available</small></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="col-lg-12 pt-4">
                <h5 class="text-center">Trial</h5>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white table-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Teacher</th>
                                <th>Teacher Name</th>
                                <th>Total Trial</th>
                                <th>Tuition</th>
                                <th style="width: 10%;">Total Feereport</th>
                                <th style="width: 10%;">Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($feereport_temp_trial != null) { ?>
                                <?php for ($i = 0; $i < count($feereport_temp_trial); $i++) : ?>
                                    <tr>
                                        <td>
                                            <?= substr($feereport_temp_trial[$i], 0, 6) ?>
                                        </td>
                                        <td>
                                            <?= substr($feereport_temp_trial[$i], 7) ?>
                                        </td>
                                        <td>
                                            <?= count($summary_feereport_trial[$feereport_temp_trial[$i]]) ?>
                                        </td>
                                        <td>
                                            <?= "Rp" . number_format(100000, 0, ".", "."); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <?php $tot_trial = count($summary_feereport_trial[$feereport_temp_trial[$i]]) * 100000 ?>
                                            <?php $tot_invoice_full[] = $tot_trial; ?>
                                            <?= "Rp" . number_format($tot_trial, 0, ".", "."); ?>
                                        </td>
                                        <td style="width: 10%;">
                                            <div>
                                                <input name="date" value="<?= $get_payment_date[substr($feereport_temp_trial[$i], 0, 6)] ?>" id="payment_date_trial<?= substr($feereport_temp_trial[$i], 0, 6) ?>" type="date" onchange="handler<?= substr($feereport_temp_trial[$i], 0, 6) ?>(event);">
                                            </div>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="10" class="text-center bg-light"><small>Data Not Available</small></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <h5>Grand Total</h5>
                                </td>
                                <td style="width: 24%;" class="pl-4 pr-4 p-0 pt-2">
                                    <div id="tot_other_invoice" style="display:none">

                                    </div>
                                    <div id="tot_invoice_parent" style="display:none">
                                        <?= array_sum($tot_invoice_full) - array_sum($tot_other_full) ?>
                                    </div>
                                    <p style="text-align:left; font-size:20px">
                                        Rp
                                        <span style="float:right;" id="total">

                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $('#printInvoice').click(function() {
        $('.btn').remove();
        $('.pembatas').remove();
        $('#convert').remove();
        Popup($('.invoice')[0].outerHTML);

        function Popup(data) {
            window.print();
            return true;
        }
    });
    $(document).ready(function() {
        show_data();
        show_data2();
        var price_dollar = document.getElementById('price_dollar');
        var dollar_to_rupiah = document.getElementById('dollar_to_rupiah');
        dollar_to_rupiah.value = price_dollar.value;
        dollar_to_rupiah.value = formatConvertDollar(dollar_to_rupiah.value);
        //euro
        var price_euro = document.getElementById('price_euro');
        var euro_to_rupiah = document.getElementById('euro_to_rupiah');
        euro_to_rupiah.value = price_euro.value;
        euro_to_rupiah.value = formatConvertEuro(euro_to_rupiah.value);
    });
    <?php for ($i = 0; $i < count($name_teacher); $i++) : ?>
        <?php $idp = explode("-", $name_teacher[$i]) ?>

        function handler<?= $idp[0] ?>(e) {
            var datepick = e.target.value;
            // console.log(datepick);
            // console.log(<?= $idp[0] ?>);
            $.ajax({
                url: "<?= base_url() ?>portal/C_Admin/update_date_payment/<?= $this->uri->segment(4) ?>/<?= $idp[0] ?>",
                data: {
                    "date": datepick,
                },
                success: function(data) {
                    var offline_date = document.getElementById("payment_date_offline<?= $idp[0] ?>").value;
                    var online_date = document.getElementById("payment_date_online<?= $idp[0] ?>").value;
                    var other_date = document.getElementById("payment_date_other<?= $idp[0] ?>").value;
                    if (offline_date != null) {
                        document.getElementById("payment_date_offline<?= $idp[0] ?>").value = datepick;
                    }
                    if (online_date != null) {
                        document.getElementById("payment_date_online<?= $idp[0] ?>").value = datepick;
                    }
                    if (other_date != null) {
                        document.getElementById("payment_date_other<?= $idp[0] ?>").value = datepick;
                    }

                },
            });
        };
    <?php endfor; ?>

    function show_data() {
        $.ajax({
            url: "<?= base_url() ?>portal/C_Admin/get_data_feereport_summary_offline/<?= $this->uri->segment(4) ?>",
            data: {
                "periode": "<?= $this->uri->segment(4) ?>",
            },
            success: function(data) {
                $("#show_data").html(data);
                var count_data = $('#count_data').text();
                var total = 0;

                for (i = 0; i < count_data; i++) {
                    $('#tot_lah' + i).append(formatRupiah($('#temp_lah' + i).text(), 'Rp.'));
                    total += parseInt($('#temp_lah' + i).text());
                }

                var tot_invoice_parent = parseInt($('#tot_invoice_parent').text());
                var total_online = parseInt($('#total_online').text());
                $('#total_offline').append(total);
                var total_akhir = parseInt(total + tot_invoice_parent + total_online);
                $('#total').html(convertToRupiah(total_akhir));
            }
        });
    }

    function show_data2() {
        $.ajax({
            url: "<?= base_url() ?>portal/C_Admin/get_data_feereport_summary_online/<?= $this->uri->segment(4) ?>",
            data: {
                "periode": "<?= $this->uri->segment(4) ?>",
            },
            success: function(data) {
                $("#show_data2").html(data);
                var count_data = $('#count_data2').text();
                var total = 0;

                for (i = 0; i < count_data; i++) {
                    $('#tot_lah2' + i).append(formatRupiah($('#temp_lah2' + i).text(), 'Rp.'));
                    total += parseInt($('#temp_lah2' + i).text());
                }

                var tot_invoice_parent = parseInt($('#tot_invoice_parent').text());
                var total_offline = parseInt($('#total_offline').text());
                $('#total_online').append(total);
                var total_akhir = parseInt(total + tot_invoice_parent + total_offline);
                $('#total').html(convertToRupiah(total_akhir));
            }
        });
    }

    function convertToRupiah(angka) {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
        return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp.' + rupiah : '');
    }
</script>
<script>
    $("#btn_convert_dollar").on('click', function() {
        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>portal/C_Admin/updateConvert/dollar',
            data: {
                "value": document.getElementById("price_dollar").value,
                "periode": "<?= $this->uri->segment(4) ?>",
            },
            success: function(data) {
                alert("Update Successfully!");
            }
        });
    });
    var price_dollar = document.getElementById('price_dollar');
    var dollar_to_rupiah = document.getElementById('dollar_to_rupiah');
    var valuee = '';
    dollar_to_rupiah.addEventListener('keyup', function(e) {
        dollar_to_rupiah.value = formatConvertDollar(this.value);
        valuee = dollar_to_rupiah.value;
        price_dollar.value = valuee.split('.').join("");
    });

    function formatConvertDollar(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            dollar_to_rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            dollar_to_rupiah += separator + ribuan.join('.');
        }

        dollar_to_rupiah = split[1] != undefined ? dollar_to_rupiah + ',' + split[1] : dollar_to_rupiah;
        return prefix == undefined ? dollar_to_rupiah : (dollar_to_rupiah ? 'Rp. ' + dollar_to_rupiah : '');
    }
</script>
<script>
    $("#btn_convert_euro").on('click', function() {
        $.ajax({
            type: "POST",
            url: '<?= site_url() ?>portal/C_Admin/updateConvert/euro',
            data: {
                "value": document.getElementById("price_euro").value,
                "periode": "<?= $this->uri->segment(4) ?>",
            },
            success: function(data) {
                alert("Update Successfully!");
            }
        });
    });
    var price_euro = document.getElementById('price_euro');
    var euro_to_rupiah = document.getElementById('euro_to_rupiah');
    var valuee = '';
    euro_to_rupiah.addEventListener('keyup', function(e) {
        euro_to_rupiah.value = formatConvertEuro(this.value);
        valuee = euro_to_rupiah.value;
        price_euro.value = valuee.split('.').join("");
    });

    function formatConvertEuro(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            euro_to_rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            euro_to_rupiah += separator + ribuan.join('.');
        }

        euro_to_rupiah = split[1] != undefined ? euro_to_rupiah + ',' + split[1] : euro_to_rupiah;
        return prefix == undefined ? euro_to_rupiah : (euro_to_rupiah ? 'Rp. ' + euro_to_rupiah : '');
    }
</script>