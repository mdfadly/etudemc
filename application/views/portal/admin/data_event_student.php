<style>
    .btn-add-order {
        background-color: #263850;
        color: white;
        font-size: 12px;
    }

    .btn-add-order:hover {
        background-color: #0676BD;
        color: white;
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Data Event</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-12 pt-3">
                <a href="<?= site_url() ?>portal/event" class="btn ml-1 mr-1 pl-4 pr-4" style="background-color:#f1f3f8; font-size:12px">
                    Event List
                </a>
                |
                <a href="<?= site_url() ?>portal/event/teacher" class="btn ml-1 pl-4 pr-4" style="background-color:#f1f3f8; font-size:12px">
                    Teacher Event
                </a>
                |
                <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Student Event
                </span>

            </div>
            <div class="col-lg-12 text-lg-right pt-lg-1 pt-3">
                <a href="<?= site_url() ?>portal/event/student/add" class="btn btn-primary mr-3">
                    Register
                </a>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mt-3">
                    <table id="example" cellpadding="0" cellspacing="0" class="table table-striped table-white" style="width:100%">
                        <thead>
                            <tr>
                                <th>Registration Date</th>
                                <th>Student Name</th>
                                <th>Event Name</th>
                                <!-- <th>Event Date</th> -->
                                <!-- <th>Event Price</th> -->
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Admin/get_ajax_event_student') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                'targets': [3], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 3,
                "className": "text-center",
            },],
            "order": [2, 'asc']
        });
    });
</script>