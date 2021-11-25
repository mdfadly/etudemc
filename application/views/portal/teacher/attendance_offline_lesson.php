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
            (<?= $offline_lesson[0]['name_student'] ?>)
        </h5>
        <div class="row pt-5">
            <div class="col-lg-12">
                <div id="calendar">
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
        events: "<?= site_url() ?>portal/C_Teacher/load_schedule/<?= $this->session->userdata('id') ?>/offline_lesson/<?= $offline_lesson[0]['id_student'] ?>",
        dayClick: function(date, jsEvent, view) {
            if (confirm("Are you sure want to add it?")) {
                var id_teacher = "<?= $offline_lesson[0]['id_teacher'] ?>";
                var id_student = "<?= $offline_lesson[0]['id_student'] ?>";
                var nama_course = "offline_lesson";
                var id_offline_lesson = "<?= $offline_lesson[0]['id_offline_lesson'] ?>";
                var instrument = "<?= $offline_lesson[0]['instrument'] ?>";
                var tgl = date.format();
                var fee = "<?= $offline_lesson[0]['rate'] ?>";
                var paket = "<?= $offline_lesson[0]['id_paket'] ?>";
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
                                    url: "<?= base_url('portal/C_Teacher/insert_schedule') ?>",
                                    type: "POST",
                                    data: {
                                        id_teacher: id_teacher,
                                        id_student: id_student,
                                        nama_course: nama_course,
                                        id_course: id_offline_lesson,
                                        instrument: instrument,
                                        tgl: tgl,
                                        fee: fee,
                                        paket: paket,
                                    },
                                    success: function(data) {
                                        calendar.fullCalendar('refetchEvents');
                                        alert("Added Successfully");
                                    }
                                })
                            }
                        } else {
                            $.ajax({
                                url: "<?= base_url('portal/C_Teacher/insert_schedule') ?>",
                                type: "POST",
                                data: {
                                    id_teacher: id_teacher,
                                    id_student: id_student,
                                    nama_course: nama_course,
                                    id_course: id_offline_lesson,
                                    instrument: instrument,
                                    tgl: tgl,
                                    fee: fee,
                                    paket: paket,
                                },
                                success: function(data) {
                                    calendar.fullCalendar('refetchEvents');
                                    alert("Added Successfully");
                                }
                            })
                        }
                    <?php endforeach ?>
                <?php else : ?>
                    $.ajax({
                        url: "<?= base_url('portal/C_Teacher/insert_schedule') ?>",
                        type: "POST",
                        data: {
                            id_teacher: id_teacher,
                            id_student: id_student,
                            nama_course: nama_course,
                            id_course: id_offline_lesson,
                            instrument: instrument,
                            tgl: tgl,
                            fee: fee,
                            paket: paket,
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Added Successfully");
                        }
                    })
                <?php endif ?>
            }
        },
        eventClick: function(event, jsEvent, view) {
            if (confirm("Are you sure want to delete it?")) {
                var id_teacher = "<?= $offline_lesson[0]['id_teacher'] ?>";
                var id_student = "<?= $offline_lesson[0]['id_student'] ?>";
                var id = event.id;
                var tgl = event.date;
                var fee = event.fee;
                var id_course = event.id_course;
                console.log(tgl)
                var datetemp = tgl.substr(0, 7).replace("-", "");
                var idtemp = id_teacher.substr(3);
                var no_sirkulasi = "FER/" + datetemp + "/" + idtemp + "/001";
                console.log(no_sirkulasi)
                <?php if (count($feereport) > 0) : ?>
                    <?php foreach ($feereport as $f) : ?>
                        if (no_sirkulasi === '<?= $f['no_sirkulasi_feereport'] ?>') {
                            if ('<?= $f['status_approved'] ?>' === '1') {
                                alert("Can't delete, fee report has been approved!");
                            } else {
                                $.ajax({
                                    url: "<?= base_url('portal/C_Teacher/delete_schedule') ?>",
                                    type: "POST",
                                    data: {
                                        id_teacher: id_teacher,
                                        id_student: id_student,
                                        id_schedule: id,
                                        tgl: tgl,
                                        fee: fee,
                                        id_course: id_course,
                                    },
                                    success: function(data) {
                                        calendar.fullCalendar('refetchEvents');
                                        alert("Deleted Successfully");
                                    }
                                })
                            }
                        }
                    <?php endforeach ?>
                <?php else : ?>
                    $.ajax({
                        url: "<?= base_url('portal/C_Teacher/delete_schedule') ?>",
                        type: "POST",
                        data: {
                            id_teacher: id_teacher,
                            id_student: id_student,
                            id_schedule: id,
                            tgl: tgl,
                            fee: fee,
                            id_course: id_course,
                        },
                        success: function(data) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Deleted Successfully");
                        }
                    })
                <?php endif ?>
            }
        },
    });
</script>