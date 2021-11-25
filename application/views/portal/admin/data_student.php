<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Data Student</h2>
        <hr>
        <div class="row">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 text-right ">
                <a href="<?= site_url() ?>portal/C_Admin/add_new_student" class="btn btn-primary mr-3">
                    <i class="fa fa-plus mr-2"></i>
                    Add Data
                </a>
                <!-- <button class="btn btn-primary mr-3" data-toggle="modal" data-target="#staticBackdrop">
                    <i class="fa fa-plus mr-2"></i>
                    Add Data
                </button> -->
            </div>
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Choose</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <a href="<?= site_url() ?>portal/data_student/add/parent" class="btn btn-primary mr-3">
                                Add Parent
                            </a>
                            <a href="<?= site_url() ?>portal/data_student/add/student" class="btn btn-primary mr-3">
                                Add Student
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Student</th>
                                <th>Student Name</th>
                                <th>Instrument</th>
                                <th>Detail</th>
                                <!-- <th>ID Parent</th> -->
                                <!-- <th>Parent</th> -->
                                <!-- <th>Address</th> -->
                                <!-- <th>HP1</th> -->
                                <!-- <th>HP2</th> -->
                                <!-- <th>School</th> -->
                                <!-- <th>Action</th> -->
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
                "url": "<?= site_url('portal/C_Admin/get_ajax_student') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                'targets': [0, 3, 4], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 4,
                "className": "text-center",
            },],
            // 'dom': 'Bfrtip',
            // 'buttons': [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            "order": [
                [1, 'asc']
            ],
        });
    });
</script>