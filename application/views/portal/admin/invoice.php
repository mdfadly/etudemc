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
    <style>
        .hide {
            display: none;
        }

        @media print {
            #header {
                display: none;
            }

            #adwrapper {
                display: none;
            }

            .bodyColor {
                background-color: #0676BD;
                color: white;
            }
        }
    </style>
</head>

<body>
    <div id="invoice">
        <?php $currency = "" ?>
        <?php if ($ortu[0]['currency'] == 1) : ?>
            <?php $currency = "Rp" ?>
        <?php elseif ($ortu[0]['currency'] == 2) : ?>
            <?php $currency = "USD" ?>
        <?php else : ?>
            <?php $currency = "EUR" ?>
        <?php endif; ?>
        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                    <?php $date = date_create($this->uri->segment(4)); ?>
                    <?php
                        $startdate = strtotime($this->uri->segment(4));
                        $enddate = strtotime("-1 months", $startdate);
                        $temp_date =  date("F", $enddate);
                        $temp_year =  date("Y", $enddate);
                        ?>
                    <?php $link = site_url() . "portal/invoice/etude/" . $this->uri->segment(4) . "/" . md5($ortu[0]['id_parent']) ?>
                    <a id="btn_cancel_attendance" target="_blank" href="https://api.whatsapp.com/send?phone=62<?= substr($ortu[0]['phone_student_1'], 1) ?>&text=Berikut%20kami%20lampirkan%20invoice%20<?= $temp_date ?>%20<?= $temp_year ?>%20pada%20link%20berikut%20:%20<?= $link ?>,%20mohon%20lampirkan%20nama%20murid%20pada%20keterangan%20transfer" class="btn btn-success">
                        <i class="fa fa-whatsapp"></i> Send Invoice
                    </a>
                </div>
                <hr>
            </div>
            <div id="convert" class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Select currency:</label>
                        <select class="form-control" style="width:100%;" name="rate_dollar" id="rate_dollar">
                            <?php if ($ortu[0]['currency'] == 1) : ?>
                                <option value="1">Rupiah</option>
                                <option value="2">Dollar</option>
                                <option value="3">Euro</option>
                            <?php elseif ($ortu[0]['currency'] == 2) : ?>
                                <option value="2">Dollar</option>
                                <option value="1">Rupiah</option>
                                <option value="3">Euro</option>
                            <?php else : ?>
                                <option value="3">Euro</option>
                                <option value="1">Rupiah</option>
                                <option value="2">Dollar</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
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
                                INVOICE
                            </h2>
                        </div>
                    </div>
                </header>
                <main class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-8 border p-3">
                            <h5><?= $ortu[0]['parent_student'] ?></h5>
                            <div>
                                <?= $ortu[0]['address_student'] ?>

                            </div>
                            <div>
                                <?= $ortu[0]['phone_student_1'] ?>
                                <?php if ($ortu[0]['phone_student_2'] != "") : ?>
                                    <?= " | " . $ortu[0]['phone_student_2'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4 border p-3">
                            <table border="0" class="table-white" cellpadding="0" cellspacing="0" style="padding:0;width: 100%;">
                                <?php $date = date_create($this->uri->segment(4)); ?>
                                <tbody>
                                    <tr>
                                        <td style="width: 50%;">Customer No.</td>
                                        <td class="text-right" style="width: 50%;"><?= $ortu[0]['id_parent'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50%;">Month of Invoice:</td>
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
                                        <td style="width: 50%;">Due Date:</td>
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
                        Invoice Details:
                    </h5>
                    <p style="<?php echo count($schedule_offline) > 0  ? '' : 'display:none' ?>">Offline Lesson</p>
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-white" style="width:100%;<?php echo count($schedule_offline) > 0  ? '' : 'display:none' ?>">
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
                            <?php $tot_other_invoice = [] ?>
                            <?php $tot_online_lesson = [] ?>
                            <?php $z = 1; ?>
                            <?php if (count($id_schedule_theory) > 0 || count($pack_online) > 0 || count($id_new_package_practical) > 0 || count($id_new_package_theory) > 0) { ?>
                                <?php for ($i = 0; $i < count($id_schedule_theory); $i++) : ?>
                                    <tr>
                                        <td style="width: 3%;">
                                            <?= $z++ ?>
                                        </td>
                                        <td>
                                            <?= $id_schedule_theory[$i][1] ?>
                                        </td>
                                        <td style="width: 25%;">
                                            <?php for ($j = 0; $j < count($date_schedulue_theory[$id_schedule_theory[$i][0]]); $j++) : ?>
                                                <?= $date_schedulue_theory[$id_schedule_theory[$i][0]][$j] ?>,
                                            <?php endfor; ?>
                                        </td>
                                        <td>
                                            <?php $jumlah_pack =  count($date_schedulue_theory[$id_schedule_theory[$i][0]]) ?>
                                            Theory = <?= $jumlah_pack ?>
                                        </td>
                                        <td>
                                            <?php $harga = intval($jumlah_pack) * 100000 ?>
                                            <?php $tot_other_invoice[] = $harga ?>
                                            <?php $tot_online_lesson[] = $harga ?>
                                            <?= $currency ?> 100.000
                                        </td>
                                        <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                            <p style="text-align:left;">
                                                <?= $currency ?>
                                                <span style="float:right;">
                                                    <?= number_format($harga, 0, ".", ".") ?>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                <?php foreach ($pack_online as $po) : ?>
                                    <tr>
                                        <td style="width: 3%;">
                                            <?= $z++ ?>
                                        </td>
                                        <td>
                                            <?= $po['name_student'] ?>
                                        </td>
                                        <td style="width: 25%;">
                                            <?php if ($date_pack_online[$po['id_list_pack']][0] != 0) : ?>
                                                <?php sort($date_pack_online[$po['id_list_pack']]) ?>
                                                <?php for ($b = 0; $b < count($date_pack_online[$po['id_list_pack']]); $b++) : ?>
                                                    <?= substr($date_pack_online[$po['id_list_pack']][$b], 8, 2) ?>/<?= substr($date_pack_online[$po['id_list_pack']][$b], 5, 2) ?>,
                                                <?php endfor; ?>
                                            <?php else : ?>
                                                belum pilih jadwal
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            Pack Pratical = <?= $po['total_pack_practical'] ?> <br>
                                            Pack Theory = <?= $po['total_pack_theory'] ?>
                                        </td>
                                        <td>
                                            <?php $tot_other_invoice[] = $po['rate'] ?>
                                            <?php $tot_online_lesson[] = $po['rate'] ?>
                                            <?= $currency ?> <?= number_format($po['rate'], 0, ".", ".") ?>
                                        </td>
                                        <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                            <p style="text-align:left;">
                                                <?= $currency ?>
                                                <span style="float:right;">
                                                    <?= number_format($po['rate'], 0, ".", ".") ?>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php for ($i = 0; $i < count($id_new_package_practical); $i++) : ?>
                                    <tr>
                                        <td style="width: 3%;">
                                            <?= $z++ ?>
                                        </td>
                                        <td>
                                            <?= $id_new_package_practical[$i][1] ?>
                                        </td>
                                        <td style="width: 25%;">
                                            <?php for ($j = 0; $j < count($date_schedulue_new_package_practical[$id_new_package_practical[$i][0]]); $j++) : ?>
                                                <?= substr($date_schedulue_new_package_practical[$id_new_package_practical[$i][0]][$j], 8, 2) ?>/
                                                <?= substr($date_schedulue_new_package_practical[$id_new_package_practical[$i][0]][$j], 5, 2) ?>,
                                            <?php endfor; ?>
                                        </td>
                                        <td>
                                            <?php $jumlah_pack =  round(count($date_schedulue_new_package_practical[$id_new_package_practical[$i][0]]) / 2) ?>
                                            Practical Add on = <?= $jumlah_pack ?>
                                        </td>
                                        <td>
                                            <?php $harga = intval($jumlah_pack) * 475000 ?>
                                            <?php $tot_other_invoice[] = $harga ?>
                                            <?php $tot_online_lesson[] = $harga ?>
                                            <?= $currency ?> 475.000
                                        </td>
                                        <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                            <p style="text-align:left;">
                                                <?= $currency ?>
                                                <span style="float:right;">
                                                    <?= number_format($harga, 0, ".", ".") ?>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                <?php for ($i = 0; $i < count($id_new_package_theory); $i++) : ?>
                                    <tr>
                                        <td style="width: 3%;">
                                            <?= $z++ ?>
                                        </td>
                                        <td>
                                            <?= $id_new_package_theory[$i][1] ?>
                                        </td>
                                        <td style="width: 25%;">
                                            <?php for ($j = 0; $j < count($date_schedulue_new_package_theory[$id_new_package_theory[$i][0]]); $j++) : ?>
                                                <?= substr($date_schedulue_new_package_theory[$id_new_package_theory[$i][0]][$j], 8, 2) ?>/
                                                <?= substr($date_schedulue_new_package_theory[$id_new_package_theory[$i][0]][$j], 5, 2) ?>,
                                            <?php endfor; ?>
                                        </td>
                                        <td>
                                            <?php $jumlah_pack = (count($date_schedulue_new_package_theory[$id_new_package_theory[$i][0]])) ?>
                                            Theory Add on = <?= $jumlah_pack ?>
                                        </td>
                                        <td>
                                            <?php $harga = intval($jumlah_pack) * 100000 ?>
                                            <?php $tot_other_invoice[] = $harga ?>
                                            <?php $tot_online_lesson[] = $harga ?>
                                            <?= $currency ?> 100.000
                                        </td>
                                        <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                            <p style="text-align:left;">
                                                <?= $currency ?>
                                                <span style="float:right;">
                                                    <?= number_format($harga, 0, ".", ".") ?>
                                                </span>
                                            </p>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Sub Total
                                    </td>
                                    <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;" id="tot_online_lesson">
                                                <?= number_format(array_sum($tot_online_lesson), 0, ".", ".") ?>
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td style="width: 3%;"></td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;">
                                                0
                                            </span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Sub Total
                                    </td>
                                    <td colspan="3" class="pl-4 pr-4 p-0 pt-2" style="width: 20%;">
                                        <p style="text-align:left;">
                                            <?= $currency ?>
                                            <span style="float:right;">
                                                0
                                            </span>
                                        </p>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <br>
                    <h5>
                        Other(s):
                    </h5>
                    <form action="<?= site_url() ?>portal/C_Admin/add_data_other_invoice" method="POST">
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

                                        <?php if (count($order_book) > 0) : ?>
                                            <?php foreach ($order_book as $oi) : ?>
                                                <tr>
                                                    <td style="width: 3%;">
                                                        <?= $z++ ?>
                                                    </td>
                                                    <td style="width:77%">
                                                        BOOK - <?= $oi['title'] ?><br>
                                                        <small><?= $oi['name_student'] ?></small>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <?php $tot_other_invoice[] = $oi['price'] ?>
                                                        <?php $other_tot[] = $oi['price'] ?>
                                                        <p style="text-align:left;">
                                                            <?= $currency ?>
                                                            <span style="float:right;">
                                                                <?= number_format($oi['price'], 0, ".", ".") ?>
                                                            </span>
                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (count($event_student) > 0) : ?>
                                            <?php foreach ($event_student as $oi) : ?>
                                                <tr>
                                                    <td style="width: 3%;">
                                                        <?= $z++ ?>
                                                    </td>
                                                    <td style="width:77%">
                                                        Event - <?= $oi['event_name'] ?><br>
                                                        <small><?= $oi['name_student'] ?></small>
                                                    </td>
                                                    <td style="width: 20%;">
                                                        <?php $tot_other_invoice[] = $oi['price'] ?>
                                                        <?php $other_tot[] = $oi['price'] ?>
                                                        <p style="text-align:left;">
                                                            <?= $currency ?>
                                                            <span style="float:right;">
                                                                <?= number_format($oi['price'], 0, ".", ".") ?>
                                                            </span>
                                                        </p>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (count($other_invoice) > 0) : ?>
                                            <?php foreach ($other_invoice as $oi) : ?>
                                                <tr>
                                                    <td style="width: 3%;">
                                                        <?= $z++ ?>
                                                    </td>
                                                    <td style="width:77%">
                                                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                            <input class="form-control" type="text" value="<?= $oi['other_note'] ?>" required name="other_note" id="other_note<?= $oi['id_other_invoice'] ?>">
                                                        <?php else : ?>
                                                            Other<br>
                                                            <small><?= $oi['other_note'] ?></small>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td style="width: 20%;">
                                                        <?php $tot_other_invoice[] = $oi['other_price'] ?>
                                                        <?php $other_tot[] = $oi['other_price'] ?>
                                                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                            <div class="row">
                                                                <div class="col-lg-10 row mb-2">
                                                                    <label class="col-lg-3"><?= $currency ?></label>

                                                                    <input type="text" class="form-control col-lg-9" value="<?= $oi['other_price'] ?>" id="rupiah_other_price<?= $oi['id_other_invoice'] ?>" />

                                                                    <input type="hidden" class="form-control" id="other_price<?= $oi['id_other_invoice'] ?>" name="other_price">
                                                                </div>
                                                                <div class="col-lg-2 mb-2">
                                                                    <a href="<?= site_url() ?>portal/C_Admin/delete_data_other_invoice/<?= $oi['id_other_invoice'] ?>/<?= $this->uri->segment(4) ?>/<?= $ortu[0]['id_parent'] ?>" class="btn btn-danger" onclick="return confirm('are you sure want to delete this data?')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php else : ?>
                                                            <p style="text-align:left;">
                                                                <?= $currency ?>
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
                                                    <?= $currency ?>
                                                    <span style="float:right;" id="total_other_invoice">
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
                                    <input type="hidden" name="id_parent" id="id_parent" value="<?= $ortu[0]['id_parent'] ?>">
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
                    <table class="table-bordered table">
                        <thead>
                            <tr class="bodyColor" style="background-color:#0676BD; color:white;">
                                <td style="width: 80%;" class="text-center">
                                    <h5>Grand Total</h5>
                                </td>
                                <td style="width: 20%;" class="pl-4 pr-4 p-0 pt-2">
                                    <div id="tot_other_invoice" style="display:none">
                                        <?= array_sum($tot_other_invoice); ?>
                                    </div>
                                    <div id="tot_invoice_parent" style="display:none"></div>
                                    <p style="text-align:left; font-size:20px">
                                        <?= $currency ?>
                                        <span style="float:right;" id="total">

                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <div class="notices mt-5">
                        <div>
                            Transfer shall be made before 10th in every month
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
                                        <tr>
                                            <td style="width: 40%;">Description:</td>
                                            <td style="width: 60%;">
                                                Student name_month of invoice
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-12 pt-3" style="color:red; font-style:italic; font-weight:bold">
                                Please write student's name on transfer description
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
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
        <?php if (count($other_invoice) > 0) : ?>
            <?php foreach ($other_invoice as $oi) : ?>
                var other_price<?= $oi['id_other_invoice'] ?> = document.getElementById('other_price<?= $oi['id_other_invoice'] ?>');
                var rupiah_other_price<?= $oi['id_other_invoice'] ?> = document.getElementById('rupiah_other_price<?= $oi['id_other_invoice'] ?>');
                var valuee<?= $oi['id_other_invoice'] ?> = '';

                var total_other_invoice = document.getElementById('total_other_invoice').innerText;

                var temp_value_before<?= $oi['id_other_invoice'] ?> = rupiah_other_price<?= $oi['id_other_invoice'] ?>.value;


                rupiah_other_price<?= $oi['id_other_invoice'] ?>.addEventListener('keyup', function(e) {
                    var temp_tot_other = parseInt(total_other_invoice.split('.').join("")) - parseInt(temp_value_before<?= $oi['id_other_invoice'] ?>);
                    rupiah_other_price<?= $oi['id_other_invoice'] ?>.value = formatRupiah(this.value);
                    valuee<?= $oi['id_other_invoice'] ?> = rupiah_other_price<?= $oi['id_other_invoice'] ?>.value;
                    other_price<?= $oi['id_other_invoice'] ?>.value = valuee<?= $oi['id_other_invoice'] ?>.split('.').join("");

                    var value_temp = other_price<?= $oi['id_other_invoice'] ?>.value;
                    console.log(temp_tot_other);
                    console.log(value_temp);

                    var tot_invoice_parent = parseInt($('#tot_invoice_parent').text());
                    var tot_online_lesson = document.getElementById('tot_online_lesson').innerText;

                    var b = parseInt(value_temp) + parseInt(temp_tot_other);
                    var c = parseInt(b) + parseInt(tot_invoice_parent) + parseInt(tot_online_lesson.split('.').join(""));

                    console.log(tot_invoice_parent);
                    console.log(tot_online_lesson);
                    console.log(b);
                    console.log(c);

                    document.getElementById('total_other_invoice').innerHTML = convertToRupiah(b);
                    document.getElementById('total').innerHTML = convertToRupiah(c);

                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_invoice/<?= $oi['id_other_invoice'] ?>',
                        data: {
                            "data": "other_price",
                            "value": value_temp,
                        },
                        success: function(data) {}
                    });
                });

                var other_note<?= $oi['id_other_invoice'] ?> = document.getElementById('other_note<?= $oi['id_other_invoice'] ?>');
                other_note<?= $oi['id_other_invoice'] ?>.addEventListener('keyup', function(e) {
                    var value = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_invoice/<?= $oi['id_other_invoice'] ?>',
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
            var price_dollar = document.getElementById('price_dollar');
            var dollar_to_rupiah = document.getElementById('dollar_to_rupiah');
            dollar_to_rupiah.value = price_dollar.value;
            dollar_to_rupiah.value = formatConvertDollar(dollar_to_rupiah.value);
            //euro
            var price_euro = document.getElementById('price_euro');
            var euro_to_rupiah = document.getElementById('euro_to_rupiah');
            euro_to_rupiah.value = price_euro.value;
            euro_to_rupiah.value = formatConvertEuro(euro_to_rupiah.value);
            <?php if (count($other_invoice) > 0) : ?>
                <?php foreach ($other_invoice as $oi) : ?>
                    var other_price<?= $oi['id_other_invoice'] ?> = document.getElementById('other_price<?= $oi['id_other_invoice'] ?>');
                    var rupiah_other_price<?= $oi['id_other_invoice'] ?> = document.getElementById('rupiah_other_price<?= $oi['id_other_invoice'] ?>');
                    other_price<?= $oi['id_other_invoice'] ?>.value = rupiah_other_price<?= $oi['id_other_invoice'] ?>.value;
                    rupiah_other_price<?= $oi['id_other_invoice'] ?>.value = formatRupiah(rupiah_other_price<?= $oi['id_other_invoice'] ?>.value);
                    // var distributor_price = document.getElementById('distributor_price');
                    // var rupiah = document.getElementById('rupiah');
                    // distributor_price.value = rupiah.value;
                    // rupiah.value = formatRupiah(rupiah.value);

                <?php endforeach; ?>
            <?php endif; ?>


            $('.add').on('click', add);
            $('.remove').on('click', remove);

            function add() {
                var new_student_no = parseInt($('#total_other').val()) + 1;
                var new_input = "<input class='form-control mt-2' placeholder='Student name " + new_student_no + "...' name='name_student" + new_student_no + "' type='text' id='new_" + new_student_no + "'>";

                var new_input = `<tr id="new_` + new_student_no + `">
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="other_category" required name="other_category` + new_student_no + `">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="other_note" required name="other_note` + new_student_no + `">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="0" id="other_price" required name="other_price` + new_student_no + `">
                                        </div>
                                    </td>
                                </tr>`;

                $('#new_student').append(new_input);

                $('#total_other').val(new_student_no);
            }

            function remove() {
                var last_student_no = $('#total_other').val();

                if (last_student_no > 1) {
                    $('#new_' + last_student_no).remove();
                    $('#total_other').val(last_student_no - 1);
                }
            }
            <?php if (count($other_invoice) > 0) : ?>
                <?php foreach ($other_invoice as $oi) : ?>

                    document.getElementById("other_price<?= $oi['id_other_invoice'] ?>").value = formatRupiah($('#other_price<?= $oi['id_other_invoice'] ?>').val());

                <?php endforeach; ?>
            <?php endif; ?>
        });


        function show_data() {
            $.ajax({
                url: "<?= base_url() ?>portal/C_Admin/get_data_invoice_parent",
                data: {
                    "periode": "<?= $this->uri->segment(4) ?>",
                    "id_parent": "<?= $ortu[0]['id_parent'] ?>",
                },
                success: function(data) {
                    $("#show_data").html(data);
                    // console.log($('#tot_parent').val());
                    $('#tot_invoice_parent').append($('#tot_parent').val());
                    var tot_invoice_parent = parseInt($('#tot_invoice_parent').text());
                    var tot_other_invoice = parseInt($('#tot_other_invoice').text());
                    // console.log(tot_invoice_parent);
                    // console.log(tot_other_invoice);
                    var total = parseInt(tot_invoice_parent + tot_other_invoice);
                    // console.log(total);
                    $('#total').append(convertToRupiah(total));
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
            return prefix == undefined ? rupiah : (rupiah ? '<?= $currency ?>. ' + rupiah : '');
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
            return prefix == undefined ? dollar_to_rupiah : (dollar_to_rupiah ? '<?= $currency ?>. ' + dollar_to_rupiah : '');
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
            return prefix == undefined ? euro_to_rupiah : (euro_to_rupiah ? '<?= $currency ?>. ' + euro_to_rupiah : '');
        }
    </script>
    <script>
        $("#rate_dollar").change(function() {
            var val = $(this).val();
            $.ajax({
                type: "POST",
                url: '<?= site_url() ?>portal/C_Admin/updateCurrencyParent',
                data: {
                    "currency": val,
                    "id_parent": "<?= $ortu[0]['id_parent'] ?>",
                },
                success: function(data) {
                    alert("Update Successfully!");
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>