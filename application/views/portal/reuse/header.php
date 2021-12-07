<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
    <link rel="stylesheet" href="<?= base_url('assets/css/styleDashboard.css') ?>">

    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css'); ?>"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="<?= base_url('assets/js/fontawesome.min.js'); ?>"></script>
    <style>
        /* color */
        /* muda = #6ECEED
        sedang = #27A9E1
        tua = #1B75BB */
        @font-face {
            font-family: sReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Regular.ttf'); ?>');
        }

        @font-face {
            font-family: sItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-Italic.ttf'); ?>');
        }

        @font-face {
            font-family: lReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Light.ttf'); ?>');
        }

        @font-face {
            font-family: lItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-LightItalic.ttf'); ?>');
        }

        @font-face {
            font-family: mReguler;
            src: url('<?= base_url('assets/fonts/Montserrat-Medium.ttf'); ?>');
        }

        @font-face {
            font-family: mItalic;
            src: url('<?= base_url('assets/fonts/Montserrat-MediumItalic.ttf'); ?>');
        }

        @font-face {
            font-family: dashboardFont;
            src: url('<?= base_url('assets/fonts/Moonlight-Regular.otf'); ?>');
        }


        .btn-info,
        .btn-danger {
            /* background-color: #263850; */
            /* color: white; */
            font-size: 12px;
        }

        .btn-primary {
            border: 0;
            background-color: #0676BD;
            color: white;
            font-size: 12px;
        }

        .btn-primary:hover {
            background-color: #0676BD;
            color: white;
        }

        .avatar {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img-dashboard-icon {
            width: 100%;
            height: 100%;
            /* position: absolute; */
            bottom: 0;
        }

        .cover-dashboard-icon {
            width: 350px;
            display: block;
            margin: 0 auto;
        }

        .cover-img {
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto;
        }

        .cover-profile {
            width: 60px;
            height: 60px;
        }

        .fc-time {
            display: none;
        }

        .fc-title {
            color: white;
        }

        .fc-view-container {
            margin-top: 30px;
        }

        .fc-sun {
            /* background-color: #ff7171; */
            /* color: white; */
        }

        /* .fc-sat span, */
        .fc-sun span {
            /* color: white;
            font-weight: bold; */
        }

        .fc-unthemed td.fc-today {
            background-color: #5fdde5;
            color: white;
        }

        @media (max-width: 990px) {
            .fc-center {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body style="font-family:sReguler">
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper shadow">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <div class="row">
                        <div class="col-lg-2 col-2">
                            <a href="<?= site_url('portal') ?>" style="text-decoration:none">
                                <img src="<?= base_url(); ?>assets/img/logo.png" alt="logo Etude" width="100px">
                            </a>
                        </div>
                        <div class="col-lg-8 col-8"></div>
                        <div class="col-lg-2 col-2">
                            <div id="close-sidebar">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <?php if (substr($this->session->userdata('id'), 0, 1) == 3) { ?>
                            <img class="img-responsive rounded-circle" src="<?= base_url(); ?>assets/img/avatar.png" alt="User picture">
                        <?php } else { ?>
                            <!-- <img class="img-responsive rounded-circle" src="" alt="User picture"> -->
                            <?php foreach ($teacher as $t) : ?>
                                <?php if ($t['id_teacher'] == $this->session->userdata('id')) : ?>
                                    <div class="cover-profile">
                                        <img class="avatar" src="<?= base_url(); ?>assets/img/pict_guru/<?= $t['pict_teacher'] ?>" alt="User picture">
                                    </div>
                                    <!-- <img width="50px" height="50px" class="img-responsive rounded-circle" src="<?= base_url(); ?>assets/img/pict_guru/<?= $t['pict_teacher'] ?>" alt="User picture"> -->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                    <div class="user-info">
                        <span class="user-status">&nbsp;</span>
                        <span class="user-name">
                            <strong>
                                <?php if (substr($this->session->userdata('id'), 0, 1) == 3) { ?>
                                    Hello, Admin
                                <?php } else { ?>
                                    <?= $this->session->userdata('name'); ?>
                                <?php } ?>
                            </strong>
                        </span>
                        <span class="user-role">
                            ID :
                            <?= $this->session->userdata('id'); ?>
                        </span>

                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <!-- <li>
                            <a href="#" class="active">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li> -->
                        <?php if (substr($this->session->userdata('id'), 0, 1) == "2") : ?>
                            <li>
                                <a href="<?= site_url() ?>portal/profile/<?= $this->session->userdata('username') ?>" class="<?php echo $this->uri->segment(2) == 'profile' ? 'active' : '' ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/offline_lesson" class="<?php echo $this->uri->segment(2) == 'offline_lesson' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Offline Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/online_pratical" class="<?php echo $this->uri->segment(2) == 'online_pratical' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Online Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/online_theory" class="<?php echo $this->uri->segment(2) == 'online_theory' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Theory Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/offline_trial" class="<?php echo $this->uri->segment(2) == 'offline_trial' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Offline Trial</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/attendance_summary" class="<?php echo $this->uri->segment(2) == 'attendance_summary' ? 'active' : '' ?>">
                                    <i class="fa fa-calendar"></i>
                                    <span>Attendance Summary</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/event_teacher" class="<?php echo $this->uri->segment(2) == 'event_teacher' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Event</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/fee_report/<?= $this->session->userdata('id') ?>" class="<?php echo $this->uri->segment(2) == 'fee_report' ? 'active' : '' ?>">
                                    <i class="fa fa-dollar-sign"></i>
                                    <span>Fee Report</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (substr($this->session->userdata('id'), 0, 1) == "3") : ?>

                            <li>
                                <a href="<?= site_url() ?>portal/data_student" class="<?php echo $this->uri->segment(2) == 'data_student' ? 'active' : '' ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Data Student</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/data_teacher" class="<?php echo $this->uri->segment(2) == 'data_teacher' ? 'active' : '' ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Data Teacher</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/data_paket" class="<?php echo $this->uri->segment(2) == 'data_paket' ? 'active' : '' ?>">
                                    <i class="fa fa-user"></i>
                                    <span>Data Package</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/data_offline_lesson" class="<?php echo $this->uri->segment(2) == 'data_offline_lesson' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Data Offline Lesson</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/data_online_lesson" class="<?php echo $this->uri->segment(2) == 'data_online_lesson' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Data Online Lesson</span>
                                </a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="<?= site_url() ?>portal/data_theory_lesson" class="<?php echo $this->uri->segment(2) == 'data_theory_lesson' ? 'active' : '' ?>">-->
                            <!--        <i class="fa fa-graduation-cap"></i>-->
                            <!--        <span>Data Theory Lesson</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <li>
                                <a href="<?= site_url() ?>portal/event" class="<?php echo $this->uri->segment(2) == 'event' ? 'active' : '' ?>">
                                    <i class="fa fa-graduation-cap"></i>
                                    <span>Event</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="<?= site_url() ?>portal/note" class="<?php echo $this->uri->segment(2) == 'note' ? 'active' : '' ?>">
                                    <i class="fa fa-sticky-note"></i>
                                    <span>Note</span>
                                </a>
                            </li> -->
                            <li>
                                <a href="<?= site_url() ?>portal/book" class="<?php echo $this->uri->segment(2) == 'book' ? 'active' : '' ?>">
                                    <i class="fa fa-book-open"></i>
                                    <span>Book</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/invoice" class="<?php echo $this->uri->segment(2) == 'invoice' ? 'active' : '' ?>">
                                    <i class="fa fa-credit-card"></i>
                                    <span>Invoice</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= site_url() ?>portal/feereport" class="<?php echo $this->uri->segment(2) == 'feereport' ? 'active' : '' ?>">
                                    <i class="fa fa-file-invoice-dollar"></i>
                                    <span>Fee Report</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="<?= site_url() ?>portal/convert" class="<?php echo $this->uri->segment(2) == 'convert' ? 'active' : '' ?>">
                                    <i class="fa fa-dollar-sign"></i>
                                    <span>Convert Rate</span>
                                </a>
                            </li> -->

                        <?php endif; ?>
                        <li>
                            <a href="<?= site_url('portal/user-logout'); ?>">
                                <i class="fa fa-sign-out-alt"></i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page">