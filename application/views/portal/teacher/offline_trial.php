<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Offline Trial</h2>
        <hr>
        <div class="row pt-lg-5 pt-4">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12">
                <div id="calendar">
                </div>
                <div id="calendarModalAdd" class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="modalTitle" class="modal-title"></h5>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <!-- <form id="formAdd"> -->
                                <div class="form-group">
                                    <label for="name_student">Student Name</label>
                                    <input type="text" class="form-control" name="name_student" id="name_student" required aria-describedby="name_student_form">
                                    <input type="hidden" class="form-control" name="date" id="date" aria-describedby="date_form">
                                    <input type="hidden" class="form-control" name="id_teacher" id="id_teacher" aria-describedby="id_teacher_form">
                                </div>
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
                                <h5 id="modalTitle" class="modal-title">
                                    Edit Student Name
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <!-- <form action="#" method="POST"> -->
                                <div class="form-group">
                                    <label for="name_student">Student Name</label>
                                    <input type="text" class="form-control" name="name_student" id="name_student_update" required aria-describedby="name_student_form">
                                    <input type="hidden" class="form-control" name="date" id="date_update" aria-describedby="date_form">
                                    <input type="hidden" class="form-control" name="id_offline_trial" id="id_offline_trial_update" aria-describedby="id_offline_trial_form">
                                    <input type="hidden" class="form-control" name="id_teacher" id="id_teacher_update" aria-describedby="id_teacher_form">
                                </div>
                                <button id="btn_update" class="btn btn-info btn-block">Edit Student Name</button>
                                <button id="btn_delete" class="btn btn-danger btn-block">Delete</button>
                                <!-- </form> -->
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
    var calendar = $('#calendar').fullCalendar({
        editable: true,

        height: 650,
        firstDay: 1,
        events: "<?= site_url() ?>portal/C_Teacher/load_offline_trial/<?= $this->session->userdata('id') ?>",
        dayClick: function(date, jsEvent, view) {
            $('#modalTitle').html(date.format("MMM, DD Y"));
            document.getElementById("date").value = date.format();
            document.getElementById("id_teacher").value = '<?= $this->session->userdata('id') ?>';

            var id_teacher = '<?= $this->session->userdata('id') ?>';
            var tgl = date.format();

            console.log(tgl)
            var datetemp = tgl.substr(0, 7).replace("-", "");
            var idtemp = id_teacher.substr(3);
            var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";
            console.log(no_sirkulasi)
            <?php if (count($feereport) > 0) : ?>
                <?php foreach ($feereport as $f) : ?>
                    if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                        if ('<?= $f['status_approved'] ?>' === '1') {
                            alert("Can't update, fee report has been approved!");
                        } else {
                            $('#calendarModalAdd').modal();
                        }
                    }
                <?php endforeach ?>
            <?php else : ?>
                $('#calendarModalAdd').modal();
            <?php endif ?>
        },
        eventClick: function(event, jsEvent, view) {
            document.getElementById("name_student_update").value = event.title;
            document.getElementById("date_update").value = event.date;
            document.getElementById("id_teacher_update").value = '<?= $this->session->userdata('id') ?>';
            document.getElementById("id_offline_trial_update").value = event.id;

            var id_teacher = '<?= $this->session->userdata('id') ?>';
            var tgl = event.date;

            console.log(tgl)
            var datetemp = tgl.substr(0, 7).replace("-", "");
            var idtemp = id_teacher.substr(3);
            var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";
            console.log(no_sirkulasi)
            <?php if (count($feereport) > 0) : ?>
                <?php foreach ($feereport as $f) : ?>
                    if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                        if ('<?= $f['status_approved'] ?>' === '1') {
                            alert("Can't update, fee report has been approved!");
                        } else {
                            $('#calendarModalUpdate').modal();
                        }
                    }
                <?php endforeach ?>
            <?php else : ?>
                $('#calendarModalUpdate').modal();
            <?php endif ?>

        },
    });
    $('#btn_insert').click(function() {
        insertData();
        document.getElementById("name_student").value = "";
        document.getElementById("id_teacher").value = "";
        document.getElementById("date").value = "";
        $('#calendarModalAdd').modal('hide');
    });

    $('#btn_update').click(function() {
        updateData();
        document.getElementById("id_offline_trial_update").value = "";
        document.getElementById("name_student_update").value = "";
        document.getElementById("id_teacher_update").value = "";
        document.getElementById("date_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    $('#btn_delete').click(function() {
        deleteData();
        document.getElementById("id_offline_trial_update").value = "";
        document.getElementById("name_student_update").value = "";
        document.getElementById("id_teacher_update").value = "";
        document.getElementById("date_update").value = "";
        $('#calendarModalUpdate').modal('hide');
    });

    function insertData() {
        var name_student = $("#name_student").val();
        var id_teacher = $("#id_teacher").val();
        var tgl = $("#date").val();

        console.log(tgl)
        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";
        console.log(no_sirkulasi)
        <?php if (count($feereport) > 0) : ?>
            <?php foreach ($feereport as $f) : ?>
                if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                    if ('<?= $f['status_approved'] ?>' === '1') {
                        alert("Can't add, fee report has been approved!");
                    } else {
                        $.ajax({
                            url: "<?= base_url('portal/C_Teacher/insert_offline_trial') ?>",
                            type: "POST",
                            data: {
                                "name_student": name_student,
                                'id_teacher': id_teacher,
                                'tgl': tgl
                            },
                            success: function(data) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        });
                    }
                }
            <?php endforeach ?>
        <?php else : ?>
            $.ajax({
                url: "<?= base_url('portal/C_Teacher/insert_offline_trial') ?>",
                type: "POST",
                data: {
                    "name_student": name_student,
                    'id_teacher': id_teacher,
                    'tgl': tgl
                },
                success: function(data) {
                    calendar.fullCalendar('refetchEvents');
                    alert("Added Successfully");
                }
            });
        <?php endif ?>


    }

    function updateData() {
        var name_student = $("#name_student_update").val();
        var id_teacher = $("#id_teacher_update").val();
        var tgl = $("#date_update").val();
        var id_offline_trial = $("#id_offline_trial_update").val();

        console.log(tgl)
        var datetemp = tgl.substr(0, 7).replace("-", "");
        var idtemp = id_teacher.substr(3);
        var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";
        console.log(no_sirkulasi)
        <?php if (count($feereport) > 0) : ?>
            <?php foreach ($feereport as $f) : ?>
                if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                    if ('<?= $f['status_approved'] ?>' === '1') {
                        alert("Can't update, fee report has been approved!");
                    } else {
                        $.ajax({
                            url: "<?= base_url('portal/C_Teacher/update_offline_trial') ?>",
                            type: "POST",
                            data: {
                                "name_student": name_student,
                                'id_teacher': id_teacher,
                                'id_offline_trial': id_offline_trial,
                                'tgl': tgl
                            },
                            success: function(data) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Updated Successfully");
                            }
                        });
                    }
                }
            <?php endforeach ?>
        <?php else : ?>
            $.ajax({
                url: "<?= base_url('portal/C_Teacher/update_offline_trial') ?>",
                type: "POST",
                data: {
                    "name_student": name_student,
                    'id_teacher': id_teacher,
                    'id_offline_trial': id_offline_trial,
                    'tgl': tgl
                },
                success: function(data) {
                    calendar.fullCalendar('refetchEvents');
                    alert("Updated Successfully");
                }
            });
        <?php endif ?>
    }

    function deleteData() {
        var id_offline_trial = $("#id_offline_trial_update").val();
        var id_teacher = $("#id_teacher_update").val();
        var tgl = $("#date_update").val();

        $.ajax({
            url: "<?= base_url('portal/C_Teacher/delete_offline_trial') ?>",
            type: "POST",
            data: {
                'id_offline_trial': id_offline_trial,
                'id_teacher': id_teacher,
                'tgl': tgl
            },
            success: function(data) {
                calendar.fullCalendar('refetchEvents');
                alert("Deleted Successfully");
            }
        });
    }
    $(document).ready(function() {});
</script>