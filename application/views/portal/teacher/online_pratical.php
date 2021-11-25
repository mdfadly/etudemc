<main class="page-content">
    <div class="container-fluid">
        <h2 style="font-weight:bold">Online Lesson</h2>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="mr-3 ml-lg-3 mt-3">
                    <table id="example" class="table table-striped table-white display" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>Student Name</th>
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
            "scrollX": true,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            // "bInfo": false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('portal/C_Teacher/get_online_pratical') ?>",
                "type": "POST",
                "data": {
                    "id_teacher": '<?= $this->session->userdata('id'); ?>',
                    "jenis": "1"
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
                }],
            "order": []
        });
    });
</script>