<style>
    #tataletak {
        font-size: 17px;
    }

    @media (max-width: 990px) {
        #tataletak {
            font-size: 14px;
        }
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <h2>Attendance Summary</h2>
        <hr>
        <div class="row pt-4">
            <div id="tataletak" class="col-lg-12 border p-3" style="">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <span class="mr-4" style="color:#DE7CD9">
                            <i class="fa fa-square"></i>
                            Offline Lesson
                        </span>
                    </div>
                    <div class="col-lg-3 col-6">
                        <span class="mr-4" style="color:#ffd32a">
                            <i class="fa fa-square"></i>
                            Offline Trial
                        </span>
                    </div>
                    <div class="col-lg-3 col-6">
                        <span class="mr-4" style="color:#67E543">
                            <i class="fa fa-square"></i>
                            Online Lesson
                        </span>
                    </div>
                    <div class="col-lg-3 col-6">
                        <span class="mr-4" style="color:#0676BD">
                            <i class="fa fa-square"></i>
                            Theory Lesson
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-lg-5 pt-4">
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
        editable: false,

        height: 650,
        firstDay: 1,
        events: "<?= site_url() ?>portal/C_Teacher/load_summary/<?= $this->session->userdata('id') ?>",
        // eventColor: '#378006'
    });
</script>