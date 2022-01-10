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
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="row p-4">
                    <div class="col-lg-7 col-12">
                        <a href="<?= site_url('portal') ?>" style="text-decoration:none">
                            <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo Etude" class="w-50">
                        </a>
                        <br><br>
                        <h5 style="font-weight:bold">ETUDE MUSIC CENTRE</h5 style="font-weight:bold">
                        <small>Soho Capital - Central Park 32nd Floor/No.7 Jl. Letjend S. Parman Kav 28 Jakarta Barat 11470</small>
                        <small>etudemusiccentre@gmail.com | 0821-2231-4248</small>
                    </div>
                    <div class="col-lg-5 col-12 mt-5">
                        <h4 class="name text-center" style="color:black">
                            INVOICE
                        </h4>
                    </div>
                </div>

                <?php $currency = "Rp" ?>
                <?php if (count($package) > 0) : ?>
                    <?php if ($package[0]['currency'] == '3') : ?>
                        <?php $currency = "€" ?>
                    <?php endif ?>
                    <?php if ($package[0]['currency'] == '2') : ?>
                        <?php $currency = "$" ?>
                    <?php endif ?>
                <?php endif ?>

                <div class="row mb-5">
                    <div class="col-md-6 col-lg-6 col-6 p-4" style="border:1px solid;">
                        <h5 style="font-weight:bold"><?= $ortu[0]['parent_student'] ?></h5>
                        <div>
                            <?= $ortu[0]['address_student'] ?>
                        </div>
                        <div>
                            HP: <?= $ortu[0]['phone_parent_1'] ?>
                            <?php if ($ortu[0]['phone_parent_2'] != "") : ?>
                                <?= $ortu[0]['phone_parent_2'] > 0 ? " | " . $ortu[0]['phone_parent_2'] : "" ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-6 p-4" style="border:1px solid;">
                        <table border="0" class="table-white" cellpadding="0" cellspacing="0" style="padding:0;width: 100%;">
                            <?php $date = date_create($this->uri->segment(6)); ?>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">No. Invoice</td>
                                    <td>:</td>
                                    <td class="text-right" style="width: 50%;">
                                        <h5 style="font-weight:bold"><?= $sirkulasi[0]['no_transaksi'] ?></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">ID Parent</td>
                                    <td>:</td>
                                    <td class="text-right" style="width: 50%;"><?= $ortu[0]['id_parent'] ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Month of Invoice</td>
                                    <td>:</td>
                                    <td class="text-right" style="width: 50%;">
                                        <?= date_format(date_create(substr($sirkulasi[0]['created_at'], 0, 10)), "F") ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Due Date</td>
                                    <td>:</td>
                                    <td class="text-right" style="width: 50%;">
                                        <?php $date_1 = date_create(substr($sirkulasi[0]['created_at'], 0, 10)) ?>
                                        <?= date_format(date_add($date_1, date_interval_create_from_date_string("5 days")), "l, d F Y") ?>
                                    </td>
                                </tr>
                                <!-- <tr>
                                        <td style="width: 50%;">Due Date:</td>
                                        <td class="text-right" style="width: 50%;">
                                            <?php $date2 = date_format($date, "F Y") ?>
                                            10 <?= $date2 ?>
                                        </td>
                                    </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 style="font-weight:bold">
                    Invoice Details:
                </h5>
                <br>
                <?php $parents_invoice_others_category = 0 ?>
                <?php $tot_other_invoice = 0 ?>
                <?php $total_rate_lesson = 0; ?>
                <?php $total_rate_event = 0; ?>
                <?php $total_rate_book = 0; ?>
                <p style="<?= count($package) > 0  ? 'font-weight:bold' : 'display:none' ?>"><i>Lesson Package</i></p>

                <div class="table-responsive-sm mb-5" style="<?= count($package) > 0  ? '' : 'display:none' ?>">
                    <table class="table table-bordered table-white" style="<?= count($package) > 0  ? '' : 'display:none' ?>">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student Name</th>
                                <th>Name of Package</th>
                                <th>Lesson Type</th>
                                <th>Lesson Date</th>
                                <th>Total Pack</th>
                                <th>Price/Pack</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $z = 1; ?>
                            <?php for ($i = 0; $i < count($package); $i++) : ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center"><?= $package[$i]['name_student'] ?></td>
                                    <td class="text-center"><?= $package[$i]['name'] ?></td>
                                    <td class="text-center">
                                        <?= $package[$i]['status_pack_practical'] == 1 ? 'Practice' : '' ?>
                                        <br>
                                        <hr>
                                        <?= $package[$i]['status_pack_theory'] == 1 ? 'Theory' : '' ?>
                                    </td>
                                    <td>
                                        <?php for ($j = 0; $j < count($schedule_package[$package[$i]['id_list_pack']][0]); $j++) : ?>
                                            <?php if ($schedule_package[$package[$i]['id_list_pack']][0][$j]['jenis'] == 1) : ?>
                                                <?= date_format(date_create(substr($schedule_package[$package[$i]['id_list_pack']][0][$j]['date_schedule'], 0, 10)), "d/m, ") ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <br>
                                        <hr>
                                        <?php for ($j = 0; $j < count($schedule_package[$package[$i]['id_list_pack']][0]); $j++) : ?>
                                            <?php if ($schedule_package[$package[$i]['id_list_pack']][0][$j]['jenis'] == 2) : ?>
                                                <?= date_format(date_create(substr($schedule_package[$package[$i]['id_list_pack']][0][$j]['date_schedule'], 0, 10)), "d/m, ") ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $package[$i]['total_package'] ?>
                                    </td>
                                    <td class="text-right" style="width: 15%;">
                                        <?php if ($package[$i]['rate_dollar'] == '1') : ?>
                                            <?= $currency . " " . number_format($package[$i]['price_idr'], 0, ',', '.'); ?>
                                        <?php elseif ($package[$i]['rate_dollar'] == '2') : ?>
                                            <?= $currency . " " . number_format($package[$i]['price_dollar'], 2, ',', '.'); ?>
                                        <?php else : ?>
                                            <?= $currency . " " . number_format($package[$i]['price_euro'], 2, ',', '.'); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right" style="width: 15%;">
                                        <?php $tot_other_invoice += $package[$i]['rate_package'] ?>
                                        <?php $total_rate_lesson += $package[$i]['rate_package'] ?>
                                        <?= $currency . " " . number_format($package[$i]['rate_package'], 0, ',', '.'); ?>
                                        <!-- <?php if (number_format($package[$i]['discount'], 0, ',', '.') > 0) : ?>
                                            <br>
                                            <small style="color:red">(Discount <?= $currency . " " . number_format($package[$i]['discount'], 0, ',', '.'); ?>)</small>
                                        <?php endif; ?> -->
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr style="background-color:#E8F6EF">
                                <td colspan="6" class="text-center">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="2">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;">
                                                <?= number_format($total_rate_lesson, 0, ',', '.'); ?>
                                            </span>
                                        </p>

                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p style="<?php echo count($book) > 0  ? 'font-weight:bold' : 'display:none' ?>"><i>Book</i></p>
                <div class="table-responsive-sm mb-5" style="<?= count($book) > 0  ? '' : 'display:none' ?>">
                    <table class="table table-bordered table-white" style="<?= count($book) > 0  ? '' : 'display:none' ?>">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student Name</th>
                                <th>Title Book - Level</th>
                                <th>Order Date</th>
                                <th style="width: 15%;">Price</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $z = 1; ?>
                            <?php for ($i = 0; $i < count($book); $i++) : ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center"><?= $book[$i]['name_student'] ?></td>
                                    <td class="text-center">
                                        <?= $book[$i]['title'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= date_format(date_create(substr($book[$i]['tgl_order'], 0, 10)), "d/m/Y") ?>
                                    </td>
                                    <td class="text-right" style="width: 15%;">
                                        <?php $total_rate_book += $book[$i]['price'] ?>
                                        <?php $tot_other_invoice += $book[$i]['price'] ?>
                                        <?= $currency . " " . number_format($book[$i]['price'], 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr style="background-color:#E8F6EF">
                                <td colspan="4" class="text-center">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="1">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;">
                                                <?= number_format($total_rate_book, 0, ',', '.'); ?>
                                            </span>
                                        </p>

                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p style="<?php echo count($event) > 0  ? 'font-weight:bold' : 'display:none' ?>"><i>Event</i></p>
                <div class="table-responsive-sm mb-5" style="<?= count($event) > 0  ? '' : 'display:none' ?>">
                    <table class="table table-bordered table-white" style="<?= count($event) > 0  ? '' : 'display:none' ?>">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Student Name</th>
                                <th>Event Name</th>
                                <th>Event Date</th>
                                <th style="width: 15%;">Price</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <?php $z = 1; ?>
                            <?php for ($i = 0; $i < count($event); $i++) : ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center"><?= $event[$i]['name_student'] ?></td>
                                    <td class="text-center">
                                        <?php for ($j = 0; $j < count($event_detail[$event[$i]['no_transaksi_event']][0]); $j++) : ?>
                                            <?= $event_detail[$event[$i]['no_transaksi_event']][0][$j]['event_name'] ?>
                                            <br>
                                        <?php endfor; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php for ($j = 0; $j < count($event_detail[$event[$i]['no_transaksi_event']][0]); $j++) : ?>
                                            <?= date_format(date_create(substr($event_detail[$event[$i]['no_transaksi_event']][0][$j]['date'], 0, 10)), "d/m/Y") ?>
                                            <br>
                                        <?php endfor; ?>
                                    </td>
                                    <td class="text-right" style="width: 15%;">
                                        <?php $tot_other_invoice += $event[$i]['price'] ?>
                                        <?php $total_rate_event += $event[$i]['price'] ?>
                                        <?= $currency . " " . number_format($event[$i]['price'], 0, ',', '.'); ?>
                                        <!-- <?php if (number_format($event[$i]['discount'], 0, ',', '.') > 0) : ?>
                                            <br>
                                            <small style="color:red">(Discount <?= $currency . " " . number_format($event[$i]['discount'], 0, ',', '.'); ?>)</small>
                                        <?php endif; ?> -->
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr style="background-color:#E8F6EF">
                                <td colspan="4" class="text-center">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="1">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;">
                                                <?= number_format($total_rate_event, 0, ',', '.'); ?>
                                            </span>
                                        </p>

                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <?php $date_periode = date_format(date_create(substr($sirkulasi[0]['created_at'], 0, 10)), "Y-m") ?>
                <h5>
                    Other(s) Category
                </h5>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Other(s) Category</th>
                                <th class="text-center">Explanation</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $z = 1; ?>
                            <?php if (count($other_discount_lesson) > 0) : ?>
                                <?php foreach ($other_discount_lesson as $od) : ?>
                                    <?php $temp_other_discount_lesson[$i] = explode("&", $other_discount_lesson[$i]); ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $z++ ?><br>
                                        </td>
                                        <td class="text-center">
                                            Discount <?= $temp_other_discount_lesson[$i][1] ?> - <?= $temp_other_discount_lesson[$i][3] ?>
                                        </td>
                                        <td class="text-center">
                                            -
                                        </td>
                                        <td class="text-center">
                                            <?php $tot_other_invoice += -($temp_other_discount_lesson[$i][2]) ?>
                                            <?php $parents_invoice_others_category += -($temp_other_discount_lesson[$i][2]) ?>
                                            <span class="text-danger" style="font-weight:bold">
                                                - <?= $currency ?> <?= number_format($temp_other_discount_lesson[$i][2], 0, ',', '.'); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                            <?php if (count($other_discount_event) > 0) : ?>
                                <?php foreach ($other_discount_event as $od) : ?>
                                    <?php $temp_other_discount_event[$i] = explode("&", $other_discount_event[$i]); ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $z++ ?><br>
                                        </td>
                                        <td class="text-center">
                                            Discount <?= $temp_other_discount_event[$i][1] ?> - <?= $temp_other_discount_event[$i][3] ?>
                                        </td>
                                        <td class="text-center">
                                            -
                                        </td>
                                        <td class="text-center">
                                            <?php $tot_other_invoice += -($temp_other_discount_event[$i][2]) ?>
                                            <?php $parents_invoice_others_category += -($temp_other_discount_event[$i][2]) ?>
                                            <span class="text-danger" style="font-weight:bold">
                                                - <?= $currency ?> <?= number_format($temp_other_discount_event[$i][2], 0, ',', '.'); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                            <?php if (count($other_invoice) > 0) : ?>
                                <?php foreach ($other_invoice as $oi) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $z++ ?><br>
                                        </td>
                                        <td class="text-center">
                                            <?php switch ($oi['other_category']) {
                                                        case "1":
                                                            echo "Overpayment";
                                                            break;
                                                        case "2":
                                                            echo "Underpayment";
                                                            break;
                                                        case "3":
                                                            echo "Overdue";
                                                            break;
                                                        case "4":
                                                            echo "Discount";
                                                            break;
                                                        case "5":
                                                            echo "Others";
                                                            break;
                                                    } ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $oi['other_note'] ?>
                                        </td>
                                        <td class="text-center">
                                            <?php $tot_other_invoice += $oi['other_price'] ?>
                                            <?php $parents_invoice_others_category += intval($oi['other_price']) ?>
                                            <?php if ($oi['other_price'] == 0) : ?>
                                                <?= $currency ?> 0
                                            <?php else : ?>
                                                <?php if ($oi['other_price'] > 0) : ?>
                                                    <?= $currency ?> <?= number_format($oi['other_price'], 0, ',', '.'); ?>
                                                <?php else : ?>
                                                    <span class="text-danger" style="font-weight:bold">
                                                        - <?= $currency ?> <?= number_format(substr($oi['other_price'], 1), 0, ',', '.'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                            <tr style="background-color:#E8F6EF">
                                <td class="text-center" colspan="3">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="1">
                                    <h5>
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;" id="parents_invoice_others_category">
                                                <?= number_format($parents_invoice_others_category, 0, ',', '.'); ?>
                                            </span>
                                        </p>
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="row p-3" style="background-color:#a8dadc">
                    <div class="col-lg-9 col-9 text-center">
                        <h5 class="font-weight:bold">Grand Total</h5>
                    </div>
                    <div class="col-lg-3 col-3 text-lg-right text-center">
                        <div id="tot_other_invoice" style="display:none">
                            <?= number_format(intval($tot_other_invoice), 0, ',', '.'); ?>
                        </div>
                        <h5 style="font-weight:bold" id="total_invoice">
                            <p style="text-align:left;">
                                <?= $currency ?>
                                <span style="float:right;" id="total_rate_rupiah">
                                    <?= number_format(intval($total_rate_lesson) + intval($total_rate_book) + intval($total_rate_event) + intval($parents_invoice_others_category), 0, ',', '.'); ?>
                                    <!-- <?= number_format($sirkulasi[0]['total_rate'], 0, ',', '.'); ?> -->
                                </span>
                            </p>
                        </h5>
                    </div>
                </div>
                <div class="notices mt-5">
                    <div>
                        Please recheck the dates of the lessons to avoid anymistakes from our teacher's report.
                    </div>
                    <div>
                        Tuition payment should be made at the latest 5 days after the invoice date
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-5">
                            <table border="0" class="table-white" cellpadding="0" cellspacing="0" style="padding:0;width: 100%;">
                                <?php $date = date_create($this->uri->segment(4)); ?>
                                <tbody>
                                    <tr>
                                        <td style="width: 40%;">Bank:</td>
                                        <td style="width: 60%;">
                                            BCA
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;">Account No:</td>
                                        <td style="width: 60%;">
                                            288-599-2020
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 40%;">Beneficiary:</td>
                                        <td style="width: 60%;">
                                            PT Cahaya Edukasi Kencana
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 pt-3" style="color:red; font-style:italic; font-weight:bold">
                            Please write student's name on transfer description
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            var x = window.matchMedia("(max-width: 768px)");
            myFunction(x); // Call listener function at run time
            x.addListener(myFunction); // Attach listener function on state changes

            function myFunction(x) {
                if (x.matches) { // If media query matches
                    document.body.style.zoom = "30%"
                } else {
                    document.body.style.zoom = "80%"
                }
            };
        });
        <?php if (count($other_invoice) > 0) : ?>
            <?php foreach ($other_invoice as $oi) : ?>
                document.getElementById("other_category<?= $oi['id_other_invoice'] ?>").value = '<?= $oi['other_category'] ?>';

                var other_price<?= $oi['id_other_invoice'] ?> = document.getElementById('other_price<?= $oi['id_other_invoice'] ?>').value;
                document.getElementById('rupiah_other_price<?= $oi['id_other_invoice'] ?>').value = convertToRupiah(other_price<?= $oi['id_other_invoice'] ?>);

                var total_rate_rupiah = parseInt(<?= $total_rate_lesson ?>) + parseInt(<?= $total_rate_book ?>) + parseInt(<?= $total_rate_event ?>) + parseInt(<?= $parents_invoice_others_category ?>);

                document.getElementById('total_rate_rupiah').innerHTML = convertToRupiah(total_rate_rupiah);
                document.getElementById('parents_invoice_others_category').innerHTML = convertToRupiah(parseInt(<?= $parents_invoice_others_category ?>));

                var parents_invoice_others_category = <?= $parents_invoice_others_category ?>;
                var temp_value_before<?= $oi['id_other_invoice'] ?> = other_price<?= $oi['id_other_invoice'] ?>;

                rupiah_other_price<?= $oi['id_other_invoice'] ?>.addEventListener('keyup', function(e) {
                    let value_input = e.target.value.split('.').join("");
                    let tot_sementara = parseInt(parents_invoice_others_category) - parseInt(temp_value_before<?= $oi['id_other_invoice'] ?>);

                    rupiah_other_price<?= $oi['id_other_invoice'] ?>.value = convertToRupiah(value_input);
                    other_price<?= $oi['id_other_invoice'] ?>.value = value_input;

                    let total_invoice_new = parseInt(<?= $total_rate_lesson ?>) + parseInt(<?= $total_rate_book ?>) + parseInt(<?= $total_rate_event ?>) + (parseInt(tot_sementara) + parseInt(value_input));

                    console.log(e)
                    console.log(tot_sementara + "sementara")

                    document.getElementById('total_rate_rupiah').innerHTML = convertToRupiah(total_invoice_new);
                    document.getElementById('parents_invoice_others_category').innerHTML = convertToRupiah((parseInt(tot_sementara) + parseInt(value_input)));

                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_invoice_online/<?= $oi['id_other_invoice'] ?>',
                        data: {
                            "data": "other_price",
                            "value": value_input,
                        },
                        success: function(data) {}
                    });
                });

                function otherCategoryFunc(e) {
                    var temp_val = e.target.value;
                    console.log(temp_val)
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_invoice_online/<?= $oi['id_other_invoice'] ?>',
                        data: {
                            "data": "other_category",
                            "value": temp_val,
                        },
                        success: function(data) {}
                    });
                }

                var other_note<?= $oi['id_other_invoice'] ?> = document.getElementById('other_note<?= $oi['id_other_invoice'] ?>');
                other_note<?= $oi['id_other_invoice'] ?>.addEventListener('keyup', function(e) {
                    var value = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_invoice_online/<?= $oi['id_other_invoice'] ?>',
                        data: {
                            "data": "other_note",
                            "value": value,
                        },
                        success: function(data) {}
                    });
                });

            <?php endforeach ?>
        <?php endif ?>



        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        // var discount_rupiah = document.getElementById('discount_rupiah');
        // var discount = document.getElementById('discount');
        // var valuee = '';

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
            return prefix == undefined ? rupiah : (rupiah ? '<?= $currency ?> ' + rupiah : '');
        }
    </script>
</body>

</html>