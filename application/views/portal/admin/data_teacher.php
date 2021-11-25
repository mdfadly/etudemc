<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Data Teacher</h2>
        <hr>
        <div class="row">
            <?php if ($this->session->flashdata('success') != null) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Teacher</th>
                                <th>Teacher Name</th>
                                <th>Instrument</th>
                                <th>Detail</th>
                                <!-- <th>Address</th>
                                <th>HP</th>
                                <th>Email</th>
                                <th>Bank</th>
                                <th>Account No.</th> -->
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
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Admin/get_ajax_teacher') ?>",
                "type": "POST"
            },
            'columnDefs': [{
                'targets': [0, 3, 4], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 4,
                "className": "text-center",
            },],
            "order": [
                [1, 'asc']
            ]
        });
    });
</script>