<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $title ?></title>

    <meta name="title" property="title" data-react-helmet="true" content="<?= $title ?>">
    <meta data-react-helmet="true" content="<?= $title ?>" name="og:title" property="og:title">
    <meta data-react-helmet="true" content="<?= $description ?>" name="description" property="description">
    <meta data-react-helmet="true" content="<?= $description ?>" name="og:description" property="og:description">

    <meta content="<?= base_url() ?>assets/img/logo-1.png" name="og:image" property="og:image">
    <meta content="Etude" name="og:site_name" property="og:site_name">
    <meta content="website" name="og:type" property="og:type">

    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styleInvoice.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css" />

    <script src="<?= base_url('assets/js/fontawesome.min.js'); ?>"></script>
</head>

<body>
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
                <!-- <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> -->
            </div>
            <hr>
        </div>
        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
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
        <?php endif; ?>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a href="<?= site_url('portal') ?>" style="text-decoration:none">
                                <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo Etude" width="300px">
                            </a>
                            <br><br>
                            <h5 style="font-weight:bold">ETUDE MUSIC CENTRE</h5 style="font-weight:bold">
                            <small>Soho Capital - Central Park 32nd Floor/No.7 Jl. Letjend S. Parman Kav 28 Jakarta Barat 11470</small>
                            <small>etudemusiccentre@gmail.com | 0821-2231-4248</small>
                        </div>
                        <div class="col company-details">
                            <h2 class="name" style="color:black">
                                Fee Report
                            </h2>
                        </div>
                    </div>
                </header>
                <main class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-8 border p-3">
                            <h5><?= $teacher[0]['name_teacher'] ?></h5>
                            <div>
                                <?= str_replace('~', ' ', $teacher[0]['address_teacher']); ?>
                            </div>
                            <div>
                                <?= $teacher[0]['phone_teacher'] ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4 border p-3">
                            <table border="0" class="table-white" cellpadding="0" cellspacing="0" style="padding:0;width: 100%;">
                                <?php $date = date_create($this->uri->segment(4)); ?>
                                <tbody>
                                    <tr>
                                        <td style="width: 50%;">Instrument:</td>
                                        <td class="text-right" style="width: 50%;"><?= $teacher[0]['instrument'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Status:</td>
                                        <td class="text-right" style="width: 50%;">
                                            <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                Admin
                                            <?php else : ?>
                                                Teacher
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr style="font-weight:bold">
                                        <td style="width: 50%;">Month:</td>
                                        <td class="text-right" style="width: 50%;">
                                            <?php
                                            $startdate = strtotime($this->uri->segment(4));
                                            $enddate = strtotime("-1 months", $startdate);
                                            $temp_date =  date("F", $enddate);
                                            ?>
                                            <?= $temp_date ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Paid Date:</td>
                                        <td class="text-right" style="width: 50%;">
                                            <?php $date2 = date_format($date, "F Y") ?>
                                            10 <?= $date2 ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br>
                    <h5>
                        Feereport Details:
                    </h5>
                    <p>Offline Lesson</p>
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Pack</th>
                                <th>Price/Pack</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">

                        </tbody>
                        <span style="display:none;" id="total_offline"></span>
                    </table>

                    <p>Online Lesson</p>
                    <table id="example2" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Pack</th>
                                <th>Price/Pack</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="show_data2">

                        </tbody>
                        <span style="display:none;" id="total_online"></span>
                    </table>

                    <p>Trial Lesson</p>
                    <table id="example2" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student</th>
                                <th>Lesson Date</th>
                                <th>Total Pack</th>
                                <th>Price/Pack</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="show_data3">
                            <?php $tot_fee_teacher_trial = [] ?>
                            <?php $z = 1 ?>
                            <?php if (count($offline_trial) > 0) : ?>
                                <?php foreach ($offline_trial as $ot) : ?>
                                    <tr>
                                        <td style="width: 3%;">
                                            <?= $z++ ?>
                                        </td>
                                        <td>
                                            <?= $ot['name_student'] ?>
                                        </td>
                                        <td>
                                            <?= substr($ot['date'], 8, 2) ?>
                                        </td>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            Rp 100.000
                                        </td>
                                        <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                            <?php $tot_fee_teacher_trial[] = '100000' ?>
                                            <p style="text-align:left;">
                                                Rp
                                                <span style="float:right;">
                                                    100.000
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td style="width: 3%;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format(array_sum($tot_fee_teacher_trial), 0, ".", ".") ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    Sub Total
                                </td>
                                <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                    <input type="hidden" name="tot_parent" id="total_trial" value="<?= array_sum($tot_fee_teacher_trial) ?>">
                                    <p style="text-align:left;">
                                        Rp
                                        <span style="float:right;">
                                            <?= number_format(array_sum($tot_fee_teacher_trial), 0, ".", ".") ?>
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <p>
                        Other(s):
                    </p>
                    <form action="<?= site_url() ?>portal/C_Admin/add_data_other_feereport" method="POST">
                        <div class="row">
                            <div class="col-lg-12 table_other">
                                <table id="example2" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>Category</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="new_student">
                                        <?php $z = 1; ?>
                                        <?php $other_tot = [] ?>
                                        <?php if (count($event_teacher) > 0) : ?>
                                            <?php foreach ($event_teacher as $oi) : ?>
                                                <tr>
                                                    <td style="width: 3%;">
                                                        <?= $z++ ?>
                                                    </td>
                                                    <td style="width:77%">
                                                        Event - <?= $oi['event_name'] ?><br>
                                                        <small><?= $oi['name_teacher'] ?></small>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <?php $tot_other_invoice[] = $oi['price'] ?>
                                                        <?php $other_tot[] = $oi['price'] ?>
                                                        <p style="text-align:left;">
                                                            Rp
                                                            <span style="float:right;">
                                                                <?= number_format($oi['price'], 0, ".", ".") ?>
                                                            </span>
                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (count($other_feereport) > 0) : ?>
                                            <?php foreach ($other_feereport as $oi) : ?>
                                                <tr>
                                                    <td style="width: 3%;">
                                                        <?= $z++ ?>
                                                    </td>
                                                    <td style="width:77%">
                                                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                            <input class="form-control" type="text" value="<?= $oi['other_note'] ?>" required name="other_note" id="other_note<?= $oi['id_other_feereport'] ?>">
                                                        <?php else : ?>
                                                            Other<br>
                                                            <small><?= $oi['other_note'] ?></small>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <?php $tot_other_feereport[] = $oi['other_price'] ?>
                                                        <?php $other_tot[] = $oi['other_price'] ?>
                                                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                            <div class="row">
                                                                <div class="col-lg-10 row mb-2">
                                                                    <label class="col-lg-3">Rp</label>
                                                                    <input type="text" class="form-control col-lg-9" value="<?= $oi['other_price'] ?>" id="rupiah_other_price<?= $oi['id_other_feereport'] ?>" />
                                                                    <input type="hidden" class="form-control" id="other_price<?= $oi['id_other_feereport'] ?>" name="other_price">
                                                                </div>

                                                                <div class="col-lg-2 mb-2">
                                                                    <a href="<?= site_url() ?>portal/C_Admin/delete_data_other_feereport/<?= $oi['id_other_feereport'] ?>/<?= $this->uri->segment(4) ?>/<?= $teacher[0]['id_teacher'] ?>" class="btn btn-danger" onclick="return confirm('are you sure want to delete this data?')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php else : ?>
                                                            <p style="text-align:left;">
                                                                Rp
                                                                <span style="float:right;">
                                                                    <?= number_format($oi['other_price'], 0, ".", ".") ?>
                                                                </span>
                                                            </p>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                Sub Total
                                            </td>
                                            <td colspan="1" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                                <p style="text-align:left">
                                                    Rp
                                                    <span style="float:right;" id="total_other_feereport">
                                                        <?= number_format(array_sum($other_tot), 0, ".", ".") ?>
                                                    </span>
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class=" pt-2">
                                    <input type="hidden" class="form-control" value=" " id="other_category" required name="other_category1">
                                    <input type="hidden" class="form-control" value=" " id="other_note" required name="other_category1">
                                    <input type="hidden" value="0" class="form-control" id="other_price" name="other_price1">
                                    <input type="hidden" value="1" name="total_other" id="total_other">
                                    <input type="hidden" name="id_teacher" id="id_teacher" value="<?= $teacher[0]['id_teacher'] ?>">
                                    <input type="hidden" name="periode" id="periode" value="<?= $this->uri->segment(4) ?>">
                                    <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>
                    <table class="table-bordered table" style="background-color:#0676BD; color:white;">
                        <tbody>
                            <tr>
                                <td style="width: 80%;" class="text-center">
                                    <h5>Grand Total</h5>
                                </td>
                                <td style="width: 20%;" class="pl-4 pr-4 p-0 pt-2">
                                    <div id="tot_other_feereport" style="display:none">
                                    </div>
                                    <div id="tot_feereport_parent" style="display:none"></div>
                                    <p style="text-align:left; font-size:20px">
                                        Rp
                                        <span style="float:right;" id="total">

                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </main>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>


    <script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/popper.js'); ?>" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/scriptDashboard.js'); ?>"></script>
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script>
        <?php if (count($other_feereport) > 0) : ?>
            <?php foreach ($other_feereport as $oi) : ?>
                var other_price<?= $oi['id_other_feereport'] ?> = document.getElementById('other_price<?= $oi['id_other_feereport'] ?>');
                var rupiah_other_price<?= $oi['id_other_feereport'] ?> = document.getElementById('rupiah_other_price<?= $oi['id_other_feereport'] ?>');
                var valuee<?= $oi['id_other_feereport'] ?> = '';

                var total_other_feereport = <?= array_sum($other_tot) ?>;

                var temp_value_before<?= $oi['id_other_feereport'] ?> = rupiah_other_price<?= $oi['id_other_feereport'] ?>.value;


                rupiah_other_price<?= $oi['id_other_feereport'] ?>.addEventListener('keyup', function(e) {
                    var temp_tot_other = parseInt(total_other_feereport) - parseInt(temp_value_before<?= $oi['id_other_feereport'] ?>);
                    rupiah_other_price<?= $oi['id_other_feereport'] ?>.value = formatRupiah(this.value);
                    valuee<?= $oi['id_other_feereport'] ?> = rupiah_other_price<?= $oi['id_other_feereport'] ?>.value;
                    other_price<?= $oi['id_other_feereport'] ?>.value = valuee<?= $oi['id_other_feereport'] ?>.split('.').join("");

                    var value_temp = other_price<?= $oi['id_other_feereport'] ?>.value;
                    console.log(temp_tot_other);
                    console.log(value_temp);

                    var tot_parent_offline = parseInt($('#tot_parent_offline').val());
                    var tot_parent_online = parseInt($('#tot_parent_online').val());
                    var total_trial = parseInt(document.getElementById('total_trial').value);

                    var b = parseInt(value_temp) + parseInt(temp_tot_other);

                    var c = parseInt(tot_parent_offline + tot_parent_online + total_trial) - parseInt(b);

                    // console.log(total);
                    console.log(b);
                    console.log(c);

                    document.getElementById('total_other_feereport').innerHTML = convertToRupiah(b);
                    document.getElementById('total').innerHTML = convertToRupiah(c);

                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_feereport/<?= $oi['id_other_feereport'] ?>',
                        data: {
                            "data": "other_price",
                            "value": value_temp,
                        },
                        success: function(data) {}
                    });
                });

                var other_note<?= $oi['id_other_feereport'] ?> = document.getElementById('other_note<?= $oi['id_other_feereport'] ?>');
                other_note<?= $oi['id_other_feereport'] ?>.addEventListener('keyup', function(e) {
                    var value = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_feereport/<?= $oi['id_other_feereport'] ?>',
                        data: {
                            "data": "other_note",
                            "value": value,
                        },
                        success: function(data) {}
                    });
                });
            <?php endforeach; ?>
        <?php endif; ?>
    </script>
    <script>
        $('#printInvoice').click(function() {
            $('.btn').remove();
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
            <?php if (count($other_feereport) > 0) : ?>
                <?php foreach ($other_feereport as $oi) : ?>
                    var other_price<?= $oi['id_other_feereport'] ?> = document.getElementById('other_price<?= $oi['id_other_feereport'] ?>');
                    var rupiah_other_price<?= $oi['id_other_feereport'] ?> = document.getElementById('rupiah_other_price<?= $oi['id_other_feereport'] ?>');
                    other_price<?= $oi['id_other_feereport'] ?>.value = rupiah_other_price<?= $oi['id_other_feereport'] ?>.value;
                    rupiah_other_price<?= $oi['id_other_feereport'] ?>.value = formatRupiah(rupiah_other_price<?= $oi['id_other_feereport'] ?>.value);
                <?php endforeach; ?>
            <?php endif; ?>
        });

        function show_data() {
            $.ajax({
                url: "<?= base_url() ?>portal/C_Admin/get_data_feereport_teacher_offline",
                data: {
                    "periode": "<?= $this->uri->segment(4) ?>",
                    "id_teacher": "<?= $teacher[0]['id_teacher'] ?>",
                },
                success: function(data) {
                    $("#show_data").html(data);

                    var tot_parent_offline = parseInt($('#tot_parent_offline').val());
                    var tot_parent_online = parseInt($('#tot_parent_online').val());
                    var total_trial = parseInt(document.getElementById('total_trial').value);
                    var other_tot = parseInt(<?= array_sum($other_tot) ?>);

                    var total = parseInt(tot_parent_offline + tot_parent_online + total_trial - other_tot);
                    $('#total').html(convertToRupiah(total));
                }
            });
        }

        function show_data2() {
            $.ajax({
                url: "<?= base_url() ?>portal/C_Admin/get_data_feereport_teacher_online/<?= $this->uri->segment(4) ?>/<?= $teacher[0]['id_teacher'] ?>",
                data: {
                    "periode": "<?= $this->uri->segment(4) ?>",
                    "id_teacher": "<?= $teacher[0]['id_teacher'] ?>",
                },
                success: function(data) {
                    $("#show_data2").html(data);
                    $('#total_online').append($('#tot_parent_online').val());

                    var tot_parent_offline = parseInt($('#tot_parent_offline').val());
                    var tot_parent_online = parseInt($('#tot_parent_online').val());
                    var total_trial = parseInt(document.getElementById('total_trial').value);
                    var other_tot = parseInt(<?= array_sum($other_tot) ?>);

                    var total = parseInt(tot_parent_offline + tot_parent_online + total_trial - other_tot);
                    $('#total').html(convertToRupiah(total));
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

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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
</body>

</html>