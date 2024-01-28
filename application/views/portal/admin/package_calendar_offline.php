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
        height: 4em;
        cursor: pointer;
    }

    .hiden {
        display: none;
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
                <a href="<?= site_url() ?>portal/data_offline_lesson" class="btn btn-primary mr-3">
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
        <div class="row">
            <div class="col-lg-12">
                <?php $date_created = date_create($pack_online[0]['created_at']); ?>
                <?php $date_end = date_create($pack_online[0]['end_at']); ?>
                <div class="card callout callout-primary pt-4 pl-4">
                    <div class="card pt-2 pl-3 pb-2 bg-warning text-white">
                        Limit of Package : <br>
                        <?= date_format($date_created, "j F Y"); ?> - <?= date_format($date_end, "j F Y"); ?>
                    </div>
                    <p class="pt-2" id="counter_pack">
                        Lesson Package : <span class="badge badge-primary"> <?= intval($pack_online[0]['total_package']) - intval(count($count_package_pick)) ?> package (<?= intval($pack_online[0]['total_package']) - intval(count($count_package_pick)) ?> meeting)</span>

                        <span id="total_package" class="badge badge-primary" style="display:none"> <?= intval($pack_online[0]['total_package']) - intval(count($count_package_pick)) ?> lesson</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-12 border p-3" style="font-size:17px;">
                <span class="mr-4" style="color:#EB1AE0">
                    <i class="fa fa-square"></i>
                    Meeting
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
                            <div id="modalBody" class="modal-body">
                                <div class="form-group">
                                    <input type="text" readonly class="form-control" name="date" id="date" aria-describedby="date_form">
                                </div>
                                <input type="hidden" class="form-control" name="status" value="1" id="status" aria-describedby="status_form">
                                <button id="btn_insert" class="btn btn-primary btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendarModalUpdate" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Delete Attendance</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <input type="hidden" class="form-control" name="id_schedule_online" id="id_schedule_online_update" aria-describedby="date_form">
                                <div class="form-group">
                                    <input type="date" readonly class="form-control" name="date" id="date_update" aria-describedby="date_form">
                                </div>
                                <button id="btn_delete" class="btn btn-danger btn-block">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="calendarModalLateUpdate" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h4>Update Attendance</h4> -->
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <input type="text" class="form-control" name="id_schedule_online" id="id_schedule_online_reactive" aria-describedby="date_form">
                                <input type="text" class="form-control" name="date" id="date_reactive" aria-describedby="date_form">
                                <button id="btn_done" class="btn btn-info  col-lg-5 col-5">Done</button>
                                <button id="btn_nolesson" class="btn btn-danger col-lg-5 col-5">No Lesson</button>
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
            url: "<?= base_url() ?>portal/C_Admin/cek_package_offline/<?= $pack_online[0]['id_list_package_offline'] ?>",
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
        events: "<?= site_url() ?>portal/C_Admin/load_package_offline/<?= $pack_online[0]['id_list_package_offline'] ?>",
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
            }
            if (event.status == 3) {
                if (event.title.substr(0, 2) != "Re") {
                    $(view.el[0]).find('.fc-day[data-date=' + dateString + ']').css({
                        "background-color": "#ff4b5c",
                        "color": "white",
                    });
                }
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

            let package_meet = document.getElementById("total_package").innerHTML;
            package_meet.replace(/\D/g, "") > 0 ? console.log(package_meet.replace(/\D/g, "")) : null;

            if (package_meet.replace(/\D/g, "") > 0) {
                document.getElementById("date").value = date.format();
                $('#calendarModalAdd').modal();
            } else {
                alert("Package Completed!");
            }
        },
        eventClick: function(event, jsEvent, view) {
            var date_event = event.date;
            if (event.status == 1) {
                // document.getElementById("status_update").value = event.status;
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

            if (event.status == 5) {
                document.getElementById("date_reactive").value = date_event.slice(0, 10);
                document.getElementById("id_schedule_online_reactive").value = event.id;
                $('#calendarModalLateUpdate').modal();
            }
        }
    });

    $('#btn_insert').click(function() {
        insertData();
        document.getElementById("date").value = "";
        $('#calendarModalAdd').modal('hide');
    });

    function insertData() {
        var tgl = $("#date").val();
        var status = $("#status").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher'] ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";

        // console.log(id_list_package_offline);
        // console.log(id_student);
        // console.log(status);
        // console.log(tgl);
        $.ajax({
            url: "<?= base_url('portal/C_Admin/insert_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_teacher': id_teacher,
                'id_student': id_student,
                'id_list_package_offline': id_list_package_offline,
                'tgl': tgl,
                'status': status,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
                $("#counter_pack").html(data);
                // location.reload();
            }
        });
    }

    $('#btn_done').click(function() {
        updateData(1);
        document.getElementById("date_update").value = "";
        document.getElementById("id_schedule_online_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    function updateData(status) {
        var tgl = $("#date_update").val();
        // var status = $("#status_update").val();
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_teacher = "<?= $pack_online[0]['id_teacher'] ?>";
        var id_student = "<?= $pack_online[0]['id_student'] ?>";
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var is_new = "<?= $pack_online[0]['is_new'] ?>";

        $.ajax({
            url: "<?= base_url('portal/C_Admin/update_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_teacher': id_teacher,
                'id_student': id_student,
                'id_list_package_offline': id_list_package_offline,
                'tgl': tgl,
                'status': status,
                'id_schedule_online': id_schedule_online,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Updated Successfully");
                $("#counter_pack").html(data);
                // location.reload();
            }
        });
    }

    function updateStatusSelect(e) {
        var temp_val = e.target.value;
        document.getElementById("status_update").value = temp_val;
    }

    $('#btn_delete').click(function() {
        deleteData();
        document.getElementById("date_update").value = "";
        document.getElementById("id_schedule_online_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    function deleteData() {
        var id_schedule_online = $("#id_schedule_online_update").val();
        var id_list_package_offline = "<?= $pack_online[0]['id_list_package_offline'] ?>";
        var tgl = $("#date_update").val();
        $.ajax({
            url: "<?= base_url('portal/C_Admin/delete_schedule_package_offline') ?>",
            type: "POST",
            data: {
                'id_schedule_online': id_schedule_online,
                'id_list_package_offline': id_list_package_offline,
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Deleted Successfully");
                $("#counter_pack").html(data);
                $('.fc-day[data-date=' + tgl + ']').css('background-color', '#FFFFFF');
                // location.reload();
            }
        });
    }
</script>