<style>
    #calendar {
        font-weight: bold;
    }

    .fc-title {
        font-weight: bold;
    }

    .callout {
        padding: 20px;
        margin: 20px 0;
        border: 1px solid #eee;
        border-left-width: 5px;
        border-radius: 3px;

        h4 {
            margin-top: 0;
            margin-bottom: 5px;
        }

        p:last-child {
            margin-bottom: 0;
        }

        code {
            border-radius: 3px;
        }

        &+.bs-callout {
            margin-top: -5px;
        }
    }

    .callout-primary {
        border-left-color: #428bca;
    }

    .callout-primary h4 {
        color: #428bca;
    }

    .fc-event {
        height: 3em;
        cursor: pointer;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($jenis == 1) : ?>
                <div class="col-lg-12">
                    <a href="<?= site_url() ?>portal/online-pratical/list/<?= $pack_online[0]['id_student'] ?>" class="btn btn-primary mr-3">
                        <i class="fa fa-arrow-left mr-2"></i>
                        Back
                    </a>
                </div>
            <?php else : ?>
                <div class="col-lg-12">
                    <a href="<?= site_url() ?>portal/online-theory/list/<?= $pack_online[0]['id_student'] ?>" class="btn btn-primary mr-3">
                        <i class="fa fa-arrow-left mr-2"></i>
                        Back
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <hr>
        <?php if ($jenis == 1) : ?>
            <h2 style="font-weight:bold">Attendance Online Lesson</h2>
        <?php else : ?>
            <h2 style="font-weight:bold">Attendance Theory Lesson</h2>
        <?php endif; ?>
        <h5>
            (<?= $pack_online[0]['name_student'] ?>)
        </h5>
        <div class="row pt-3">
            <div class="col-lg-12">
                <?php $date_created = date_create($pack_online[0]['created_at']); ?>
                <?php $date_end = date_create($pack_online[0]['end_at']); ?>
                <div class="card callout callout-primary pt-4 pl-4">
                    <div class="card pt-2 pl-3 pb-2 bg-warning text-white">
                        Package limit : <br>
                        <?= date_format($date_created, "j F Y"); ?> - <?= date_format($date_end, "j F Y"); ?>
                    </div>
                    <div class="pt-2" id="counter_pack">
                        <?php if ($jenis == 1) : ?>
                            Lesson Package : <span class="badge badge-primary"> <?= round((intval($pack_online[0]['total_pack_practical']) - intval(count($count_pratical))) / 2) ?> package (<?= intval($pack_online[0]['total_pack_practical']) - intval(count($count_pratical)) ?> meeting)</span>
                            <input type="hidden" id="countPractical" name="countPractical" value="<?= intval($pack_online[0]['total_pack_practical']) - intval(count($count_pratical)) ?>">
                        <?php else : ?>
                            Lesson Package : <span class="badge badge-primary"> <?= intval($pack_online[0]['total_pack_theory']) - intval(count($count_theory)) ?> package (<?= intval($pack_online[0]['total_pack_theory']) - intval(count($count_theory)) ?> meeting) </span>
                            <input type="hidden" id="countTheory" name="countTheory" value="<?= intval($pack_online[0]['total_pack_theory']) - intval(count($count_theory)) ?>">
                        <?php endif; ?>
                        <input type="hidden" id="countCancel" name="countCancel" value="0">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 border p-3" style="font-size:17px;">
                <?php if ($jenis == 1) : ?>
                    <span class="mr-4" style="color:#5356FF">
                        <i class="fa fa-square"></i>
                        Practical
                    </span>
                <?php else : ?>
                    <span class="mr-4" style="color:#0676BD">
                        <i class="fa fa-square"></i>
                        Theory
                    </span>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 pt-4">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/gcal.js"></script>
<script>
    var calendar = $('#calendar').fullCalendar({
        <?php
        $startdate = strtotime(substr($pack_online[0]['created_at'], 0, 10));
        $enddate = strtotime("+5 months", $startdate);
        $temp_date =  date("Y-m-d", $enddate);
        ?>
        height: 650,
        firstDay: 1,
        dayMaxEvents: 1,
        events: "<?= site_url() ?>portal/C_Parent/load_package/<?= $pack_online[0]['id_list_pack'] ?>/<?= $pack_online[0]['id_student'] ?>/<?= $jenis ?>",
        dayRender: function(date, jsEvent, view) {
            tahun = <?= substr($pack_online[0]['created_at'], 0, 4) ?>;
            bulan = parseInt(<?= substr($pack_online[0]['created_at'], 5, 2) ?>) - 1;
            tanggal = <?= substr($pack_online[0]['created_at'], 8, 2) ?>;
            var myDate = new Date(tahun, bulan, tanggal);

            var monthsToAdd = 3;

            var addDate = new Date();
            addDate.setMonth(myDate.getMonth() + monthsToAdd);
            addDate.setDate(addDate.getDate() - 1);
            var dateString = date.format("YYYY-MM-DD");
            var today = new Date();
            if (date >= myDate && date < addDate && today < date) {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                    "background-color": "#FFFFFF",
                });
            } else {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#f1f6f9');
            }
            $(view.el[0]).find('.fc-sun[data-date=' + dateString + ']').css('background-color', '#ff7171');
        },
        eventRender: function(event, element, view) {
            var dateString = event.start.format("YYYY-MM-DD");
            if (event.title.substr(0, 2) == "Re") {
                if (event.jenis == 1) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#5356FF",
                        "color": "white",
                    });
                }
                if (event.jenis == 2) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#0D99FF",
                        "color": "white",
                    });
                }
            }
            if (event.title.substr(0, 2) == "No") {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                    "background-color": "#D0CAB2",
                    "color": "white",
                });
            }
            if (event.status != 3) {
                if (event.jenis == 1) {
                    if (event.status == 1) {
                        $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                            "background-color": "#43E514",
                            "color": "white",
                        });
                    }
                    if (event.status == 2 || event.status == 4) {
                        $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                            "background-color": "#5356FF",
                            "color": "white",
                        });
                    }
                    $(view.el[0]).find('.fc-day-top[data-date=' + dateString + ']').css({
                        "color": "white"
                    });
                }
                if (event.jenis == 2) {
                    if (event.status == 1) {
                        $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                            "background-color": "#0676BD",
                            "color": "white",
                        });
                    }
                    if (event.status == 2 || event.status == 4) {
                        $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                            "background-color": "#0D99FF",
                            "color": "white",
                        });
                    }

                    $(view.el[0]).find('.fc-day-top[data-date=' + dateString + ']').css({
                        "color": "white"
                    });
                }
            }
        },
    });
</script>