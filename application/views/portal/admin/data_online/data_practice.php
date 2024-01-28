<style>
    .btn-add-data {
        background-color: #263850;
        color: white;
        font-size: 12px;
    }

    .btn-add-data:hover {
        background-color: #0676BD;
        color: white;
    }

    .btn-active {
        border-bottom: 2px solid #62A8D6;
        background-color: white;
        font-size: 0.9rem;
        cursor: text;
    }

    .btn-light {
        font-size: 12px
    }
</style>
<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <h2 style="font-weight:bold">Data Online Lesson</h2>
        <hr>
        <div class="row">

            <div class="col-lg-12 pt-3">
                <a href="<?= site_url() ?>portal/data_online_lesson" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Data All
                </a>
                |
                <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Data Practice
                </span>
                |
                <a href="<?= site_url() ?>portal/C_Admin/data_online_pratical_theory" class="btn ml-1 mr-1 pl-4 pr-4 btn-light">
                    Data Theory
                </a>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display " style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Student</th>
                                <th>Student Name</th>
                                <th>Pick The Date</th>
                                <th>Purchase Date</th>
                                <th>Expired Date</th>
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
                "url": "<?= site_url('portal/C_Admin/get_ajax_online_lesson_practice') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                    'targets': [0, 2, 3, 4, 5], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                },
                {
                    width: '17%',
                    targets: 0
                },
                {
                    width: '25%',
                    targets: 1
                },
                {
                    width: '17%',
                    targets: 2,
                    "className": "text-center",
                },
                {
                    width: '17%',
                    targets: 3
                },
                {
                    width: '17%',
                    targets: 4
                },
                {
                    width: '17%',
                    targets: 5,
                    "className": "text-center",
                },
            ],
            "order": []
        });
    });
</script>