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
            <!-- <div class="card-header">
                Fee Report
                <strong>01/01/01/2018</strong>
                <span class="float-right"> <strong>Status:</strong> Pending</span>

            </div> -->
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
                            Fee Report Teacher
                        </h4>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6 col-lg-6 col-6 p-4" style="border:1px solid;">
                        <div>
                            <h3><?= $teacher[0]['name_teacher'] ?></h3>
                        </div>
                        <!-- <div class="mt-4"><?= str_replace('~', ' ', $teacher[0]['address_teacher']); ?></div> -->
                        <div class="mt-4"></div>
                        <div><?= $teacher[0]['phone_teacher'] ?></div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-6 p-4" style="border:1px solid;">
                        <table border="0" class="table-white" cellpadding="0" cellspacing="0" style="padding:0;width: 100%;">
                            <?php $date = date_create($this->uri->segment(4)); ?>
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">No. Feereport:</td>
                                    <td class="text-right" style="width: 50%; font-weight:bold">
                                        <?= $data_sirkulasi_feereport[0]['no_sirkulasi_feereport'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Instrument:</td>
                                    <td class="text-right" style="width: 50%;"><?= $teacher[0]['instrument'] ?></td>
                                </tr>
                                <tr style="font-weight:bold">
                                    <td style="width: 50%;">Month:</td>
                                    <td class="text-right" style="width: 50%;">
                                        <?php
                                        $startdate = strtotime($this->uri->segment(4));
                                        $enddate = strtotime("0 months", $startdate);
                                        $temp_date =  date("F", $enddate);
                                        ?>
                                        <?= $temp_date ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">Paid Date:</td>
                                    <td class="text-right" style="width: 50%;">
                                        <?php $date2 = date_format($date, "F Y") ?>
                                        <?php
                                        $startdate2 = strtotime($this->uri->segment(4));
                                        $enddate2 = strtotime("+1 months", $startdate2);
                                        $temp_date2 =  date("F Y", $enddate2);
                                        ?>
                                        10 <?= $temp_date2 ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (count($id_student_nadia_online_temp) > 0) : ?>
                    <h3>
                        Invoice Details (IDR):
                    </h3>
                <?php else : ?>
                    <h3>
                        Invoice Details:
                    </h3>
                <?php endif ?>
                <h5>
                    Online Lesson
                </h5>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Student</th>
                                <th class="text-center">Name of Package</th>
                                <th class="text-center">Lesson Date</th>
                                <th class="text-center">Total Pack</th>
                                <th class="text-center">Last Pack</th>
                                <th class="text-center">Next Pack</th>
                                <th class="text-center">Price/Pack</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Teacher's Fee</th>
                                <th class="text-center">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $z = 1; ?>
                            <?php $total_pack_online = 0 ?>
                            <?php $total_fee_online = 0 ?>
                            <?php $teacher_fee = 0 ?>
                            <?php $teacher_fee_online_lesson = 0 ?>
                            <?php for ($i = 0; $i < count($id_student_nadia_online_temp); $i++) : ?>
                                <?php $temp_id_student_nadia_online_temp[$i] = explode("&", $id_student_nadia_online_temp[$i]); ?>
                                <?php if ($temp_id_student_nadia_online_temp[$i][7] == '1') : ?>
                                    <tr>
                                        <td class="text-center"><?= $z++ ?></td>
                                        <td class="text-center">
                                            <?= $temp_id_student_nadia_online_temp[$i][1] ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $temp_id_student_nadia_online_temp[$i][2] ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                <?= $date_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                <?= $date_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                            <?= $total_pack_online ?>
                                        </td>
                                        <td class="text-center text-danger" style="font-weight:bold">
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                <?= ($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center text-danger" style="font-weight:bold">
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                <?php if (((($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] + $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]]) % 2) == 0) && $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] == 1) : ?>
                                                    <?= ($tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                                <?php else : ?>

                                                <?php endif ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="text-center">
                                            <?php $total_fee_online = $temp_id_student_nadia_online_temp[$i][3] ?>
                                            <?= "Rp " . number_format($total_fee_online, 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center">
                                            <?= "Rp " . number_format($total_pack_online * $total_fee_online, 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                            <?php endif ?>
                                            <?= "Rp " . number_format($teacher_fee, 0, ',', '.'); ?>
                                            <?php $teacher_fee_online_lesson += $teacher_fee ?>
                                        </td>
                                        <td class="text-center">
                                            100%
                                        </td>
                                    </tr>
                                <?php endif ?>
                            <?php endfor ?>

                            <?php for ($i = 0; $i < count($id_student_online_temp); $i++) : ?>
                                <?php $temp_id_student_online_temp[$i] = explode("&", $id_student_online_temp[$i]); ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center">
                                        <?= $temp_id_student_online_temp[$i][1] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_id_student_online_temp[$i][2] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?= $date_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?= $date_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?= $date_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_online_temp[$i][5] == 2) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?= $date_rate50_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?= $date_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?= $date_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_online_temp[$i][5] == 2) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate50_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?php $total_pack_online =  $total_pack_periode_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?= $total_pack_online ?>
                                    </td>
                                    <td class="text-center text-danger" style="font-weight:bold">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?= ($tipe_rate50_paket_pratical_before[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?= ($tipe_rate_paket_pratical_before[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?= ($tipe_rate_paket_pratical_before[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center text-danger" style="font-weight:bold">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?php if (($tipe_rate50_paket_pratical_before[$temp_id_student_online_temp[$i][7]] + $tipe_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]]) == 8 && $tipe_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] == 1) : ?>
                                                <?php else : ?>
                                                    <?= ($tipe_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?= ($tipe_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?= ($tipe_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] % 2) == 1 ? "-1" : ""   ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $total_fee_online = $temp_id_student_online_temp[$i][3] ?>
                                        <?= "Rp " . number_format($total_fee_online, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= "Rp " . number_format($total_pack_online * $total_fee_online, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_online_temp[$i][5] == 2) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate50_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 70) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 80) : ?>
                                                <?php $teacher_fee = $total_fee_periode_rate_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?= "Rp " . number_format($teacher_fee, 0, ',', '.'); ?>
                                        <?php $teacher_fee_online_lesson += $teacher_fee ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_online_temp[$i][5] == 1) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?= $notes_rate50_paket_pratical[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php else : ?>
                                                <?= $temp_id_student_online_temp[$i][4] ?>%
                                            <?php endif ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_online_temp[$i][5] == 2) : ?>
                                            <?php if ($temp_id_student_online_temp[$i][4] == 50) : ?>
                                                <?= $notes_rate50_paket_teory[$temp_id_student_online_temp[$i][7]] ?>
                                            <?php else : ?>
                                                <?= $temp_id_student_online_temp[$i][4] ?>%
                                            <?php endif ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endfor ?>
                            <tr style="background-color:#E8F6EF">
                                <td class="text-center" colspan="8">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="3">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format($teacher_fee_online_lesson, 0, ',', '.'); ?>
                                            </span>
                                        </p>

                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h5>
                    Offline Lesson
                </h5>
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-white">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Student</th>
                                <th class="text-center">Name of Package</th>
                                <th class="text-center">Lesson Date</th>
                                <th class="text-center">Total Lesson</th>
                                <th class="text-center">Price/Lesson</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Teacher's Fee</th>
                                <th class="text-center">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $z = 1; ?>
                            <?php $total_pack_offline = 0 ?>
                            <?php $total_fee_offline = 0 ?>
                            <?php $teacher_fee_2 = 0 ?>
                            <?php $teacher_fee_offline_lesson = 0 ?>
                            <?php for ($i = 0; $i < count($id_student_nadia_offline_lesson_temp); $i++) : ?>
                                <?php $temp_id_student_nadia_offline_lesson_temp[$i] = explode("&", $id_student_nadia_offline_lesson_temp[$i]); ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center">
                                        <?= $temp_id_student_nadia_offline_lesson_temp[$i][1] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_id_student_nadia_offline_lesson_temp[$i][2] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $date_rate100_offline_lesson[$temp_id_student_nadia_offline_lesson_temp[$i][6]] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $total_pack_offline =  $total_pack_periode_rate100_offline_lesson[$temp_id_student_nadia_offline_lesson_temp[$i][6]] ?>
                                        <?= $total_pack_offline ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $total_fee_offline = $temp_id_student_nadia_offline_lesson_temp[$i][3] ?>
                                        <?= "Rp " . number_format($total_fee_offline, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= "Rp " . number_format($total_pack_offline * $total_fee_offline, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $teacher_fee_2 = $total_fee_periode_rate100_offline_lesson[$temp_id_student_nadia_offline_lesson_temp[$i][6]] ?>
                                        <?= "Rp " . number_format($teacher_fee_2, 0, ',', '.'); ?>
                                        <?php $teacher_fee_offline_lesson += $teacher_fee_2 ?>
                                    </td>
                                    <td class="text-center">
                                        100%
                                    </td>
                                </tr>
                            <?php endfor ?>
                            <?php for ($i = 0; $i < count($id_student_offline_lesson_temp); $i++) : ?>
                                <?php $temp_id_student_offline_lesson_temp[$i] = explode("&", $id_student_offline_lesson_temp[$i]); ?>
                                <tr>
                                    <td class="text-center"><?= $z++ ?></td>
                                    <td class="text-center">
                                        <?= $temp_id_student_offline_lesson_temp[$i][1] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $temp_id_student_offline_lesson_temp[$i][2] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 50) : ?>
                                            <?= $date_rate50_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 80) : ?>
                                            <?= $date_rate_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 50) : ?>
                                            <?php $total_pack_offline =  $total_pack_periode_rate50_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 80) : ?>
                                            <?php $total_pack_offline =  $total_pack_periode_rate_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                        <?= $total_pack_offline ?>
                                    </td>
                                    <td class="text-center">
                                        <?php $total_fee_offline = $temp_id_student_offline_lesson_temp[$i][3] ?>
                                        <?= "Rp " . number_format($total_fee_offline, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= "Rp " . number_format($total_pack_offline * $total_fee_offline, 0, ',', '.'); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 50) : ?>
                                            <?php $teacher_fee_2 = $total_fee_periode_rate50_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 80) : ?>
                                            <?php $teacher_fee_2 = $total_fee_periode_rate_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php endif ?>
                                        <?= "Rp " . number_format($teacher_fee_2, 0, ',', '.'); ?>
                                        <?php $teacher_fee_offline_lesson += $teacher_fee_2 ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($temp_id_student_offline_lesson_temp[$i][4] == 50) : ?>
                                            <?= $notes_rate50_offline_lesson[$temp_id_student_offline_lesson_temp[$i][7]] ?>
                                        <?php else : ?>
                                            <?= $temp_id_student_offline_lesson_temp[$i][4] ?>%
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endfor ?>
                            <tr style="background-color:#E8F6EF">
                                <td class="text-center" colspan="6">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="3">
                                    <h5>
                                        <p style="text-align:left;">
                                            Rp
                                            <span style="float:right;">
                                                <?= number_format($teacher_fee_offline_lesson, 0, ',', '.'); ?>
                                            </span>
                                        </p>

                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h5 style="<?php echo count($event) > 0  ? 'font-weight:bold' : 'display:none' ?>">
                    Event
                </h5>
                <?php $tot_other_invoice = 0 ?>
                <?php $total_rate_event = 0; ?>
                <div class="table-responsive-sm mb-5" style="<?= count($event) > 0  ? '' : 'display:none' ?>">
                    <table class="table table-bordered table-white" style="<?= count($event) > 0  ? '' : 'display:none' ?>">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
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
                                        <?= "Rp " . number_format($event[$i]['price'], 0, ',', '.'); ?>
                                        <!-- <?php if (number_format($event[$i]['discount'], 0, ',', '.') > 0) : ?>
                                            <br>
                                            <small style="color:red">(Discount <?= $currency . " " . number_format($event[$i]['discount'], 0, ',', '.'); ?>)</small>
                                        <?php endif; ?> -->
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr style="background-color:#E8F6EF">
                                <td colspan="3" class="text-center">
                                    <h5 class="font-weight:bold">Total Price</h5>
                                </td>
                                <td colspan="1">
                                    <h5 class="font-weight:bold">
                                        <p style="text-align:left;">
                                            <?= "Rp" ?>
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
                <?php $teacher_fee_others_category = 0 ?>
                <?php $tot_other_feereport = 0 ?>
                <?php if (count($data_other_category) > 0) : ?>
                    <h5>
                        Other(s) Category
                        <span class="ml-3">
                            <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                <a href="<?= site_url() ?>portal/C_Admin/add_other_feereport/<?= $teacher[0]['id_teacher'] ?>/<?= $this->uri->segment(4) ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus"></i>
                                </a>
                            <?php endif; ?>
                        </span>
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

                                <?php if (count($other_discount_event) > 0) : ?>
                                    <?php for ($i = 0; $i < count($other_discount_event); $i++) : ?>
                                        <?php $temp_other_discount_event[$i] = explode("&", $other_discount_event[$i]); ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $z++ ?><br>
                                            </td>
                                            <td class="text-center">
                                                Discount <?= $temp_other_discount_event[$i][1] ?>
                                            </td>
                                            <td class="text-center">
                                                Event - <?= $temp_other_discount_event[$i][4] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $tot_other_invoice += -($temp_other_discount_event[$i][2]) ?>
                                                <?php $teacher_fee_others_category += -($temp_other_discount_event[$i][2]) ?>
                                                <span class="text-danger" style="font-weight:bold">
                                                    - Rp <?= number_format($temp_other_discount_event[$i][2], 0, ',', '.'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endfor ?>
                                <?php endif ?>
                                <?php if (count($data_other_category['trial']) > 0) : ?>
                                    <?php for ($i = 0; $i < count($data_other_category['trial']); $i++) : ?>
                                        <?php $temp_data_trial[$i] = explode("&", $data_other_category['trial'][$i]); ?>
                                        <tr>
                                            <td class="text-center"><?= $z++ ?></td>
                                            <td class="text-center">Trial</td>
                                            <td class="text-center">
                                                <?= $temp_data_trial[$i][0] ?>
                                                ( <?= date_format(date_create(substr($temp_data_trial[$i][1], 0, 10)), "d") ?> )
                                            </td>
                                            <td class="text-center">
                                                <?php $teacher_fee_others_category += $temp_data_trial[$i][2] ?>
                                                Rp <?= number_format($temp_data_trial[$i][2], 0, ',', '.'); ?>
                                            </td>
                                        </tr>
                                    <?php endfor ?>
                                <?php endif ?>
                                <?php if (count($other_feereport) > 0) : ?>
                                    <?php foreach ($other_feereport as $oi) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $z++ ?><br>
                                            </td>
                                            <td class="text-center">
                                                <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                    <select class="form-control" name="other_category" id="other_category<?= $oi['id_other_feereport'] ?>" onchange="otherCategoryFunc(event)">
                                                        <option value="1">Bonus</option>
                                                        <option value="2">Cashback</option>
                                                        <option value="3">Potongan</option>
                                                    </select>
                                                <?php else : ?>
                                                    <?php switch ($oi['other_category']) {
                                                                        case "1":
                                                                            echo "Bonus";
                                                                            break;
                                                                        case "2":
                                                                            echo "Cashback";
                                                                            break;
                                                                        case "3":
                                                                            echo "Potongan";
                                                                            break;
                                                                    } ?>
                                                    <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                    <input class="form-control" type="text" value="<?= $oi['other_note'] ?>" placeholder="Please input explanation..." required name="other_note" id="other_note<?= $oi['id_other_feereport'] ?>">
                                                <?php else : ?>
                                                    <?= $oi['other_note'] ?>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $tot_other_feereport += $oi['other_price'] ?>
                                                <?php $teacher_fee_others_category += intval($oi['other_price']) ?>
                                                <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                                                    <div class="row">
                                                        <div class="col-lg-10 col-10 row mb-2">
                                                            <label class="col-lg-3 col-3">Rp</label>
                                                            <input type="text" class="form-control col-lg-9 col-9" id="rupiah_other_price<?= $oi['id_other_feereport'] ?>" />

                                                            <input type="hidden" class="form-control" id="other_price<?= $oi['id_other_feereport'] ?>" name="other_price" value="<?= $oi['other_price'] ?>">
                                                        </div>

                                                        <div class="col-lg-2 col-2 mb-2">
                                                            <a href="<?= site_url() ?>portal/C_Admin/delete_data_other_feereport/<?= $oi['id_other_feereport'] ?>/<?= $this->uri->segment(4) ?>/<?= $teacher[0]['id_teacher'] ?>" class="btn btn-danger" onclick="return confirm('are you sure want to delete this data?')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <?php if ($oi['other_price'] > 0) : ?>
                                                        Rp <?= number_format($oi['other_price'], 0, ',', '.'); ?>
                                                    <?php else : ?>
                                                        <span class="text-danger" style="font-weight:bold">
                                                            - Rp <?= number_format(substr($oi['other_price'], 1), 0, ',', '.'); ?>
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
                                                Rp
                                                <span style="float:right;" id="teacher_fee_others_category">
                                                    <?= number_format($teacher_fee_others_category, 0, ',', '.'); ?>
                                                </span>
                                            </p>

                                        </h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif ?>
                <div class="row p-3" style="background-color:#a8dadc">
                    <div class="col-lg-9 col-9 text-center">
                        <h5 class="font-weight:bold">Grand Total</h5>
                    </div>
                    <div class="col-lg-3 col-3 text-lg-right text-center">
                        <h5 style="font-weight:bold">
                            <p style="text-align:left;">
                                Rp
                                <span style="float:right;" id="total_feereport">
                                    <?= number_format(intval($total_rate_event) + intval($teacher_fee_online_lesson) + intval($teacher_fee_offline_lesson) + intval($teacher_fee_others_category), 0, ',', '.'); ?>
                                </span>
                            </p>
                        </h5>
                    </div>
                </div>

                <?php if (count($id_student_nadia_online_temp) > 0) : ?>
                    <?php $euro = 0;
                        $dollar = 0; ?>
                    <?php for ($i = 0; $i < count($id_student_nadia_online_temp); $i++) : ?>
                        <?php $temp_id_student_nadia_online_temp[$i] = explode("&", $id_student_nadia_online_temp[$i]); ?>
                        <?php if ($temp_id_student_nadia_online_temp[$i][7] == '2') : ?>
                            <?php $dollar = 1 ?>
                        <?php endif ?>
                        <?php if ($temp_id_student_nadia_online_temp[$i][7] == '3') : ?>
                            <?php $euro = 1 ?>
                        <?php endif ?>
                    <?php endfor ?>

                    <?php if ($dollar == 1) : ?>
                        <h3 class="mt-5">
                            Invoice Details (DOLLAR):
                        </h3>
                        <h5>
                            Online Lesson
                        </h5>
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-white">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Student</th>
                                        <th class="text-center">Name of Package</th>
                                        <th class="text-center">Lesson Date</th>
                                        <th class="text-center">Total Pack</th>
                                        <th class="text-center">Last Pack</th>
                                        <th class="text-center">Next Pack</th>
                                        <th class="text-center">Price/Pack</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center">Teacher's Fee</th>
                                        <th class="text-center">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $z = 1; ?>
                                    <?php $total_pack_online = 0 ?>
                                    <?php $total_fee_online = 0 ?>
                                    <?php $teacher_fee = 0 ?>
                                    <?php $teacher_fee_online_lesson_dollar = 0 ?>
                                    <?php for ($i = 0; $i < count($id_student_nadia_online_temp); $i++) : ?>
                                        <?php $temp_id_student_nadia_online_temp[$i] = explode("&", $id_student_nadia_online_temp[$i]); ?>
                                        <?php if ($temp_id_student_nadia_online_temp[$i][7] == '2') : ?>
                                            <tr>
                                                <td class="text-center"><?= $z++ ?></td>
                                                <td class="text-center">
                                                    <?= $temp_id_student_nadia_online_temp[$i][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $temp_id_student_nadia_online_temp[$i][2] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?= $date_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?= $date_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php $total_pack_online =  $total_pack_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?php $total_pack_online =  $total_pack_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?= $total_pack_online ?>
                                                </td>
                                                <td class="text-center text-danger" style="font-weight:bold">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?= ($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center text-danger" style="font-weight:bold">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php if (((($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] + $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]]) % 2) == 0) && $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] == 1) : ?>
                                                            <?= ($tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                                        <?php else : ?>

                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php $total_fee_online = $temp_id_student_nadia_online_temp[$i][3] ?>
                                                    <?= "$ " . number_format($total_fee_online, 0, ',', '.'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= "$ " . number_format($total_pack_online * $total_fee_online, 0, ',', '.'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php $teacher_fee = $total_fee_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?php $teacher_fee = $total_fee_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?= "$ " . number_format($teacher_fee, 0, ',', '.'); ?>
                                                    <?php $teacher_fee_online_lesson_dollar += $teacher_fee ?>
                                                </td>
                                                <td class="text-center">
                                                    100%
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endfor ?>
                                    <tr style="background-color:#E8F6EF">
                                        <td class="text-center" colspan="8">
                                            <h5 class="font-weight:bold">Total Price</h5>
                                        </td>
                                        <td colspan="3">
                                            <h5 class="font-weight:bold">
                                                <p style="text-align:left;">
                                                    $
                                                    <span style="float:right;">
                                                        <?= number_format($teacher_fee_online_lesson_dollar, 0, ',', '.'); ?>
                                                    </span>
                                                </p>

                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif ?>
                    <?php if ($euro == 1) : ?>
                        <h3 class="mt-5">
                            Invoice Details (EUR):
                        </h3>
                        <h5>
                            Online Lesson
                        </h5>
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-white">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Student</th>
                                        <th class="text-center">Name of Package</th>
                                        <th class="text-center">Lesson Date</th>
                                        <th class="text-center">Total Pack</th>
                                        <th class="text-center">Last Pack</th>
                                        <th class="text-center">Next Pack</th>
                                        <th class="text-center">Price/Pack</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center">Teacher's Fee</th>
                                        <th class="text-center">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $z = 1; ?>
                                    <?php $total_pack_online = 0 ?>
                                    <?php $total_fee_online = 0 ?>
                                    <?php $teacher_fee = 0 ?>
                                    <?php $teacher_fee_online_lesson_euro = 0 ?>
                                    <?php for ($i = 0; $i < count($id_student_nadia_online_temp); $i++) : ?>
                                        <?php $temp_id_student_nadia_online_temp[$i] = explode("&", $id_student_nadia_online_temp[$i]); ?>
                                        <?php if ($temp_id_student_nadia_online_temp[$i][7] == '3') : ?>
                                            <tr>
                                                <td class="text-center"><?= $z++ ?></td>
                                                <td class="text-center">
                                                    <?= $temp_id_student_nadia_online_temp[$i][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $temp_id_student_nadia_online_temp[$i][2] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?= $date_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?= $date_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php $total_pack_online =  $total_pack_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?php $total_pack_online =  $total_pack_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?= $total_pack_online ?>
                                                </td>
                                                <td class="text-center text-danger" style="font-weight:bold">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?= ($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center text-danger" style="font-weight:bold">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php if (((($tipe_rate100_paket_pratical_before[$temp_id_student_nadia_online_temp[$i][6]] + $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]]) % 2) == 0) && $tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] == 1) : ?>
                                                            <?= ($tipe_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] % 2) == 1 ? "-1" : ""   ?>
                                                        <?php else : ?>

                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php $total_fee_online = $temp_id_student_nadia_online_temp[$i][3] ?>
                                                    <?= "€ " . number_format($total_fee_online, 0, ',', '.'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= "€ " . number_format($total_pack_online * $total_fee_online, 0, ',', '.'); ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 1) : ?>
                                                        <?php $teacher_fee = $total_fee_periode_rate100_paket_pratical[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?php if ($temp_id_student_nadia_online_temp[$i][4] == 2) : ?>
                                                        <?php $teacher_fee = $total_fee_periode_rate100_paket_teory[$temp_id_student_nadia_online_temp[$i][6]] ?>
                                                    <?php endif ?>
                                                    <?= "€ " . number_format($teacher_fee, 0, ',', '.'); ?>
                                                    <?php $teacher_fee_online_lesson_euro += $teacher_fee ?>
                                                </td>
                                                <td class="text-center">
                                                    100%
                                                </td>
                                            </tr>
                                        <?php endif ?>
                                    <?php endfor ?>
                                    <tr style="background-color:#E8F6EF">
                                        <td class="text-center" colspan="8">
                                            <h5 class="font-weight:bold">Total Price</h5>
                                        </td>
                                        <td colspan="3">
                                            <h5 class="font-weight:bold">
                                                <p style="text-align:left;">
                                                    €
                                                    <span style="float:right;">
                                                        <?= number_format($teacher_fee_online_lesson_euro, 0, ',', '.'); ?>
                                                    </span>
                                                </p>

                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif ?>
                <?php endif ?>

                <div class="row p-3">
                    <div class="col-lg-9 col-9 text-center">

                    </div>
                    <div class="col-lg-3 col-3 text-center">
                        <h5>Approved by,</h5>
                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>
                            <?php if ($data_sirkulasi_feereport[0]['status_approved'] == 1) : ?>
                                <img src="<?= base_url(); ?>assets/img/stamp.png" alt="Stamp Approved" style="width:100px">
                                <br><br>
                                <button id="btn_canceled" class="btn btn-danger">
                                    Canceled
                                </button>

                            <?php else : ?>
                                <h5 style="color:white; background-color:red">Not Approved</h5>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if ($data_sirkulasi_feereport[0]['status_approved'] == 1) : ?>
                                <img src="<?= base_url(); ?>assets/img/stamp.png" alt="Stamp Approved" style="width:100px">
                            <?php else : ?>
                                <small>Click here!</small><br>
                                <button id="btn_approved" class="btn btn-primary">
                                    Approve
                                </button>

                            <?php endif; ?>
                        <?php endif; ?>

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
        <?php if (count($other_feereport) > 0) : ?>
            <?php foreach ($other_feereport as $oi) : ?>
                document.getElementById("other_category<?= $oi['id_other_feereport'] ?>").value = '<?= $oi['other_category'] ?>';

                var other_price<?= $oi['id_other_feereport'] ?> = document.getElementById('other_price<?= $oi['id_other_feereport'] ?>').value;
                document.getElementById('rupiah_other_price<?= $oi['id_other_feereport'] ?>').value = convertToRupiah(other_price<?= $oi['id_other_feereport'] ?>);

                var total_feereport = parseInt(<?= $total_rate_event ?>) + parseInt(<?= $teacher_fee_online_lesson ?>) + parseInt(<?= $teacher_fee_offline_lesson ?>) + parseInt(<?= $teacher_fee_others_category ?>);

                document.getElementById('total_feereport').innerHTML = convertToRupiah(total_feereport);
                document.getElementById('teacher_fee_others_category').innerHTML = convertToRupiah(parseInt(<?= $teacher_fee_others_category ?>));

                var tot_other_feereport = <?= $tot_other_feereport ?>;
                var teacher_fee_others_category = <?= $teacher_fee_others_category ?>;
                var temp_value_before<?= $oi['id_other_feereport'] ?> = other_price<?= $oi['id_other_feereport'] ?>;

                rupiah_other_price<?= $oi['id_other_feereport'] ?>.addEventListener('keyup', function(e) {
                    let value_input = e.target.value.split('.').join("");
                    let tot_sementara = parseInt(teacher_fee_others_category) - parseInt(temp_value_before<?= $oi['id_other_feereport'] ?>);

                    rupiah_other_price<?= $oi['id_other_feereport'] ?>.value = convertToRupiah(value_input);
                    other_price<?= $oi['id_other_feereport'] ?>.value = value_input;

                    let total_feereport_new = parseInt(<?= $total_rate_event ?>) + parseInt(<?= $teacher_fee_online_lesson ?>) + parseInt(<?= $teacher_fee_offline_lesson ?>) + (parseInt(tot_sementara) + parseInt(value_input));


                    console.log(e)
                    console.log(tot_sementara + "sementara")

                    document.getElementById('total_feereport').innerHTML = convertToRupiah(total_feereport_new);
                    document.getElementById('teacher_fee_others_category').innerHTML = convertToRupiah((parseInt(tot_sementara) + parseInt(value_input)));

                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_feereport/<?= $oi['id_other_feereport'] ?>',
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
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_feereport/<?= $oi['id_other_feereport'] ?>',
                        data: {
                            "data": "other_category",
                            "value": temp_val,
                        },
                        success: function(data) {}
                    });
                }
                var other_category<?= $oi['id_other_feereport'] ?> = document.getElementById('other_category<?= $oi['id_other_feereport'] ?>');
                other_category<?= $oi['id_other_feereport'] ?>.addEventListener('keyup', function(e) {
                    var value = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url() ?>portal/C_Admin/update_data_other_feereport/<?= $oi['id_other_feereport'] ?>',
                        data: {
                            "data": "other_category",
                            "value": value,
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
        $('#btn_add_other_feereport').click(function() {
            add_other_feereport();
            window.location.reload();
        });

        function add_other_feereport() {
            let periode = "<?= $this->uri->segment(4) ?>";
            let id_teacher = "<?= $this->uri->segment(5) ?>";
            let counter = "<?= count($other_feereport) ?>"
            $.ajax({
                url: "<?= base_url('portal/C_Admin/add_other_feereport') ?>",
                type: "POST",
                data: {
                    'id_teacher': id_teacher,
                    'periode': periode,
                    'counter': counter,
                },
                success: function(data) {
                    alert("Added Other Category");
                }
            });
        }

        $('#btn_canceled').click(function() {
            updated_canceled();
        });

        function updated_canceled() {
            $.ajax({
                url: "<?= base_url('portal/C_Admin/updated_approved') ?>",
                type: "POST",
                data: {
                    'id_sirkulasi_feereport': '<?= $data_sirkulasi_feereport[0]['id_sirkulasi_feereport'] ?>',
                    'status_approved': 0,
                },
                success: function(data) {
                    alert("Cancel Approve Successfully");
                    location.reload();
                }
            });
        }

        $('#btn_approved').click(function() {
            updated_approved();
        });

        function updated_approved() {
            $.ajax({
                url: "<?= base_url('portal/C_Admin/updated_approved') ?>",
                type: "POST",
                data: {
                    'id_sirkulasi_feereport': '<?= $data_sirkulasi_feereport[0]['id_sirkulasi_feereport'] ?>',
                    'status_approved': 1,
                },
                success: function(data) {
                    alert("Approved Successfully");
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>