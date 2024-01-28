<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Data Client</h2>
        <hr>
        <div class="row">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 pb-3">
                <span class="mr-1 pb-2" style="border-bottom:2px solid #62A8D6">
                    Data Person in Charge
                </span>
                |
                <a href="<?= site_url() ?>portal/data_student" class="btn ml-1 mr-1 pl-4 pr-4" style="background-color:#f1f3f8; font-size:12px">
                    Data Student
                </a>
            </div>
            <div class="col-lg-12 text-right ">
                <a href="<?= site_url() ?>portal/data_parent/add" class="btn btn-primary mr-3">
                    <i class="fa fa-plus mr-2"></i>
                    Add Data
                </a>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Person in Charge</th>
                                <th>Person in Charge Name</th>
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
            // "responsive": true,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Admin/get_ajax_parent') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                'targets': [0, 1, 2], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 2,
                "className": "text-center",
            }, ],
            "order": [
                [1, 'asc']
            ],
        });
    });
</script>