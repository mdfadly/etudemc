<main class="page-content">
    <div class="container-fluid">
        <h2>Attendance Theory Lesson </h2>
        <h5>
            (<?= $online_theory[0]['name_student'] ?>)
        </h5>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-12">
                <a href="<?= site_url() ?>portal/online_theory" class="btn btn-primary mr-3">
                    <i class="fa fa-arrow-left mr-2"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-lg-12">
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
        editable: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        height: 650,
        firstDay: 1,
        events: "<?= site_url() ?>portal/C_Teacher/load_schedule_theory/<?= $online_theory[0]['id_online_theory'] ?>",
        dayClick: function(date, jsEvent, view) {
            if (confirm("Are you sure you want to add it?")) {
                var id_teacher = "<?= $online_theory[0]['id_teacher'] ?>";
                var id_student = "<?= $online_theory[0]['id_student'] ?>";
                var id_online_theory = "<?= $online_theory[0]['id_online_theory'] ?>";
                var instrument = "<?= $online_theory[0]['instrument'] ?>";
                var tgl = date.format();
                var fee = "<?= $online_theory[0]['rate'] ?>";

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
                                    url: "<?= base_url('portal/C_Teacher/insert_schedule_theory') ?>",
                                    type: "POST",
                                    data: {
                                        id_teacher: id_teacher,
                                        id_student: id_student,
                                        id_course: id_online_theory,
                                        instrument: instrument,
                                        tgl: tgl,
                                        fee: fee,
                                    },
                                    success: function(data) {
                                        calendar.fullCalendar('refetchEvents');
                                        alert("Added Successfully");
                                    }
                                })
                            }
                        }
                    <?php endforeach ?>
                <?php endif ?>


            }
        },
        eventClick: function(event, jsEvent, view) {
            if (confirm("Are you sure you want to delete it?")) {
                var id = event.id;
                var tgl = event.date;
                var id_teacher = "<?= $this->session->userdata('id') ?>";

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
                                    url: "<?= base_url('portal/C_Teacher/delete_schedule_theory') ?>",
                                    type: "POST",
                                    data: {
                                        id_schedule_theory: id,
                                    },
                                    success: function(data) {
                                        calendar.fullCalendar('refetchEvents');
                                        alert("Deleted Successfully");
                                    }
                                })
                            }
                        }
                    <?php endforeach ?>
                <?php endif ?>

            }
        },
    });
</script>