<main class="page-content">
    <div class="container-fluid">
        <div class="col-lg-12">
            <a href="<?= site_url() ?>portal/online-theory" class="btn btn-primary">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
        <hr>
        <h2 style="font-weight:bold">Theory Lesson</h2>
        <h5><?= $studentTemp[0]['name_student'] ?></h5>
        <div class="row">

            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != null) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-lg-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No Invoice</th>
                                <th>Teacher Name</th>
                                <th>Package Range</th>
                                <th>Status</th>
                                <th>Attendance</th>
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
            "bInfo": false,
            // "responsive": true,
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Parent/get_online_theory') ?>",
                "type": "POST",
                "data": {
                    "id_student": '<?= $studentTemp[0]['id_student'] ?>',
                    "jenis": "2"
                }
            },
            'columnDefs': [{
                    'targets': [1, 2, 3], // column index (start from 0)
                    'orderable': false, // set orderable false for selected columns
                },
                {
                    width: '17%',
                    targets: 3,
                    "className": "text-center",
                }
            ],
            "order": []
        });
        var x = window.matchMedia("(max-width: 990px)");
        myFunction(x); // Call listener function at run time
        x.addListener(myFunction); // Attach listener function on state changes

        function myFunction(x) {

        };
    });
</script>