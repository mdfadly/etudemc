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
        <h2 style="font-weight:bold">Data Package</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12 text-right ">
                <a href="<?= site_url() ?>portal/data_paket/add" class="btn btn-primary mr-3">
                    <i class="fa fa-plus mr-2"></i>
                    Add Data
                </a>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-3 mt-3">
                    <table id="example" class="table table-striped table-white display " style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name of Package</th>
                                <th>Type of Class</th>
                                <th>Category Class</th>
                                <!-- <th>Detail Class</th> -->
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
                "url": "<?= site_url('portal/C_Admin/get_ajax_paket') ?>",
                "type": "POST"
            },
            "columnDefs": [{
                'targets': [0, 4], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }, {
                targets: 4,
                "className": "text-center",
            }, ],
            "order": []
        });
    });
</script>