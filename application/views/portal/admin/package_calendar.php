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
        height: 4em;
        cursor: pointer;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->session->flashdata('warning') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $this->session->flashdata('warning') ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>
        </div>
        <div style="text-align:left;">
            <span style="font-family:mReguler; font-size:20px;" class="font-weight-bold">
                <a href="<?= site_url() ?>portal/data_online_lesson" class="btn btn-primary mr-3">
                    <i class="fa fa-arrow-left mr-2"></i>
                    Back
                </a>
            </span>
            <span style="float:right;">

            </span>
        </div>

        <hr>
        <h2 style="font-weight:bold">Lesson Date</h2>
        <h5>
            <?= $pack_online[0]['name_student'] ?>
        </h5>

        <div class="row pt-3">
            <div class="col-lg-12">
                <?php $date_created = date_create($pack_online[0]['created_at']); ?>
                <?php $date_end = date_create($pack_online[0]['end_at']); ?>
                <div class="card callout callout-primary pt-4 pl-4">
                    <div class="card pt-2 pl-3 pb-2 bg-warning text-white">
                        Limit of Package : <br>
                        <?= date_format($date_created, "j F Y"); ?> - <?= date_format($date_end, "j F Y"); ?>
                    </div>
                    <p class="pt-2" id="counter_pack">
                        Total Practical Meeting = <span class="badge badge-primary"> <?= intval($pack_online[0]['total_pack_practical']) - intval(count($count_pratical)) ?> lesson</span> <br>
                        Total Theory Meeting = <span class="badge badge-primary"> <?= intval($pack_online[0]['total_pack_theory']) - intval(count($count_theory)) ?> lesson<span>
                    </p>
                    <p>
                        <span id="total_practical_meet" class="badge badge-primary" style="display:none"> <?= intval($pack_online[0]['total_pack_practical']) - intval(count($count_pratical_pick)) ?> lesson</span>
                        <span id="total_theory_meet" class="badge badge-primary" style="display:none"> <?= intval($pack_online[0]['total_pack_theory']) - intval(count($count_theory_pick)) ?> lesson<span>
                    </p>
                </div>
            </div>
            <div class="col-lg-12 border p-3" style="font-size:17px;">
                <span class="mr-4" style="color:#ffc93c">
                    <i class="fa fa-square"></i>
                    Practical
                </span>
                <span class="mr-4" style="color:#056676">
                    <i class="fa fa-square"></i>
                    Theory
                </span>
            </div>
            <div class="col-lg-12 pt-4">
                <div id="calendar">
                </div>
                <div id="calendarModalAdd" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <span style="font-weight:bold">Add Attendance</span>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <small style="padding-left:15px; padding-top:5px" id="modalTitle"></small>
                            <div id="modalBody" class="modal-body">
                                <!-- <form id="formAdd"> -->
                                <div class="form-group">
                                    <label for="jenis">Type of Class</label>
                                    <select class="form-control" id="jenis_select" name="jenis_select" onchange="myFunction(event)" required>
                                        <?php if (count($count_pratical_pick) != $pack_online[0]['total_pack_practical']) : ?>
                                            <option value="1">Practical</option>
                                        <?php endif; ?>
                                        <?php if (count($count_theory_pick) != $pack_online[0]['total_pack_theory']) : ?>
                                            <option value="2">Theory</option>
                                        <?php endif; ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="jenis" value="1" id="jenis" aria-describedby="jenis_form">
                                    <input type="hidden" class="form-control" name="date" id="date" aria-describedby="date_form">
                                </div>
                                <input type="hidden" class="form-control" name="status" value="1" id="status" aria-describedby="status_form">
                                <!-- <div class="form-group">
                                    <label for="status">status</label>
                                    <select class="form-control" id="status_select" onchange="myFunction2(event)">
                                        <option value="1">Undone</option>
                                        <option value="2">done</option>
                                        <option value="3">Cancel</option>
                                    </select>
                                    <input type="hidden" class="form-control" name="status" value="1" id="status" aria-describedby="status_form">
                                </div> -->
                                <button id="btn_insert" class="btn btn-primary btn-block">Save</button>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendarModalUpdate" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Update Attendance</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <!-- <form action="#" method="POST"> -->
                                <div class="form-group">
                                    <label for="jenis">Type of Class</label>
                                    <select class="form-control" id="jenis_select_update" name="jenis_select_update" onchange="myFunction3(event)" required>
                                        <?php if (count($count_pratical) != $pack_online[0]['total_pack_practical']) : ?>
                                            <option value="1">Practical</option>
                                        <?php endif; ?>
                                        <?php if (count($count_theory) != $pack_online[0]['total_pack_theory']) : ?>
                                            <option value="2">Theory</option>
                                        <?php endif; ?>
                                    </select>
                                    <input type="hidden" class="form-control" name="jenis" id="jenis_update" aria-describedby="jenis_form">
                                    <input type="hidden" class="form-control" name="date" id="date_update" aria-describedby="date_form">
                                    <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_update" aria-describedby="date_form">
                                </div>
                                <div class="form-group">
                                    <label for="status">status</label>
                                    <select class="form-control" id="status_select_update" onchange="myFunction4(event)">
                                        <option value="1">Undone</option>
                                        <option value="2">done</option>
                                        <!-- <option value="3">Cancel</option> -->
                                    </select>
                                    <input type="hidden" class="form-control" name="status" id="status_update" aria-describedby="status_form">
                                </div>
                                <button id="btn_update" class="btn btn-info btn-block">Update</button>
                                <button id="btn_delete" class="btn btn-danger btn-block">Delete</button>
                                <!-- </form> -->
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
                                <!-- <h5 class="col-lg-12">Apakah murid akan pilih hari atau tidak?</h5> -->
                                <button id="btn_reactivate" class="btn btn-info  col-lg-5 col-5">Reactivate</button>
                                <button id="btn_nolesson" class="btn btn-danger col-lg-5 col-5">No Lesson</button>
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
                                <!-- <form action="#" method="POST"> -->
                                <!-- <h5 class="col-lg-12">Apakah sudah berjalan lesson pada tanggal ini?</h5> -->
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="jenis" id="jenis_active" aria-describedby="jenis_form">
                                    <input type="hidden" class="form-control" name="date" id="date_active" aria-describedby="date_form">
                                    <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_active" aria-describedby="date_form">
                                </div>
                                <div class="row text-center ml-2 mr-2">
                                    <button id="btn_active" class="btn btn-success btn-block col-lg-12">Done</button>
                                    <button id="btn_reschedule" class="btn btn-warning btn-block col-lg-12">Reschedule</button>
                                </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendarModalCancel" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Reschedule Attendance</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body text-center">
                                <h5 class="col-lg-12">Please input date to change the schedule </h5>
                                <input type="date" class="form-control" name="date_reschedule" id="date_reschedule" value="" aria-describedby="date_form">
                                <br>
                                <button id="btn_cancel_attendance" class="btn btn-warning text-white col-lg-5 col-5">Submit</button>
                            </div>
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
<script>
    $(document).ready(function() {
        cekPackage();
    });

    function cekPackage(today) {
        $.ajax({
            url: "<?= base_url() ?>portal/C_Admin/cek_package/<?= $pack_online[0]['id_list_pack'] ?>",
            type: "POST",
            data: {
                // 'status': '2',
                'today': '<?= date("Y-m-d") ?>'
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                // $("#counter_pack").html(data);
            }
        });
    }
    var calendar = $('#calendar').fullCalendar({
        height: 650,
        firstDay: 1,
        dayMaxEvents: 1,
        events: "<?= site_url() ?>portal/C_Admin/load_package/<?= $pack_online[0]['id_list_pack'] ?>",
        dayRender: function(date, jsEvent, view) {
            tahun = <?= substr($pack_online[0]['created_at'], 0, 4) ?>;
            bulan = parseInt(<?= substr($pack_online[0]['created_at'], 5, 2) ?>) - 1;
            tanggal = <?= substr($pack_online[0]['created_at'], 8, 2) ?>;
            var myDate = new Date(tahun, bulan, tanggal);

            tahunEx = <?= substr($pack_online[0]['end_at'], 0, 4) ?>;
            bulanEx = parseInt(<?= substr($pack_online[0]['end_at'], 5, 2) ?>) - 1;
            tanggalEx = <?= substr($pack_online[0]['end_at'], 8, 2) ?>;
            var exDate = new Date(tahunEx, bulanEx, tanggalEx);
            exDate.setDate(exDate.getDate() + 1);
            // console.log(myDate);
            // console.log(exDate);
            var monthsToAdd = 3;
            var addDate = new Date();
            addDate.setMonth(myDate.getMonth() + monthsToAdd);
            addDate.setDate(addDate.getDate() - 1);
            var dateString = date.format("YYYY-MM-DD");
            var today = new Date();
            if (date >= myDate && date < exDate && today < date) {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                    "background-color": "#FFFFFF",
                    "cursor": "pointer"
                });
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('cursor', 'ponter');
            } else {
                $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css('background-color', '#f1f6f9');
            }
            // $(view.el[0]).find('.fc-sun[data-date=' + dateString + ']').css('background-color', '#ff7171');
        },
        eventRender: function(event, element, view) {
            var dateString = event.start.format("YYYY-MM-DD");

            if (event.jenis == 1) {
                if (event.status == 1 || event.status == 3 || event.status == 5 || event.status == 7) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#f0a500",
                        "color": "white",
                    });
                }
                if (event.status == 2 || event.status == 4) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#fddb3a",
                        "color": "white",
                    });
                }
                $(view.el[0]).find('.fc-day-top[data-date=' + dateString + ']').css({
                    "color": "white"
                });
            }
            if (event.jenis == 2) {
                if (event.status == 1 || event.status == 3 || event.status == 5 || event.status == 7) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#056676",
                        "color": "white",
                    });
                }
                if (event.status == 2 || event.status == 4) {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#5eaaa8",
                        "color": "white",
                    });
                }
                $(view.el[0]).find('.fc-day-top[data-date=' + dateString + ']').css({
                    "color": "white"
                });
            }
        },
        dayClick: function(date, jsEvent, view) {

            tahun = <?= substr($pack_online[0]['created_at'], 0, 4) ?>;
            bulan = parseInt(<?= substr($pack_online[0]['created_at'], 5, 2) ?>) - 1;
            tanggal = <?= substr($pack_online[0]['created_at'], 8, 2) ?>;
            var myDate = new Date(tahun, bulan, tanggal);

            tahunEx = <?= substr($pack_online[0]['end_at'], 0, 4) ?>;
            bulanEx = parseInt(<?= substr($pack_online[0]['end_at'], 5, 2) ?>) - 1;
            tanggalEx = <?= substr($pack_online[0]['end_at'], 8, 2) ?>;
            var exDate = new Date(tahunEx, bulanEx, tanggalEx);
            exDate.setDate(exDate.getDate() + 1);
            //How many days to add from today?
            var monthsToAdd = 3;

            var addDate = new Date();
            addDate.setMonth(myDate.getMonth() + monthsToAdd);
            addDate.setDate(addDate.getDate() - 1);
            // console.log(date);
            // console.log(myDate);
            // console.log(addDate);
            var today = new Date();
            let prac_meet = document.getElementById("total_practical_meet").innerHTML;
            let theory_meet = document.getElementById("total_theory_meet").innerHTML;

            prac_meet.replace(/\D/g, "") > 0 ? console.log(prac_meet.replace(/\D/g, "")) : null;
            theory_meet.replace(/\D/g, "") > 0 ? console.log(theory_meet.replace(/\D/g, "")) : null;

            if (prac_meet.replace(/\D/g, "") > 0 || theory_meet.replace(/\D/g, "") > 0) {
                $('#modalTitle').html(date.format("MMM, DD Y"));
                document.getElementById("date").value = date.format();
                $('#calendarModalAdd').modal();
            } else {
                alert("Package Completed!");
            }
            if (date >= myDate && date < exDate && today < date) {
                //TRUE Clicked date smaller than today + daysToadd
            } else {
                //FLASE Clicked date larger than today + daysToadd
                // alert("Sudah habis paket tanggal");
            }
        },
        eventClick: function(event, jsEvent, view) {
            var jenis = '';
            var form_select = '';
            if (event.status == 1) {
                if (event.jenis == 1) {
                    jenis = 'Pratical';
                    form_select = `<option value="` + event.jenis + `">` + jenis + `</option><?php if (count($count_theory) != $pack_online[0]['total_pack_theory']) : ?><option value="2">Theory</option><?php endif; ?>`;
                }
                if (event.jenis == 2) {
                    jenis = 'Theory';
                    form_select = `<option value="` + event.jenis + `">` + jenis + `</option><?php if (count($count_pratical) != $pack_online[0]['total_pack_practical']) : ?><option value="1">Pratical</option><?php endif; ?>`;
                }
                $("#jenis_select_update").html(form_select);
                var date_event = event.date;
                document.getElementById("status_update").value = event.status;
                document.getElementById("jenis_update").value = event.jenis;
                document.getElementById("date_update").value = date_event.slice(0, 10);
                document.getElementById("id_schedule_online_update").value = event.id;
                $('#calendarModalUpdate').modal();
            }
            if (event.status == 2) {
                alert('Attendance was done');
                console.log('halo 2');
            }
            if (event.status == 4) {
                alert('Attendance was done');
                console.log('halo 4');
            }

            if (event.status == 3) {
                alert('Attendance was cancel');
                console.log('halo 3');
            }
            if (event.status == 5 || event.status == 7) {
                var date_event = event.date;
                document.getElementById("jenis_active").value = event.jenis;
                document.getElementById("date_active").value = date_event.slice(0, 10);
                document.getElementById("id_schedule_online_active").value = event.id;
                if (event.status == 5) {
                    $('#calendarModalOption').modal();
                } else {
                    $('#calendarModalActive').modal();
                }
            }
        },
    });
    $('#btn_insert').click(function() {
        var jenis = $("#jenis_select").val();
        if (jenis != null) {
            insertData();
        } else {
            alert('Sudah Tidak Ada Packet');
        }
        document.getElementById("date").value = "";
        $('#calendarModalAdd').modal('hide');
    });

    $('#btn_update').click(function() {
        updateData();
        document.getElementById("date_update").value = "";
        document.getElementById("id_schedule_online_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    $('#btn_delete').click(function() {
        deleteData();
        document.getElementById("date_update").value = "";
        document.getElementById("id_schedule_online_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    $('#btn_reactivate').click(function() {
        $('#calendarModalOption').modal('hide');
        $('#calendarModalActive').modal();
    });

    $('#btn_nolesson').click(function() {
        <?php $feereport_temp = [] ?>

        var jenis = $("#jenis_active").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        <?php $feereport_temp = $feereport_pratical ?>
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
            <?php $feereport_temp = $feereport_theory ?>
        }

        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var tgl = $("#date_update").val();

        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

        var arrayTempNoSirkulasi = [];
        <?php foreach ($feereport_temp as $f) : ?>
            arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
        <?php endforeach ?>

        <?php if (count($feereport_temp) > 0) : ?>
            if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                <?php foreach ($feereport_temp as $f) : ?>
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

    $('#btn_active').click(function() {
        <?php $feereport_temp = [] ?>

        var jenis = $("#jenis_active").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        <?php $feereport_temp = $feereport_pratical ?>
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
            <?php $feereport_temp = $feereport_theory ?>
        }
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var tgl = $("#date_active").val();

        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

        var arrayTempNoSirkulasi = [];
        <?php foreach ($feereport_temp as $f) : ?>
            arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
        <?php endforeach ?>

        <?php if (count($feereport_temp) > 0) : ?>
            if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                <?php foreach ($feereport_temp as $f) : ?>
                    if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                        if ('<?= $f['status_approved'] ?>' === '1') {
                            alert("Can't add, fee report has been approved!");
                        } else {
                            activeData();
                            document.getElementById("jenis_active").value = "";
                            document.getElementById("date_active").value = "";
                            document.getElementById("id_schedule_online_active").value = "";
                            $('#calendarModalActive').modal('hide');
                        }
                    }
                <?php endforeach ?>
            } else {
                activeData();
                document.getElementById("jenis_active").value = "";
                document.getElementById("date_active").value = "";
                document.getElementById("id_schedule_online_active").value = "";
                $('#calendarModalActive').modal('hide');
            }
        <?php else : ?>
            activeData();
            document.getElementById("jenis_active").value = "";
            document.getElementById("date_active").value = "";
            document.getElementById("id_schedule_online_active").value = "";
            $('#calendarModalActive').modal('hide');
        <?php endif ?>
    });
    $('#btn_reschedule').click(function() {
        $('#calendarModalActive').modal('hide');
        $('#calendarModalCancel').modal('show');
    });

    $('#btn_cancel_attendance').click(function() {
        var date_reschedule = $("#date_reschedule").val();
        if (date_reschedule !== "") {
            <?php $feereport_temp = [] ?>

            var jenis = $("#jenis_active").val();
            var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
            <?php $feereport_temp = $feereport_pratical ?>

            if (jenis == 2) {
                id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
                <?php $feereport_temp = $feereport_theory ?>
            }

            var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
            var tgl = $("#date_active").val();

            var datetemp = tgl.substr(0, 7).replace("-", "");
            var idtemp = id_teacher.substr(3);
            var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";

            var arrayTempNoSirkulasi = [];
            <?php foreach ($feereport_temp as $f) : ?>
                arrayTempNoSirkulasi.push('<?= $f['no_sirkulasi_feereport'] ?>')
            <?php endforeach ?>

            <?php if (count($feereport_temp) > 0) : ?>
                if (arrayTempNoSirkulasi.includes(no_sirkulasi) === true) {
                    <?php foreach ($feereport_temp as $f) : ?>
                        if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                            if ('<?= $f['status_approved'] ?>' === '1') {
                                alert("Can't add, fee report has been approved!");
                            } else {
                                cancelAttendance();
                                rescheduleAttendance();
                                document.getElementById("jenis_active").value = "";
                                document.getElementById("date_active").value = "";
                                document.getElementById("id_schedule_online_active").value = "";
                                $('#calendarModalCancel').modal('hide');
                            }
                        }
                    <?php endforeach ?>
                } else {
                    cancelAttendance();
                    rescheduleAttendance();
                    document.getElementById("jenis_active").value = "";
                    document.getElementById("date_active").value = "";
                    document.getElementById("id_schedule_online_active").value = "";
                    $('#calendarModalCancel').modal('hide');
                }

            <?php else : ?>
                cancelAttendance();
                rescheduleAttendance();
                document.getElementById("jenis_active").value = "";
                document.getElementById("date_active").value = "";
                document.getElementById("id_schedule_online_active").value = "";
                $('#calendarModalCancel').modal('hide');
            <?php endif ?>
        } else {
            alert("please input date valid!")
        }
    });

    function myFunction(e) {
        var temp_val = e.target.value;
        document.getElementById("jenis").value = temp_val;
    }

    function myFunction2(e) {
        var temp_val = e.target.value;
        document.getElementById("status").value = temp_val;
    }

    function myFunction3(e) {
        var temp_val = e.target.value;
        document.getElementById("jenis_update").value = temp_val;
    }

    function myFunction4(e) {
        var temp_val = e.target.value;
        document.getElementById("status_update").value = temp_val;
    }

    function insertData() {
        var tgl = $("#date").val();
        var jenis = $("#jenis_select").val();
        var status = $("#status").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
        }
        // console.log(jenis);
        // console.log(id_list_pack);
        // console.log(id_student);
        // console.log(status);
        // console.log(tgl);
        $.ajax({
            url: "<?= base_url('portal/C_Admin/insert_schedule_package') ?>",
            type: "POST",
            data: {
                'id_teacher': id_teacher,
                'id_student': id_student,
                'id_list_pack': id_list_pack,
                'tgl': tgl,
                'jenis': jenis,
                'status': status,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
                $("#counter_pack").html(data);
                location.reload();
            }
        });
    }

    function updateData() {
        var tgl = $("#date_update").val();
        var jenis = $("#jenis_select_update").val();
        var status = $("#status_update").val();
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
        }
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        $.ajax({
            url: "<?= base_url('portal/C_Admin/update_schedule_package') ?>",
            type: "POST",
            data: {
                'id_teacher': id_teacher,
                'id_student': id_student,
                'id_list_pack': id_list_pack,
                'tgl': tgl,
                'jenis': jenis,
                'status': status,
                'id_schedule_online': id_schedule_online,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Updated Successfully");
                $("#counter_pack").html(data);
                location.reload();
            }
        });
    }

    function deleteData() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var tgl = $("#date_update").val();
        $.ajax({
            url: "<?= base_url('portal/C_Admin/delete_schedule_package') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_pack': id_list_pack,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Deleted Successfully");
                $("#counter_pack").html(data);
                $('.fc-day[data-date=' + tgl + ']').css('background-color', '#FFFFFF');
                location.reload();
            }
        });
    }

    function cancelLesson() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var jenis = $("#jenis_active").val();

        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_pack': id_list_pack,
                'status': '7',
                'jenis': jenis,
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

    function activeData() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var jenis = $("#jenis_active").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
        }

        var tgl = $("#date_active").val();
        var id_student = "<?= $pack_online[0]['id_student'] ?>";

        var price = "<?= $pack_online[0]['price_idr'] ?>";
        if (<?= $pack_online[0]['status_pack_practical'] ?> === 1 && <?= $pack_online[0]['status_pack_theory'] ?> === 1) {
            price = price - 100000;
        }
        if (jenis === 2) {
            price = 100000;
        }
        var paket = "<?= $pack_online[0]['paket'] ?>";

        var teacher_percentage = "<?= $pack_online[0]['teacher_percentage'] ?>";

        var rate_dollar = "<?= $pack_online[0]['rate_dollar'] ?>";
        if (rate_dollar === '3') {
            price = "<?= $pack_online[0]['price_euro'] ?>";
        }
        if (rate_dollar === '2') {
            price = "<?= $pack_online[0]['price_dollar'] ?>";
        }

        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package') ?>",
            type: "POST",
            data: {
                'jenis': jenis,
                'status': '2',
                'id_schedule_online': id_schedule_online,
                'id_list_pack': id_list_pack,
                'id_teacher': id_teacher,
                'id_student': id_student,
                'tgl': tgl,
                'price': price,
                'paket': paket,
                'teacher_percentage': teacher_percentage,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                location.reload();
                alert("Updated Successfully");
            }
        });
    }

    function cancelAttendance() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var tgl = $("#date_active").val();
        var jenis = $("#jenis_active").val();
        // console.log("cancel " + jenis)
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/update_schedule_package') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_pack': id_list_pack,
                'status': '3',
                'jenis': jenis,
            },
            success: function(data) {
                // calendar.fullCalendar('refetchEvents');
                // alert("Updated Successfully");
                // location.reload();
            }
        });
    }

    function rescheduleAttendance() {
        var id_schedule_online = $("#id_schedule_online_active").val();
        var id_list_pack = "<?= $pack_online[0]['id_list_pack'] ?>";
        var jenis = $("#jenis_active").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher_practical'] ?>";
        if (jenis == 2) {
            id_teacher = "<?= $pack_online[0]['id_teacher_theory'] ?>";
        }

        var tgl = $("#date_active").val();
        var id_student = "<?= $pack_online[0]['id_student'] ?>";

        var price = "<?= $pack_online[0]['price_idr'] ?>";
        if (<?= $pack_online[0]['status_pack_practical'] ?> === 1 && <?= $pack_online[0]['status_pack_theory'] ?> === 1) {
            price = price - 100000;
        }
        if (jenis === 2) {
            price = 100000;
        }
        var paket = "<?= $pack_online[0]['paket'] ?>";

        var teacher_percentage = "<?= $pack_online[0]['teacher_percentage'] ?>";

        var rate_dollar = "<?= $pack_online[0]['rate_dollar'] ?>";
        if (rate_dollar === '3') {
            price = "<?= $pack_online[0]['price_euro'] ?>";
        }
        if (rate_dollar === '2') {
            price = "<?= $pack_online[0]['price_dollar'] ?>";
        }

        var date_update_cancel = $("#date_reschedule").val();

        // console.log("reschedule " + jenis)
        $.ajax({
            url: "<?= base_url('portal/C_Teacher/reschedule_package') ?>",
            type: "POST",
            data: {
                'id_schedule_pack': id_schedule_online,
                'date_update_cancel': date_update_cancel,
                'jenis': jenis,
                'id_teacher': id_teacher,
                'id_student': id_student,
                'price': price,
                'paket': paket,
                'id_list_pack': id_list_pack,
                'teacher_percentage': teacher_percentage,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                location.reload();
                alert("Updated Successfully");
            }
        });
    }
</script>