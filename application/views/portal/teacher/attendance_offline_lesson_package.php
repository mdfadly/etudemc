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
    }

    .callout h4 {
        margin-top: 0;
        margin-bottom: 5px;
    }

    .callout p:last-child {
        margin-bottom: 0;
    }

    .callout code {
        border-radius: 3px;
    }

    .callout .bs-callout {
        margin-top: -5px;
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
            <div class="col-lg-12">
                <a href="<?= site_url() ?>portal/offline_lesson" class="btn btn-primary mr-3">
                    <i class="fa fa-arrow-left mr-2"></i>
                    Back
                </a>
            </div>
        </div>
        <hr>
        <h2 style="font-weight:bold">Attendance Offline Lesson</h2>
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
                        Lesson Package : <span class="badge badge-primary"> <?= intval($pack_online[0]['total_package']) - intval(count($count_package)) ?> package (<?= intval($pack_online[0]['total_package']) - intval(count($count_package)) ?> meeting)</span>
                        <input type="hidden" id="countPackage" name="countPackage" value="<?= intval($pack_online[0]['total_package']) - intval(count($count_package)) ?>">
                        <input type="hidden" id="countCancel" name="countCancel" value="0">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 border p-3" style="font-size:17px;">
                <span class="mr-4" style="color:#EB1AE0">
                    <i class="fa fa-square"></i>
                    Meeting
                </span>
            </div>
            <div class="col-lg-12 pt-4">
                <div id="calendar"></div>
            </div>
            <div id="calendarModalUpdate" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                        </div>
                        <div id="modalBody" class="modal-body text-center">
                            <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_update" aria-describedby="date_form">
                            <input type="hidden" class="form-control" name="date" id="date_update" aria-describedby="date_form">
                            <h5 class="col-lg-12">Does the class run today?</h5>
                            <button id="btn_update" class="btn btn-info col-lg-5 col-5">Yes</button>
                            <button id="btn_cancel_lesson" class="btn btn-danger  col-lg-5 col-5">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calendarModalOption" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                        </div>
                        <div id="modalBody" class="modal-body text-center">
                            <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_noles" aria-describedby="date_form">
                            <input type="hidden" class="form-control" name="date" id="date_noles" aria-describedby="date_form">
                            <button id="btn_cancel" class="btn btn-info  col-lg-5 col-5">Reschedule</button>
                            <button id="btn_nolesson" class="btn btn-danger col-lg-5 col-5">No Lesson</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calendarModalCancel" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                        </div>
                        <div id="modalBody" class="modal-body text-center">
                            <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_back" aria-describedby="date_form">
                            <input type="hidden" class="form-control" name="date" id="date_back" aria-describedby="date_form">
                            <h5 class="col-lg-12">Please input date to change the schedule <span style="color:red;font-weight:bold;">*</span></h5>
                            <input type="text" class="form-control datepicker" name="date_reschedule" id="date_reschedule" value="" aria-describedby="date_form" required>
                            <small class="form-text" style="color:red; font-weight:bold">Choose Date</small>
                            <br>
                            <button id="btn_cancel_attendance" class="btn btn-warning text-white col-lg-5 col-5">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calendarModalActive" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Reactivate Teacher Attendance</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                        </div>
                        <div id="modalBody" class="modal-body">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="jenis" id="jenis_active" aria-describedby="jenis_form">
                                <input type="hidden" class="form-control" name="date" id="date_active" aria-describedby="date_form">
                                <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_active" aria-describedby="date_form">
                            </div>
                            <div class="row text-center ml-2 mr-2">
                                <button id="btn_cancel_reschedule" class="btn btn-warning btn-block col-lg-12">Reschedule</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="calendarModalReschedule" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                        </div>
                        <div id="modalBody" class="modal-body text-center">
                            <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_back" aria-describedby="date_form">
                            <input type="hidden" class="form-control" name="date" id="date_back" aria-describedby="date_form">
                            <h5 class="col-lg-12">Please input date to change the schedule <span style="color:red;font-weight:bold;">*</span> </h5>
                            <input type="text" class="form-control datepicker" name="date_reschedule" id="date_reschedule_nolesson" value="" aria-describedby="date_form" required>
                            <small class="form-text" style="color:red; font-weight:bold">Choose Date</small>
                            <br>
                            <button id="btn_cancel_nolesson" class="btn btn-warning text-white col-lg-5 col-5">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/fullcalendar/gcal.js"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.js') ?>"></script>
<script>
    $(".datepicker").datepicker({
        weekStart: 1,
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    $(document).ready(function() {
        cekPackage();
        $(".next").html('<i class="fa fa-arrow-right"></i>');
        $(".prev").html('<i class="fa fa-arrow-left"></i>');
    });

    function cekPackage(today) {
        $.ajax({
            url: "<?= base_url() ?>portal/C_Teacher/cek_package_offline/<?= $pack_online[0]['id_list_package_offline'] ?>",
            type: "POST",
            data: {
                'status': '2',
                'today': '<?= date("Y-m-d") ?>'
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                $("#counter_pack").html(data);
            }
        });
    }
</script>
<script>
    var calendar = $('#calendar').fullCalendar({
        height: 650,
        firstDay: 1,
        dayMaxEvents: 1,
        events: "<?= site_url() ?>portal/C_Teacher/load_package_offline/<?= $pack_online[0]['id_list_package_offline'] ?>",
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
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                    "background-color": "#DE7CD9",
                    "color": "white",
                });

            }
            if (event.title.substr(0, 2) == "No") {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                    "background-color": "#D0CAB2",
                    "color": "white",
                });
            }
            if (event.status != 3) {
                if (event.status == 1) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#EB1AE0",
                        "color": "white",
                    });
                }
                if (event.status == 2 || event.status == 4) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#DE7CD9",
                        "color": "white",
                    });
                }
                $(view.el[0]).find('.fc-day-top[data-date=' + dateString + ']').css({
                    "color": "white"
                });
            }
        },
        eventClick: function(event, jsEvent, view) {
            const cancelCount = document.getElementById("countCancel").value;
            var countLesson = document.getElementById("countPackage").value;

            var dateString = event.start.format("YYYY-MM-DD");
            if (event.status == 1) {
                var date_event = event.date;
                document.getElementById("date_update").value = date_event.slice(0, 10);
                document.getElementById("id_schedule_online_update").value = event.id;
                $('#calendarModalUpdate').modal();
            }
            if (event.status == 2 || event.status == 4 || event.title == "Reschedule") {
                alert('Attendance was done');
            }
            if (event.status == 3) {
                alert('Attendance was done');
            }
            if (event.status == 5) {
                alert('Attendance was late, please contact our support team for fix it');
            }
            if (event.status == 7) {
                var date_event = event.date;
                document.getElementById("date_active").value = date_event.slice(0, 10);
                document.getElementById("id_schedule_online_active").value = event.id;
                $('#calendarModalActive').modal();
            }
        },
    });
    $('#btn_update').click(function() {
        var id_teacher = "<?= $this->session->userdata('id') ?>";
        var tgl = $("#date_update").val();
        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

        var arrayTempNoSirkulasi = [];
        <?php foreach ($feereport as $f) : ?>
            arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
        <?php endforeach ?>

        <?php if (count($feereport) > 0) : ?>
            if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                <?php foreach ($feereport as $f) : ?>
                    if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                        if ('<?= $f['status_approved'] ?>' === '1') {
                            alert("Can't add, fee report has been approved!");
                        } else {
                            updateData();
                            document.getElementById("id_schedule_online_update").value = "";
                            $('#calendarModalUpdate').modal('hide');
                        }
                    }
                <?php endforeach ?>
            } else {
                updateData();
                document.getElementById("id_schedule_online_update").value = "";
                $('#calendarModalUpdate').modal('hide');
            }
        <?php else : ?>
            updateData();
            document.getElementById("id_schedule_online_update").value = "";
            $('#calendarModalUpdate').modal('hide');
        <?php endif ?>
    });

    function updateData() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var id_teacher = "<?= $this->session->userdata('id') ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var tgl = $("#date_update").val();
        var price = "<?= $pack_online[0]['price_idr_paket'] ?>";
        var paket = "<?= $pack_online[0]['paket'] ?>";
        var teacher_percentage = "<?= $pack_online[0]['teacher_percentage'] ?>";
        var rate_dollar = "<?= $pack_online[0]['rate_dollar'] ?>";
        if (rate_dollar === '3') {
            price = "<?= $pack_online[0]['price_euro'] ?>";
        }
        if (rate_dollar === '2') {
            price = "<?= $pack_online[0]['price_dollar'] ?>";
        }
        var is_new = "<?= $pack_online[0]['is_new'] ?>";

        const potongan = <?= $pack_online[0]['total_discount_rate'] ?>;
        const price_paket = <?= $pack_online[0]['price_paket'] ?>;

        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'status': '2',
                'id_schedule_online': id_schedule_online,
                'id_list_package_offline': id_list_package_offline,
                'id_teacher': id_teacher,
                'id_student': id_student,
                'tgl': tgl,
                'price': price,
                'paket': paket,
                'teacher_percentage': teacher_percentage,
                'is_new': is_new,
                'potongan': potongan,
                'price_paket': price_paket,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                $("#counter_pack").html(data);
                alert("Updated Successfully");
            }
        });
    }
    $('#btn_cancel_lesson').click(function() {
        $('#calendarModalUpdate').modal('hide');
        $('#calendarModalOption').modal('show');
    });
    $('#btn_cancel').click(function() {
        $('#calendarModalOption').modal('hide');
        $('#calendarModalCancel').modal('show');
    });
    $('#btn_cancel_attendance').click(function() {
        var date_reschedule = $("#date_reschedule").val();
        if (date_reschedule !== "") {
            var id_teacher = "<?= $this->session->userdata('id') ?>";
            var tgl = $("#date_update").val();
            var datetemp = tgl.substr(0, 7).replace("-", "");
            var idtemp = id_teacher.substr(3);
            var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

            var arrayTempNoSirkulasi = [];
            <?php foreach ($feereport as $f) : ?>
                arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
            <?php endforeach ?>

            <?php if (count($feereport) > 0) : ?>
                if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                    <?php foreach ($feereport as $f) : ?>
                        if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                            if ('<?= $f['status_approved'] ?>' === '1') {
                                alert("Can't cancel, fee report has been approved!");
                            } else {
                                cancelAttendance();
                                rescheduleAttendance();
                                document.getElementById("id_schedule_online_update").value = "";
                                $('#calendarModalUpdate').modal('hide');
                                $('#calendarModalCancel').modal('hide');
                            }
                        }
                    <?php endforeach ?>
                } else {
                    cancelAttendance();
                    rescheduleAttendance();
                    document.getElementById("id_schedule_online_update").value = "";
                    $('#calendarModalUpdate').modal('hide');
                    $('#calendarModalCancel').modal('hide');
                }
            <?php else : ?>
                cancelAttendance();
                rescheduleAttendance();
                document.getElementById("id_schedule_online_update").value = "";
                $('#calendarModalUpdate').modal('hide');
                $('#calendarModalCancel').modal('hide');
            <?php endif ?>
        } else {
            alert("please input date valid!")
        }
    });

    function cancelAttendance() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var tgl = $("#date_update").val();
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_package_offline': id_list_package_offline,
                'status': '3',
            },
            success: function(data) {

            }
        });
    }

    function rescheduleAttendance() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var date_update_cancel = $("#date_reschedule").val();
        var id_teacher = "<?= $this->session->userdata('id') ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var price = "<?= $pack_online[0]['price_idr_paket'] ?>";

        var paket = "<?= $pack_online[0]['paket'] ?>";
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var teacher_percentage = "<?= $pack_online[0]['teacher_percentage'] ?>";
        var rate_dollar = "<?= $pack_online[0]['rate_dollar'] ?>";
        if (rate_dollar === '3') {
            price = "<?= $pack_online[0]['price_euro'] ?>";
        }
        if (rate_dollar === '2') {
            price = "<?= $pack_online[0]['price_dollar'] ?>";
        }
        var is_new = "<?= $pack_online[0]['is_new'] ?>";
        const potongan = <?= $pack_online[0]['total_discount_rate'] ?>;
        const price_paket = <?= $pack_online[0]['price_paket'] ?>;
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/reschedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_pack': id_schedule_online,
                'date_update_cancel': date_update_cancel,
                'id_teacher': id_teacher,
                'id_student': id_student,
                'price': price,
                'paket': paket,
                'id_list_package_offline': id_list_package_offline,
                'teacher_percentage': teacher_percentage,
                'is_new': is_new,
                'potongan': potongan,
                'price_paket': price_paket,
            },
            success: function(data) {
                calendar.fullCalendar('refetchResources');
                cekPackage();
                location.reload();
                alert("Reschedule Successfully");
            }
        });
    }

    $('#btn_nolesson').click(function() {
        var id_teacher = "<?= $this->session->userdata('id') ?>";
        var tgl = $("#date_update").val();
        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

        var arrayTempNoSirkulasi = [];
        <?php foreach ($feereport as $f) : ?>
            arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
        <?php endforeach ?>

        <?php if (count($feereport) > 0) : ?>
            if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                <?php foreach ($feereport as $f) : ?>
                    if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                        if ('<?= $f['status_approved'] ?>' === '1') {
                            alert("Can't cancel, fee report has been approved!");
                        } else {
                            cancelLesson();
                            document.getElementById("id_schedule_online_update").value = "";
                            $('#calendarModalOption').modal('hide');
                        }
                    }
                <?php endforeach ?>
            } else {
                cancelLesson();
                document.getElementById("id_schedule_online_update").value = "";
                $('#calendarModalOption').modal('hide');
            }
        <?php else : ?>
            cancelLesson();
            document.getElementById("id_schedule_online_update").value = "";
            $('#calendarModalOption').modal('hide');
        <?php endif ?>
    });

    function cancelLesson() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var tgl = $("#date_update").val();
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_package_offline': id_list_package_offline,
                'status': '7',
            },
            success: function(data) {
                calendar.fullCalendar('refetchResources');
                $("#counter_pack").html(data);
                cekPackage();
                location.reload();
                alert("Cancel No Lesson Successfully");
            }
        });
    }

    $('#btn_cancel_reschedule').click(function() {
        $('#calendarModalActive').modal('hide');
        $('#calendarModalReschedule').modal('show');
    });

    $('#btn_cancel_nolesson').click(function() {
        var date_reschedule = $("#date_reschedule_nolesson").val();
        if (date_reschedule !== "") {
            var id_teacher = "<?= $this->session->userdata('id') ?>";
            var tgl = $("#date_active").val();
            var datetemp = tgl.substr(0, 7).replace("-", "");
            var idtemp = id_teacher.substr(3);
            var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

            var arrayTempNoSirkulasi = [];
            <?php foreach ($feereport as $f) : ?>
                arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
            <?php endforeach ?>

            <?php if (count($feereport) > 0) : ?>
                if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                    <?php foreach ($feereport as $f) : ?>
                        if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                            if ('<?= $f['status_approved'] ?>' === '1') {
                                alert("Can't cancel, fee report has been approved!");
                            } else {
                                cancelAttendanceNolesson();
                                rescheduleAttendanceNolesson();
                                document.getElementById("id_schedule_online_update").value = "";
                                $('#calendarModalReschedule').modal('hide');
                            }
                        }
                    <?php endforeach ?>
                } else {
                    cancelAttendanceNolesson();
                    rescheduleAttendanceNolesson();
                    document.getElementById("id_schedule_online_update").value = "";
                    $('#calendarModalReschedule').modal('hide');
                }
            <?php else : ?>
                cancelAttendanceNolesson();
                rescheduleAttendanceNolesson();
                document.getElementById("id_schedule_online_update").value = "";
                $('#calendarModalReschedule').modal('hide');
            <?php endif ?>
        } else {
            alert("please input date valid!")
        }
    });

    function cancelAttendanceNolesson() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var tgl = $("#date_active").val();
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_package_offline': id_list_package_offline,
                'status': '3',
            },
            success: function(data) {

            }
        });
    }

    function rescheduleAttendanceNolesson() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var date_update_cancel = $("#date_reschedule_nolesson").val();
        var id_teacher = "<?= $this->session->userdata('id') ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var price = "<?= $pack_online[0]['price_idr_paket'] ?>";
        var paket = "<?= $pack_online[0]['paket'] ?>";
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var teacher_percentage = "<?= $pack_online[0]['teacher_percentage'] ?>";
        var rate_dollar = "<?= $pack_online[0]['rate_dollar'] ?>";
        if (rate_dollar === '3') {
            price = "<?= $pack_online[0]['price_euro'] ?>";
        }
        if (rate_dollar === '2') {
            price = "<?= $pack_online[0]['price_dollar'] ?>";
        }
        var is_new = "<?= $pack_online[0]['is_new'] ?>";
        const potongan = <?= $pack_online[0]['total_discount_rate'] ?>;
        const price_paket = <?= $pack_online[0]['price_paket'] ?>;
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/reschedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_pack': id_schedule_online,
                'date_update_cancel': date_update_cancel,
                'id_teacher': id_teacher,
                'id_student': id_student,
                'price': price,
                'paket': paket,
                'id_list_package_offline': id_list_package_offline,
                'teacher_percentage': teacher_percentage,
                'is_new': is_new,
                'potongan': potongan,
                'price_paket': price_paket,
            },
            success: function(data) {
                calendar.fullCalendar('refetchResources');
                cekPackage();
                location.reload();
                alert("Reschedule Successfully");
            }
        });
    }
</script>